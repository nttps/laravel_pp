<?php

namespace NttpDev\Http\Controllers\BackEnd\Product;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Category;
use NttpDev\Model\Product;
use NttpDev\Model\CategoryProduct;
use NttpDev\Model\OptionProduct;
use NttpDev\Model\OptionProductValue;
use NttpDev\Model\Tag;
use NttpDev\Model\TagProduct;
use NttpDev\Model\RelateProduct;
use NttpDev\Model\Attribute;
use NttpDev\Model\Brand;
use NttpDev\Model\AttributeProduct;
use NttpDev\Http\Requests\CsvImportRequest;
use NttpDev\Model\CsvData;
use NttpDev\Http\Requests\DataImportProduct;
use Alert;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list');
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);


        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::with('children')->whereNull('parent_id')->get(); //get categories
        $tags = Tag::all(); //get tags
        $attributes = Attribute::orderBy('name' , 'DESC')->get(); //get attributes
        $brands = Brand::all(); //get brands
        $categoriesForProduct = collect([]); //input collect categories for create
        $tagsForProduct = collect([]); //input collect tags for create
        $relateForProduct = collect([]); //input collect relateproduct for create
        $brandForProduct = collect([]); //input collect relateproduct for create
        $attributes_product = collect([]);
        $options_product = collect([]);
        $countOption    = 0;
        $images = '';
        return view('backend.products.create', compact('categories', 'categoriesForProduct', 'tagsForProduct', 'relateForProduct', 'brandForProduct', 'attributes', 'tags', 'brands', 'attributes_product', 'options_product', 'countOption', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->is_show );
        $messages = [
            'name.unique' => 'Product name has already',
            'slug.unique' => 'Product slug has already',
            'price.requried' => 'Please input Price',
            //'SKU.unique' => 'SKU has already'
        ];

        $this->validate($request, [
            'name' => 'string|unique:products',
            'slug' => 'string|unique:products',
            'price' => 'requried',
            //'SKU' => 'string|unique:products'
        ], $messages);
        $enable_stock = 0;
        $is_option = 0;
        $relate_product = null;
        $is_show = 1; //Set Disable Stock first
        $is_sale = 1; //Set Disable Stock first
        $is_banner = 1; //Set Disable Stock first
        $value = 'images/placeholder.png';
        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->slug, 'images/products', true);
        }

        if ($request->enable_stock == 'on') {
            $enable_stock = 1;
        }
        //Set Enable stock if check button
        if ($request->is_show != 'on') {
            $is_show = 0;
        }
        if ($request->is_sale != 'on') {
            $is_sale = 0;
        }
        if ($request->is_banner != 'on') {
            $is_banner = 0;
        }


        if ($request->product_data == 'selectedproduct') {
            $is_option = 1;
        }
        $product = Product::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'slug' => $request->slug,
            'image' => $value,
            'inventory_quantity' => $request->inventory_quantity,
            'price' => $request->regularPrice,
            'discount_price' => $request->salePrice,
            'distibutor_price' => $request->regularPrice_Distibutor,
            'distibutor_discount_price' => $request->salePrice_Distibutor,
            'dealer_price' => $request->regularPrice_Dealer,
            'dealer_discount_price' => $request->salePrice_Dealer,
            'shipping_price'    => $request->shippingPrice,
            'sku' => $request->SKU,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'body_html'                => $request->body_description,
            'body_html_en'                => $request->body_description_en,
            'short_description'     => $request->short_description,
            'short_description_en'     => $request->short_description_en,
            'enable_stock'  =>      $enable_stock,
            'relate_product'        => $relate_product,
            'is_option'             => $is_option,
            'is_show'               => $is_show,
            'is_sales'              => $is_sale,
            'brand_id'              => $request->brand,
            'is_banner'             => $is_banner
        ]);
        $this->updateProductCategories($request, $product->id); // Update Categories
        return redirect()->route('admin.catalogs.product.index');
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
        $data = Product::find($id);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        $tags = Tag::all();
        $attributes = Attribute::orderBy('name' , 'ASC')->get();
        $brands = Brand::all(); //get brands
        $categoriesForProduct = $data->categories()->get();
        $tagsForProduct = $data->tags()->get();
        $relateForProduct = $data->relateProduct()->get();
        $attributes_product = $data->attributes()->orderBy('position', 'ASC')->get();
        $options_product = $data->attributes()->where('is_option', 1)->orderBy('position', 'ASC')->get();
        $countOption = $data->attributes()->where('is_option', 1)->count();
        $countVariant = $data->variants()->count();
        $productParent = $data->children()->with('children')->get();
        $productVariant = $data->variants()->get();
        $images = json_decode($data->images);

        //dd($productVariant);
        $optionsForProduct =     $data->options()->whereNull('parent_id')->orderBy('id', 'DESC')->get();

        //$brandForProduct = $data->brands;
        return view('backend.products.create', compact('data', 'images', 'categories', 'categoriesForProduct', 'tagsForProduct', 'relateForProduct', 'brandForProduct', 'attributes', 'brands', 'tags', 'attributes_product', 'options_product', 'optionsForProduct', 'productVariant', 'countOption', 'productParent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        //dd($request->is_show );
        $messages = [
            'name.unique' => 'Product name has already',
            'slug.unique' => 'Product slug has already',
            //'SKU.unique' => 'SKU has already'
        ];

        $this->validate($request, [
            'name' => 'string|unique:products,slug,' . $id,
            'slug' => 'string|unique:products,slug,' . $id,
            //'SKU' => 'string|unique:products'
        ], $messages);
        $relate_product = null; //Set Relate Product to null first
        $enable_stock = 0; //Set Disable Stock first
        $is_show = 1; //Set Disable Stock first
        $is_sale = 1;
        $is_banner = 1; //Set Disable Stock first
        $value = $request->old_image; //Set img if has old image
        $is_option = $request->product_data;
        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->slug, 'images/products', true);
        }
        //dd($value);

        //Set Enable stock if check button
        if ($request->enable_stock == 'on') {
            $enable_stock = 1;
        }
        if ($request->is_sale != 'on') {
            $is_sale = 0;
        }

        //Set Enable stock if check button
        if ($request->is_banner != 'on') {
            $is_banner = 0;
        }
        if ($request->is_show != 'on') {
            $is_show = 0;
        }

        if ($request->product_data == 'selectedproduct') {
            $is_option = 1;
        }
        //Data Search Update to DB
        $data = Product::find($id);
        $data->name                     = $request->name;
        $data->name_en                     = $request->name_en;
        $data->slug                     = $request->slug;
        $data->image                    = $value;
        $data->inventory_quantity       = $request->inventory_quantity;
        $data->price                    = $request->regularPrice;
        $data->discount_price           = $request->salePrice;
        $data->distibutor_price           = $request->regularPrice_Distibutor;
        $data->distibutor_discount_price           = $request->salePrice_Distibutor;
        $data->dealer_price           = $request->regularPrice_Dealer;
        $data->dealer_discount_price           = $request->salePrice_Dealer;
        $data->shipping_price           = $request->shippingPrice;
        $data->sku                      = $request->SKU;
        $data->meta_title               = $request->meta_title;
        $data->meta_keyword             = $request->meta_keywords;
        $data->meta_description         = $request->meta_description;
        $data->body_html                = $request->body_description;
        $data->body_html_en                = $request->body_description_en;
        $data->short_description        = $request->short_description;
        $data->short_description_en        = $request->short_description_en;
        $data->enable_stock             = $enable_stock;
        $data->relate_product           = $relate_product;
        $data->brand_id                 = $request->brand;
        $data->is_option                = $is_option;
        $data->is_show                  = $is_show;
        $data->is_sales                  = $is_sale;
        $data->is_banner                  = $is_banner;
        $data->save();

        // Delete All relatetion for add new
        CategoryProduct::where('product_id', $id)->delete();
        TagProduct::where('product_id', $id)->delete();
        RelateProduct::where('product_id', $id)->delete();

        if ($is_option != 1) {
            $attributes = AttributeProduct::where('product_id', $id)->get();

            foreach ($attributes as $attribute) {
                $attribute->is_option   = 0;
                $attribute->save();
            }
        }

        // Re-insert if there's at least one category checked
        $this->updateProductCategories($request, $id);
        $this->updateProductTags($request, $id);
        $this->updateProductRelate($request, $id);

        toastr()->success('', 'Updated product.', [
            'timeOut' => '1000'
        ]);

        return redirect()->route('admin.catalogs.product.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $data = Product::find($id);
            $data->delete();

            toastr()->success('', 'Delete data success.', [
                'timeOut' => '1000'
            ]);
            return redirect()->back();
        } catch (\Exception  $e) {
            toastr()->success('', 'Delete Failed.', [
                'timeOut' => '1000'
            ]);
            return back();
        }
    }
    /**
     * LoadData
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function loadData()
    {
        $data = Product::where('product_type', 'product')->with('categories')->orderBy('id', 'desc')->get();
        $data = $alldata = json_decode($data->toJson() , true);
        //return $request->all();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

        // search filter by keywords

        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
            ? $datatable['query']['generalSearch'] : '';

        if (!empty($filter)) {
           
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a['name']);
            });
            unset($datatable['query']['generalSearch']);
        }

        // filter by field query
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $data = list_filter($data, [$key => $val]);
            }
        }

        $sort  = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'desc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'created_at';



        $meta    = [];
        $page    = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = count($data); // total items in array

        // sort
        usort($data, function ($a, $b) use ($sort, $field) {
            if (!isset($a->$field) || !isset($b->$field)) {
                return false;
            }

            if ($sort === 'asc') {
                return $a->$field > $b->$field ? true : false;
            }

            return $a->$field < $b->$field ? true : false;
        });

        // $perpage 0; get all data
        if ($perpage > 0) {
            $pages  = ceil($total / $perpage); // calculate total pages
            $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }

            $data = array_slice($data, $offset, $perpage, true);
        }

        $meta = [
            'page'    => $page,
            'pages'   => $pages,
            'perpage' => $perpage,
            'total'   => $total,
        ];


        // if selected all records enabled, provide all the ids
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                return $row->id;
            }, $alldata);
        }


        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

        $result = [
            'meta' => $meta + [
                'sort'  => $sort,
                'field' => $field,
            ],
            'data' => $data,
        ];

        return json_encode($result, JSON_PRETTY_PRINT);
    }

    //Update Categories Fucntion to database
    protected function updateProductCategories(Request $request, $id)
    {
        if ($request->productcat) {
            foreach ($request->productcat as $productcat) {
                CategoryProduct::create([
                    'product_id' => $id,
                    'category_id' => $productcat,
                ]);
            }
        }
    }

    //Update Relate Product Fucntion to database
    protected function updateProductRelate(Request $request, $id)
    {
        if ($request->relate_product) {
            foreach ($request->relate_product as $relate_product) {
                RelateProduct::create([
                    'product_id' => $id,
                    'relate_id' => $relate_product,
                ]);
            }
        }
    }

    //Update Tag Product Fucntion to database
    protected function updateProductTags(Request $request, $id)
    {
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $tag_id = null; //Set tag id to null
                $tagCheck = Tag::where('slug', $tag)->first(); //search tag from slug
                if (is_null($tagCheck)) { //check tag is null from db

                    //if isnull to create insert tag
                    $tagCre = Tag::create([
                        'name' => $tag,
                        'slug' => $tag
                    ]);
                    $tag_id = $tagCre->id;
                } else {

                    //if notnull set tag id from db search
                    $tag_id = $tagCheck->id;
                }

                //Create Tagproduct To DB with product id
                TagProduct::create([
                    'product_id' => $id,
                    'tag_id' => $tag_id,
                ]);
            }
        }
    }

    //Upload BODY IMAGE DESCRIPTION TO SUMMER NOTEOTE
    protected function uploadImageBody(Request $request)
    {
        if ($request->hasFile('file')) {
            $value = uploading()->uploadFiles('file', pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME), 'images/products/body');
        }
        $fileName = '/storage/' . $value;
        return json_encode(array(
            'file_path' => $fileName
        ));
    }

    //Relate Searh form add Relate Product
    protected function RelateSearch(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->q . '%')->whereNull('product_parent')->get();
        $count = Product::where('name', 'LIKE', '%' . $request->q . '%')->whereNull('product_parent')->count();
        return response()->json(['incomplete_results' => 'false', 'total_count' => $count,  'items' => $products], 200);
    }
    public function getImport()
    {
        return view('backend.products.import');
    }


    public function parseImport(CsvImportRequest $request)
    {

        try {
            $path = $request->file('csv_file')->getRealPath();
            if ($request->has('header')) {
                $data = \Excel::load($path, function ($reader) { })->get()->toArray();
            } else {
                $data = array_map('str_getcsv', file($path));
            }
            if (count($data) > 0) {
                if ($request->has('header')) {
                    $csv_header_fields = [];
                    foreach ($data[0] as $key => $value) {
                        $csv_header_fields[] = $key;
                    }
                }
                $csv_data = array_slice($data, 0);
                $csv_data_file = CsvData::create([
                    'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                    'csv_header' => $request->has('header'),
                    'csv_data' => json_encode($data)
                ]);
            } else {
                return redirect()->back();
            }
            //dd($csv_data);
            return view('backend.products.import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'));
        } catch (\Exception  $e) {
            toastr()->success('', ' File is failed.', [
                'timeOut' => '1000'
            ]);
            return redirect()->back();
        }
    }
    public function processImport(DataImportProduct $request)
    {

        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        $p = 0;

        $suba = 0;
        foreach ($csv_data as $row) {
            $CateArray = array();
            $attribute_data = array();

            $subp = 0;
            $product = new Product();
            $set_attri = false;
            $set_empty = true;
            $product_parent = '';
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    if ($set_empty) {
                        if ($field == 'name') {
                            $nameC = Product::where('name', $row[$request->fields[$field]])->first();
                            if ($nameC) {
                                alert()->message('Name Product has already !', $row[$request->fields[$field]], $icon = 'error');
                                return redirect()->route('admin.catalogs.product.import');
                            }
                            $product->$field = $row[$request->fields[$field]];
                        } else if ($field == 'slug') {
                            $slugC = Product::where('slug', make_slug($row[$request->fields[$field]]))->first();
                            if ($slugC) {
                                alert()->message('Slug Product has already !', $row[$request->fields[$field]], $icon = 'error');
                                return redirect()->route('admin.catalogs.product.import');
                            }
                            $product->$field = make_slug($row[$request->fields[$field]]);
                        } else if ($field == 'sku') {
                            $skuC = Product::where('sku', $row[$request->fields[$field]])->first();
                            if ($skuC) {
                                alert()->message('Sku Product has already !', 'SKU is ' . $row[$request->fields[$field]], $icon = 'error');
                                return redirect()->route('admin.catalogs.product.import');
                            } else {
                                $product->$field = $row[$request->fields[$field]];
                            }
                        } else if ($field == 'price') {
                            if ($row[$request->fields[$field]] != '') {
                                $product->price = (0 + str_replace(",", "", $row[$request->fields[$field]]));
                            } else {
                                $product->price = '';
                            }
                        } else if ($field == 'discount_price') {
                            if ($row[$request->fields[$field]] != '') {
                                $product->discount_price = (0 + str_replace(",", "", $row[$request->fields[$field]]));
                            }
                        } else if ($field == 'shipping_price') {
                            if ($row[$request->fields[$field]] != '') {
                                $product->shipping_price = (0 + str_replace(",", "", $row[$request->fields[$field]]));
                            } else {
                                $product->shipping_price = 0;
                            }
                        } else if ($field == 'is_sales') {
                            if ($row[$request->fields[$field]] != '') {
                                $product->is_sales = 1;
                            } else {
                                $product->is_sales = 0;
                            }
                        } else if ($field == 'brand') {
                            if ($row[$request->fields[$field]] != '') {
                                $slugB = Brand::where('name', $row[$request->fields[$field]])->first();
                                if ($slugB) {
                                    $product->brand_id = $slugB->id;
                                } else {
                                    $brand = Brand::create([
                                        'name' => $row[$request->fields[$field]],
                                        'slug' => make_slug($row[$request->fields[$field]]),
                                    ]);
                                    $product->brand_id = $brand->id;
                                }
                            } else {
                                $slugB = Brand::where('slug', 'nobrand')->first();
                                if ($slugB) {
                                    $product->brand_id = $slugB->id;
                                } else {
                                    $brand = Brand::create([
                                        'name' => 'No Brand',
                                        'slug' => make_slug('nobrand'),
                                    ]);
                                    $product->brand_id = $brand->id;
                                }
                            }
                        } else if ($field == 'category') {
                            if ($row[$request->fields[$field]] != '') {
                                $CateArray = explode(',', $row[$request->fields[$field]]);
                            }
                        } else if ($field == 'attribute') {
                            if ($row[$request->fields[$field]] != '') {
                                $attribute_data = explode('|', $row[$request->fields[$field]]);
                            }
                        } else if ($field == 'parent_sku') {
                            if ($row[$request->fields[$field]] != '') {
                                $product_parent = Product::where('sku', $row[$request->fields[$field]])->first();
                                if ($product_parent) {
                                    $product->product_parent = $product_parent->id;
                                    $product->product_type = 'option_product';
                                    $set_attri = true;
                                } else {
                                    alert()->message('SKU Not Found!', $row[$request->fields[$field]], $icon = 'error');
                                    return redirect()->route('admin.catalogs.product.import');
                                }
                            }
                        } else if ($field == 'has_variant_product') {
                            if ($row[$request->fields[$field]] != '') {
                                $product->is_option = 1;
                            }
                        } else {
                            $product->{$field} = $row[$request->fields[$field]];
                        }
                    } else {
                        $set_empty = false;
                    }
                } else {

                    if ($row[$request->fields[$index]] != '') {
                        $product->$field = $row[$request->fields[$index]];
                    }
                }
            }

            $product->image = 'images/placeholder.png';

            $parent_id = NULL;

            if (!$set_attri) {
                if ($set_empty) {
                    $product->save();
                    $p++;
                }

                foreach ($attribute_data as $at_data) {


                    $attribute_at = explode(':', $at_data);

                    if (count($attribute_at) <= 1) {
                        //alert()->message('' ,$row[$request->fields[$field]] , $icon = 'error');
                        session()->flash('message', 'สินค้าหลักถูกลงเรียบร้อยแล้ว <br> แต่หัวข้อ Attibute สินค้าภายในไม่ถูกต้อง โปรดเช็คไฟล์ .CSV ของคุณ <br> ตัวอย่าง หัวข้อattribute:ค่าของattiribute');
                        return view('backend.products.import_success', compact('p', 'subp', 'suba'));
                    }

                    // main Attribute Add
                    // $attr = Attribute::create([
                    //     'name' => $attribute_at[0],
                    //     'value' => $attribute_at[1]
                    // ]);
                    AttributeProduct::create([
                        'product_id'            =>          $product->id,
                        'attribute_id'          =>          $attr->id,
                        'attribute_value'       =>          $attribute_at[1],
                        'position'              =>          '0',
                        'is_show'               =>          1,
                        'is_option'             =>          1,
                    ]);
                }
                $subp++;
            } else {
                $subp++;
                $parent_attri_id = NULL;
                $parent_value_id = NULL;
                $i = 0;

                foreach ($attribute_data as $at_data) {

                    $attribute_at = explode(':', $at_data);

                    if (count($attribute_at) <= 1) {
                        //alert()->message('' ,$row[$request->fields[$field]] , $icon = 'error');
                        session()->flash('message', 'สินค้าหลักถูกลงเรียบร้อยแล้ว <br> แต่หัวข้อ Attibute สินค้าภายในไม่ถูกต้อง โปรดเช็คไฟล์ .CSV ของคุณ <br> ตัวอย่าง หัวข้อattribute:ค่าของattiribute');
                        return view('backend.products.import_success', compact('p', 'subp', 'suba'));
                    }

                    $option = OptionProduct::where('product_id', $product_parent->id)->where('option_name', $attribute_at[0])->first();
                    if (!$option) {
                        $option = OptionProduct::create([
                            'product_id' =>  $product_parent->id,
                            'option_name' =>  $attribute_at[0],
                            'parent_id' => $parent_attri_id
                        ]);
                    }

                    $parent_attri_id = isset($option->id) ? $option->id : NULL;

                    // dd($parent_attri_id );

                    $optionvalue = OptionProductValue::where('option_product_id', $option->id)->where('value', $attribute_at[1])->where('parent_id', $parent_value_id)->first();
                    if ($i == 0) {
                        $optionvalue = OptionProductValue::where('option_product_id', $option->id)->where('value', $attribute_at[1])->whereNull('parent_id')->first();
                    }
                    if (!$optionvalue) {
                        $optionvalue = OptionProductValue::create([
                            'option_product_id' => $option->id,
                            'value' =>  $attribute_at[1],
                            'parent_id' => $parent_value_id

                        ]);
                    }

                    $parent_value_id = isset($optionvalue->id) ? $optionvalue->id : NULL;

                    $i++;
                }
                $product->option_product_id = $option->id;
                $product->option_product_value_id = $optionvalue->id;

                if ($set_empty) {
                    $product->save();
                    $p++;
                }

                $suba++;
            }



            foreach ($CateArray as $key => $name_cate) {
                //dd($name_cate);

                $category = Category::where('name', $name_cate)->first();
                if ($category) {
                    CategoryProduct::create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                } else {
                    $category = Category::create([
                        'parent_id' =>  $parent_id,
                        'name' => $name_cate,
                        'slug' => make_slug($name_cate),
                        'image' => 'images/placeholder_categorie.png',

                    ]);
                    CategoryProduct::create([
                        'product_id' => $product->id,
                        'category_id' => $category->id,
                    ]);
                }
                $parent_id = $category->id;
            }
        }

        return view('backend.products.import_success', compact('p', 'subp', 'suba'));
    }
    public function upload(Request $request)
    {

        $product = Product::find($request->id);
        $images = json_decode($product->images);
        if ($request->hasfile('images')) {

                foreach ($request->file('images') as $key => $file) {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path() . '/images/products/gallery', $name);

                        if ($images == NULL) {
                            $images[] = '/images/products/gallery/' . $name;
                        } else {
                            $data = array_push($images, '/images/products/gallery/' . $name);
                        }
                    }
            }

        $result = json_encode($images);
        $product->images = $result;
        $product->save();
        return redirect()->back();
    }
    public function delete_image(Request $request)
    {

        $product = Product::find($request->id);
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
}
