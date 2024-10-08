<?php

namespace NttpDev\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Widget;
use NttpDev\Model\Product;

class WidgetsController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goodSellerIndex(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'LIKE', '%' . $request->q . '%')->whereNull('product_parent')->get();
            $count = Product::where('name', 'LIKE', '%' . $request->q . '%')->whereNull('product_parent')->count();
            return response()->json(['incomplete_results' => 'false', 'total_count' => $count,  'items' => $products], 200);
        }

        $seller_left_1 = Widget::where('code', 'seller_left_1')->first();
        $seller_left_2 = Widget::where('code', 'seller_left_2')->first();
        $seller_left_3 = Widget::where('code', 'seller_left_3')->first();
        $seller_right_1 = Widget::where('code', 'seller_right_1')->first();
        $seller_right_2 = Widget::where('code', 'seller_right_2')->first();
        $seller_right_3 = Widget::where('code', 'seller_right_3')->first();

        $product_left_1 = Product::find($seller_left_1->url_link);
        $product_left_2 = Product::find($seller_left_2->url_link);
        $product_left_3 = Product::find($seller_left_3->url_link);
        $product_right_1 = Product::find($seller_right_1->url_link);
        $product_right_2 = Product::find($seller_right_2->url_link);
        $product_right_3 = Product::find($seller_right_3->url_link);

        return view('backend.widgets.seller', compact(
            'seller_left_1',
            'seller_left_2',
            'seller_left_3',
            'seller_right_1',
            'seller_right_2',
            'seller_right_3',
            'product_left_1',
            'product_left_2',
            'product_left_3',
            'product_right_1',
            'product_right_2',
            'product_right_3'
        ));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goodSellerPost(Request $request)
    {
        $this->validate($request, [
            'seller_left_1'         => 'image|dimensions:max_width=325,max_height=850',
            'seller_left_2'         => 'image|dimensions:max_width=320,max_height=320',
            'seller_left_3'         => 'image|dimensions:max_width=320,max_height=320',
            'seller_right_1'         => 'image|dimensions:max_width=325,max_height=850',
            'seller_right_2'         => 'image|dimensions:max_width=320,max_height=320',
            'seller_right_3'         => 'image|dimensions:max_width=320,max_height=320',
        ]);



        $image_left_1 = $request->old_seller_left_1;
        if ($request->hasFile('seller_left_1')) {
            $image_left_1 = uploading()->uploadFiles('seller_left_1', $setname = 'seller_left_1', '/images/slides');
        }

        $image_left_2 = $request->old_seller_left_2;
        if ($request->hasFile('seller_left_2')) {
            $image_left_2 = uploading()->uploadFiles('seller_left_2', $setname = 'seller_left_2', '/images/slides');
        }

        $image_left_3 = $request->old_seller_left_3;
        if ($request->hasFile('seller_left_3')) {
            $image_left_3 = uploading()->uploadFiles('seller_left_3', $setname = 'seller_left_3', '/images/slides');
        }

        $image_right_1 = $request->old_seller_right_1;
        if ($request->hasFile('seller_right_1')) {
            $image_right_1 = uploading()->uploadFiles('seller_right_1', $setname = 'seller_right_1', '/images/slides');
        }

        $image_right_2 = $request->old_seller_right_2;
        if ($request->hasFile('seller_right_2')) {
            $image_right_2 = uploading()->uploadFiles('seller_right_2', $setname = 'seller_right_2', '/images/slides');
        }

        $image_right_3 = $request->old_seller_right_3;
        if ($request->hasFile('seller_right_3')) {
            $image_right_3 = uploading()->uploadFiles('seller_right_3', $setname = 'seller_right_3', '/images/slides');
        }
        $seller_left_1 = Widget::where('code', 'seller_left_1')->first();
        $seller_left_1->image = $image_left_1;
        $seller_left_1->url_link = $request->text_left_1;
        $seller_left_1->save();


        $seller_left_2 = Widget::where('code', 'seller_left_2')->first();
        $seller_left_2->image = $image_left_2;
        $seller_left_2->url_link = $request->text_left_2;
        $seller_left_2->save();


        $seller_left_3 = Widget::where('code', 'seller_left_3')->first();
        $seller_left_3->image = $image_left_3;
        $seller_left_3->url_link = $request->text_left_3;
        $seller_left_3->save();


        $seller_right_1 = Widget::where('code', 'seller_right_1')->first();
        $seller_right_1->image = $image_right_1;
        $seller_right_1->url_link = $request->text_right_1;
        $seller_right_1->save();


        $seller_right_2 = Widget::where('code', 'seller_right_2')->first();
        $seller_right_2->image = $image_right_2;
        $seller_right_2->url_link = $request->text_right_2;
        $seller_right_2->save();


        $seller_right_3 = Widget::where('code', 'seller_right_3')->first();
        $seller_right_3->image = $image_right_3;
        $seller_right_3->url_link = $request->text_right_3;
        $seller_right_3->save();












        toastr()->success('', 'Insert data success', [
            'timeOut' => '1000'
        ]);
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slideIndex(Request $request)
    {

        if ($request->ajax()) {
            $data = Widget::where('widget_type', 'slide')->get();
            $data = $alldata = json_decode($data->toJson());
            //return $request->all();
            $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

            // search filter by keywords
            $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
                ? $datatable['query']['generalSearch'] : '';
            if (!empty($filter)) {
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

            $sort  = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
            $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'RecordID';

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
        return view('backend.widgets.slide');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slidePost(Request $request)
    {

        $this->validate($request, [
            'image'         => 'image|dimensions:min_width=779,min_height=400',
        ]);


        $value = 'images/placeholder.png';
        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->name, '/images/slides', false, true);
        }
        $enabled = 0; //Set Disable
        //Set Enable
        if ($request->enable == 'on') {
            $enabled = 1;
        }
        Widget::create([
            'image' => $value,
            'url_link' => $request->url_link,
            'widget_type' => 'slide',
            'enable'    =>  $enabled
        ]);
        toastr()->success('', 'Insert data success', [
            'timeOut' => '1000'
        ]);
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slideEdit($id)
    {
        $data = Widget::find($id);
        return view('backend.widgets.editSlide', compact('data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slideDestroy($id)
    {
        $destroy = Widget::find($id);
        $destroy->delete();

        toastr()->success('', 'Delete data success.', [
            'timeOut' => '1000'
        ]);

        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bannerIndex(Request $request)
    {
        if ($request->ajax()) {
            $data = Widget::where('widget_type', 'banner')->get();
            $data = $alldata = json_decode($data->toJson());
            //return $request->all();
            $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);

            // search filter by keywords
            $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
                ? $datatable['query']['generalSearch'] : '';
            if (!empty($filter)) {
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

            $sort  = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
            $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'RecordID';

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
        return view('backend.widgets.banner');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bannerPost(Request $request)
    {
        $this->validate($request, [
            'image'         => 'image|dimensions:height=195',
        ]);


        $value = 'images/placeholder.png';
        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->name, '/images/banner', false, true);
        }
        $enabled = 0; //Set Disable
        //Set Enable
        if ($request->enable == 'on') {
            $enabled = 1;
        }
        Widget::create([
            'image' => $value,
            'url_link' => $request->url_link,
            'widget_type' => 'banner',
            'enable'    =>  $enabled
        ]);
        toastr()->success('', 'Insert data success', [
            'timeOut' => '1000'
        ]);
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bannerEdit($id)
    {
        $data = Widget::find($id);
        return view('backend.widgets.editBanner', compact('data'));
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bannerUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'image'         => 'image|dimensions:height=195',
        ]);
        $value = $request->old_image;

        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->name, '/images/banner', false, true);
        }
        $enabled = 0; //Set Disable
        //Set Enable
        if ($request->enable == 'on') {
            $enabled = 1;
        }
        $update = Widget::find($id);
        $update->image = $value;
        $update->url_link = $request->url_link;
        $update->enable = $enabled;
        $update->save();

        toastr()->success('', 'Save data success', [
            'timeOut' => '1000'
        ]);
        return redirect()->route('admin.widgets.banner.edit', $id);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slideUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'image'         => 'image|dimensions:min_width=779,min_height=400',
        ]);
        $value = $request->old_image;

        if ($request->hasFile('image')) {
            $value = uploading()->uploadFiles('image', $request->name, '/images/slides', false, true);
        }
        $enabled = 0; //Set Disable
        //Set Enable
        if ($request->enable == 'on') {
            $enabled = 1;
        }
        $update = Widget::find($id);
        $update->image = $value;
        $update->url_link = $request->url_link;
        $update->enable = $enabled;
        $update->save();

        toastr()->success('', 'Save data success', [
            'timeOut' => '1000'
        ]);
        return redirect()->route('admin.widgets.slide.edit', $id);
    }
}
