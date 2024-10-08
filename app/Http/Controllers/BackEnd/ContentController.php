<?php

namespace NttpDev\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function termIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('type' , 'term')->get();
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
        return view('backend.contents.termPrivacy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function helpIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('type' , 'help')->get();
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
        return view('backend.contents.helpCenter');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('type' , '!=', 'promotion')->get();
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
        return view('backend.contents.footer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promotionIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Content::where('type' , 'promotion')->get();
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
        return view('backend.contents.promotion');
    }
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promotionCreate()
    {
        return view('backend.contents.create');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promotionPost(Request $request)
    {
        $messages = [
            'title.unique' => 'Promotion name has already',
            'slug.unique' => 'Promotion slug has already',
        ];

        $this->validate($request, [
            'title' => 'string|unique:contents',
            'slug' => 'string|unique:contents',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ], $messages);
        $value = 'images/content/banner-replace.png';
        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->slug , '/images/content');
        }

        
        Content::create([
            'title' => $request->name ,
            'slug'  => $request->slug ,
            'image' => $value,
            'body_html' => $request->body_description,
            'meta_title' => $request->meta_title,
            'meta_description'  => $request->meta_keywords,
            'meta_keyword' =>  $request->meta_description,
            'type'  => 'promotion'
            
            
        ]);
        return view('backend.contents.promotion');
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promotionEdit($id)
    {

        $data = Content::find($id);
        return view('backend.contents.create' , compact('data'));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $data = Content::where('id' , $id)->firstOrfail();
       return view('backend.contents.edit' , compact('data'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $this->validate($request, [
            'image'         => 'image|dimensions:min_height=400',
        ]);
        $this->validate($request, [
            'name' => 'string|unique:contents,slug,'.$id,
            'slug' => 'string|unique:contents,slug,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $value = $request->old_image;

        if($request->hasFile('image')){
            $value = uploading()->uploadFiles('image', $request->slug , '/images/content');
        }

        $update = Content::find($id);
        $update->image = $value;
        $update->body_html = $request->body_description;
        $update->meta_title = $request->meta_title;
        $update->meta_description = $request->meta_description;
        $update->meta_keyword = $request->meta_keywords;
        $update->save();

        toastr()->success('','Save data success', [
            'timeOut'=> '1000'
        ]);

        if($update->type == 'promotion'){
            return redirect()->route('admin.contents.promotion.edit' , $id);
        }
        return redirect()->route('admin.contents.edit' , [$update->type , $id]);
      //return view('backend.contents.edit' , compact('data'));
    }
}
