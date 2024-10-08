<?php

namespace NttpDev\Http\Controllers\BackEnd\Product;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use DataTables;
use NttpDev\Model\Brand;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.brands.create');
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
            'name.unique' => 'Brand name has already',
            'slug.unique' => 'Brand slug has already',
            'image.dimensions' => 'Image Size 150*60px'
        ];

        $this->validate($request, [
            'name' => 'string|unique:brands',
            'slug' => 'string|unique:brands',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=150,height=60',
        ], $messages);

        $value = 'images/brands/pp_brand_holder.png';
        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->name , 'images/brands');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'images' => $value,
            'seo_title' => $request->seo_title,
            'seo_keywords' => $request->seo_keywords,
            'seo_description' => $request->seo_description
        ]);
        toastr()->success('','Insert data success', [
            'timeOut'=> '1000'
        ]);
        return redirect()->route('admin.catalogs.brands.index');
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
        $brand = Brand::find($id);
        return view('backend.products.brands.create' , compact('brand'));
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
        $this->validate($request, [
            'name' => 'string|unique:brands,slug,'.$id,
            'slug' => 'string|unique:brands,slug,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=150,height=60',
        ]);
        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->name , 'images/brands');
        }

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->images = $value;
        $brand->seo_title = $request->seo_title;
        $brand->seo_keywords = $request->seo_keywords;
        $brand->seo_description = $request->seo_description;
        $brand->save();

        toastr()->success('','Save data success', [
            'timeOut'=> '1000'
        ]);
        return redirect()->route('admin.catalogs.brands.edit' , $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

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
        $brand = Brand::all();
        $data = $alldata = json_decode($brand->toJson());
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
