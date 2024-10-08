<?php

namespace NttpDev\Http\Controllers\API;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use DB;

class getAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $val = $request->id;
        $type = $request->type;
        if($type == 'getProvince'){
            if($val == 'TH'){
                $provinces = DB::table('provinces')->get()->toArray();
                return response()->json(['status' => 'success', 'data' => $provinces]);
            }
            return response()->json(['status' => 'failed']);
        }else if($type == 'getAmphures'){
            $amphures = DB::table('amphures')->where('province_id' , $val)->get()->toArray();
            return response()->json(['status' => 'success', 'data' => $amphures]);
        }else if($type == 'getTumbon'){
            $amphures = DB::table('districts')->where('amphure_id' , $val)->get()->toArray();
            return response()->json(['status' => 'success', 'data' => $amphures]);
        }
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
