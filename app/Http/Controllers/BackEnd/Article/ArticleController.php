<?php

namespace NttpDev\Http\Controllers\BackEnd\Article;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Article;
use NttpDev\Model\CategoryArticle;
use NttpDev\Model\TagArticle;
use NttpDev\Model\CategoryOfArticle;
use NttpDev\Model\TagOfArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = CategoryArticle::with('children')->whereNull('parent_id')->get(); //get categories
        $tags    =   TagArticle::all();
        $categoriesForProduct = collect([]); //input collect categories for create
        $tagsForProduct = collect([]); //input collect tags for create
        return view('backend.articles.create', compact('categories' , 'tags' , 'categoriesForProduct' , 'tagsForProduct'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.unique' => 'Product name has already',
            'slug.unique' => 'Product slug has already'
        ];

        $this->validate($request, [
            'name' => 'string|unique:articles',
            'slug' => 'string|unique:articles'
        ], $messages);
        $enable_stock = 0;
        $is_option = 0;
        $relate_product = null;
        $value = 'images/placeholder.png';
        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->slug , 'images/articles');
        }

        $data = Article::create([
            'name' => $request->name ,
            'slug' => $request->slug ,
            'image' => $value,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keywords,
            'meta_description'=> $request->meta_description,
            'body_html'                => $request->body_description,
            'short_description'     => $request->short_description
        ]);
        $this->updateCategories($request, $data->id); // Update Categories
        return redirect()->route('admin.article.index');
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
        $data = Article::find($id);
        $categories = CategoryArticle::with('children')->whereNull('parent_id')->get();
        $tags = TagArticle::all();
        $categoriesForProduct = $data->categories()->get();
        $tagsForProduct = $data->tags()->get();
        //$brandForProduct = $data->brands;
        return view('backend.articles.create' , compact('data' , 'categories' , 'categoriesForProduct' ,'tagsForProduct','tags'));
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
        $value = $request->old_image; //Set img if has old image
        $is_option = $request->product_data;
        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->slug , 'images/articles');
        }

        //Data Search Update to DB
        $data = Article::find($id);
        $data->name                     = $request->name;
        $data->slug                     = $request->slug;
        $data->image                    = $value;
        $data->meta_title               = $request->meta_title;
        $data->meta_keyword             = $request->meta_keywords;
        $data->meta_description         = $request->meta_description;
        $data->body_html                = $request->body_description;
        $data->short_description        = $request->short_description;
        $data->save();

        // Delete All relatetion for add new
        CategoryOfArticle::where('article_id', $id)->delete();
        //TagProduct::where('product_id', $id)->delete();

        // Re-insert if there's at least one CategoryArticle checked
        $this->updateCategories($request, $id);
        $this->updateTags($request , $id);

        toastr()->success('','Updated product.', [
            'timeOut'=> '1000'
        ]);

        return redirect()->route('admin.article.edit' , $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Article::find($id);
        $data->delete();

        toastr()->success('','Delete data success.', [
            'timeOut'=> '1000'
        ]);

        return redirect()->back();
    }
     /**
     * LoadData
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function loadData()
    {
        $data = Article::all();
        $data = $alldata = json_decode($data->toJson());
        //return $request->all();
        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

        // search filter by keywords
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
            ? $datatable['query']['generalSearch'] : '';
        if ( ! empty($filter)) {
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
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

        $sort  = ! empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = ! empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'RecordID';

        $meta    = [];
        $page    = ! empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        $perpage = ! empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = count($data); // total items in array

        // sort
        usort($data, function ($a, $b) use ($sort, $field) {
            if ( ! isset($a->$field) || ! isset($b->$field)) {
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
                return $row->RecordID;
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
    protected function updateCategories(Request $request, $id)
    {
        if ($request->productcat) {
            foreach ($request->productcat as $productcat) {
                CategoryOfArticle::create([
                    'article_id' => $id,
                    'category_article_id' => $productcat,
                ]);
            }
        }
    }

    //Update Tag Product Fucntion to database
    protected function updateTags(Request $request, $id)
    {
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $tag_id= null; //Set tag id to null
                $tagCheck = TagArticle::where('slug' , $tag)->first(); //search tag from slug
                if (is_null($tagCheck)) { //check tag is null from db

                    //if isnull to create insert tag
                    $tagCre = TagArticle::create([
                        'name' => $tag,
                        'slug' => $tag
                    ]);
                    $tag_id = $tagCre->id;
                }else{

                    //if notnull set tag id from db search
                    $tag_id = $tagCheck->id;
                }

                //Create Tagproduct To DB with product id
                TagOfArticle::create([
                    'article_id' => $id,
                    'tag_article_id' => $tag_id,
                ]);
            }
        }
    }

    //Upload BODY IMAGE DESCRIPTION TO SUMMER NOTEOTE
    protected function uploadImageBody(Request $request)
    {
        if($request->hasFile('file')){
            $value = uploading()->uploadFiles('file', pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME) , 'images/articles/body');
        }
        return '/storage/'.$value;
    }
}
