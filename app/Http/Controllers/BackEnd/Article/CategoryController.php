<?php

namespace NttpDev\Http\Controllers\BackEnd\Article;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\CategoryArticle;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryArticle::with(['children'])->get();
        return view('backend.articles.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name.unique' => 'Category name has already',
            'slug.unique' => 'Category slug has already',
        ];

        $this->validate($request, [
            'name' => 'string|unique:category_articles',
            'slug' => 'string|unique:category_articles',
        ], $messages);

        CategoryArticle::create([
            'parent_id' =>  $request->parent_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'meta_title' => $request->seo_title,
            'meta_keyword' => $request->seo_keywords,
            'meta_description' => $request->seo_description
        ]);
        toastr()->success('','Insert data success', [
            'timeOut'=> '1000'
        ]);
        return redirect()->route('admin.article.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryArticle::find($id);
        $parents = CategoryArticle::where('id' ,'!=' , $id)->get();
        return view('backend.articles.categories.create' , compact('category' , 'parents'));
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
        $value = $request->old_image;

        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->name , 'images/categories');
        }

        $update = CategoryArticle::find($id);
        $update->parent_id = $request->parent_id;
        $update->name = $request->name;
        $update->slug = $request->slug;
        $update->meta_title = $request->seo_title;
        $update->meta_keyword = $request->seo_keywords;
        $update->meta_description = $request->seo_description;
        $update->save();

        toastr()->success('','Save data success', [
            'timeOut'=> '1000'
        ]);
        return redirect()->route('admin.article.categories.edit' , $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = CategoryArticle::find($id);
        $destroy->delete();

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
        $categories = CategoryArticle::with('parent')->get();
        $data = $alldata = json_decode($categories->toJson());
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
}
