<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Category;
use NttpsApp\Models\Attribute;
use NttpsApp\Models\Product;
use NttpsApp\Models\ProductHasAttribute;
use NttpsApp\Models\CategoryProduct;
use NttpsApp\Http\Requests\ProductRequest;
use NttpsApp\Models\Product\ModelProduct;
use NttpsApp\Models\Product\ModelProductAttribute;
use NttpsApp\Models\Product\ModelProductAttributeValue;
use NttpsApp\Models\Page;
use NttpsApp\Models\Tag;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('backend.pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::withTranslation()->whereNull('parent_id')->get();      
        $categoriesForData = collect(); //input collect categories for create
      
        $attributes = Attribute::all();
        $attributes_product = false;
        $relateForProduct = collect();
        $pagesForData = collect(); //input collect categories for create
        $product_pages = Page::where('is_page_products' , 1)->get();
        $tags = Tag::all();
        $tagsForProduct = collect();
        return view('backend.pages.products.add-edit', compact('categories', 'categoriesForData' , 'attributes' , 'attributes_product' , 'relateForProduct' , 'product_pages' , 'pagesForData' , 'tagsForProduct' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request->all());
        $data =  new ModelProduct;
        $data->slug = $request->slug;
        $data->sku = $request->sku;
        $data->image = $request->image;
        $data->regular_price = $request->regular_price;
        $data->sale_price = $request->sale_price;
        $data->shipping_price = $request->shipping_price;
        $data->stock = $request->stock;
        $data->type = $request->product_type;
        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];
        $data->seo_meta = $data_seo;
        $data->banner_header = $request->banner;
        $data->images = $request->images;
        $data->save();
        foreach (['en', 'th', 'cn'] as $locale) {
            $data->translateOrNew($locale)->display_name = $request->{"name_" . $locale};
            $data->translateOrNew($locale)->body_html =  $request->{"body_description_" . $locale};
        }
        $data->save();      
        
        
        //$this->updateProductCategories($request, $data->id); // Update Categories
        $data->categories()->attach($request->categories);   
        $data->product_relates()->attach($request->relate_product);  
        $data->pages()->attach($request->tags);    
        
        $this->updateAttribute($request ,$data);
        $this->updateProductTags($request ,$data);
        
        return redirect()->route('admin.products.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $product = ModelProduct::with('attributes.values')->find($id);
        $categoriesForData = $product->categories()->get();
        $relateForProduct = $product->product_relates()->get();
        $product_pages = Page::where('is_page_products' , 1)->get();
        $pagesForData = $product->pages()->get();
        $tags = Tag::all();
        $tagsForProduct = $product->tags()->get();
        $attributes = Attribute::all();
        $attributes_product = true;

        return view('backend.pages.products.add-edit', compact('product','categories', 'categoriesForData' , 'attributes'  ,'attributes_product' , 'relateForProduct' , 'pagesForData' ,'product_pages' , 'tagsForProduct' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //dd($request->images);
        $data =  ModelProduct::find( $id);
        $data->slug = $request->slug;
        $data->sku = $request->sku;
        $data->image = $request->image;
        $data->regular_price = $request->regular_price;
        $data->sale_price = $request->sale_price;
        $data->shipping_price = $request->shipping_price;
        $data->stock = $request->stock;
        $data->type = $request->product_type;
        $data_seo[] = [
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description,
        ];

        $data->seo_meta = $data_seo;
        $data->banner_header = $request->banner;
     
        $data->images = $request->images;
        $data->translate('th')->display_name = $request->name_th;
        $data->translate('en')->display_name = $request->name_en;
        $data->translate('cn')->display_name = $request->name_cn;        
        $data->translate('th')->body_html = $request->body_description_th;
        $data->translate('en')->body_html = $request->body_description_en;
        $data->translate('cn')->body_html = $request->body_description_cn;
        $data->save();      
        
        
        //$this->updateProductCategories($request, $data->id); // Update Categories
        $data->categories()->sync($request->categories);
        $data->product_relates()->sync($request->relate_product);
        $data->pages()->sync($request->pages);    
        $this->updateAttribute($request ,$data);        
        $this->updateProductTags($request ,$data);
        

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postCate = ModelProduct::find($id);
        $postCate->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    //Update Categories Fucntion to database
    protected function updateProductCategories(Request $request, $id)
    {
        if ($request->categories) {
            foreach ($request->categories as $productcat) {
                CategoryProduct::create([
                    'product_id' => $id,
                    'category_id' => $productcat,
                ]);
            }
        }
    }

    //Update Tag Product Fucntion to database
    protected function updateProductTags(Request $request, $data)
    {

        $tags = array();
        if ($request->tags) {
            
            foreach ($request->tags as $tag) {
                $tagS = Tag::where('slug', $tag)->first(); //search tag from slug
                if (is_null($tagS)) { //check tag is null from db

                    //if isnull to create insert tag
                    $tagS = Tag::create([
                        'name' => $tag,
                        'slug' => Str::slug($tag, '-')
                    ]);
                }
                //Tagproduct To DB with product id
                $tags[] = $tagS->id;
                
            }
            $data->tags()->sync($tags);
        }
    }
    public function updateAttribute($request , $data){
        if ($request->attribute_id) {
            foreach($request->attribute_id as $key => $attribute_item){
                $product_attribute = ModelProductAttribute::where('model_product_id' , $data->id)->where('attribute_id' , $attribute_item)->first();
    
                if(empty($product_attribute)){
                    $product_attribute = ModelProductAttribute::create([
                        'model_product_id' => $data->id , 
                        'attribute_id' => $attribute_item,
                        'enable_visible' => $request->enable_visible[$key] ?? 0, 
                        'enable_varient' => $request->enable_option_product[$key] ?? 0
                    ]);
                  
                }else{
                    $product_attribute->enable_visible = !empty($request->enable_visible[$key]) ? 1: 0;
                    $product_attribute->enable_varient = !empty($request->enable_option_product[$key]) ? 1: 0;
                    $product_attribute->save();

                }
                ModelProductAttributeValue::where('model_product_attribute_id' , $product_attribute->id)->delete();
                foreach($request->attribute_value_id[$key] as $attribute_value_id) {
    
                  
                    
                    ModelProductAttributeValue::create([
                        'model_product_attribute_id' => $product_attribute->id , 
                        'attribute_value_id' => $attribute_value_id
                    ]);
                    
                   
                }

                
            }
        }
    }

    public function uploadImages(Request $request)
    {

        //dd($request->all());
        $params = array();
        parse_str($request->data, $params);
        //dd($params);
        $product = ModelProduct::find($request->data_id);
        $product->images = $params;
        $product->save();
        return response()->json(
            ['status' => 'success']
        );
    }

    public function deleteImages(Request $request)
    {

        $product = ModelProduct::find($request->id);
        $fieldData = @json_decode($product->images, true);

        // Flip keys and values
        $fieldData = array_flip($fieldData);

        // Check if image exists in array
        if (!array_key_exists($request->image, $fieldData)) {
            throw new Exception(__('ttt'), 400);
        }

        // Remove image from array
        unset($fieldData[$request->image]);

        // Generate json and update field
        $product->images = json_encode(array_values(array_flip($fieldData)));
        $product->save();
        return response()->json([
            'data' => [
                'status'  => 200,
                'message' => __('Updated Images '),
            ],
        ]);
    }

     //Relate Searh form add Relate Product
     protected function relateSearch(Request $request)
     {
         $products = ModelProduct::where('type' ,'!=','variable')->whereTranslationLike('display_name', '%' . $request->q . '%')->get();
         $count = ModelProduct::whereTranslationLike('display_name', '%' . $request->q . '%')->where('type' ,'!=','variable')->count();
         return response()->json(['incomplete_results' => 'false', 'total_count' => $count,  'items' => $products], 200);
     }
}
