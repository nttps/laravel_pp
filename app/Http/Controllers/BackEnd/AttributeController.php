<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Attribute;
use NttpsApp\Models\AttributeValue;
use NttpsApp\Http\Requests\AttributeRequest;
use NttpsApp\Http\Requests\AttributeValueRequest;

class AttributeController extends Controller
{

    private $folder_view = 'backend.pages.products.attributes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view($this->folder_view .'index' , compact('attributes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
       

        $attribute = Attribute::create([
            'name' => $request->name,
        ]);
        $dataValue = explode( ',' ,$request->value);

        foreach($dataValue as $value){
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'name' => $value
            ]);
        }
        return redirect()->back();
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $attribute = Attribute::find($id);
        return view($this->folder_view .'edit', compact('attribute'));
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
        $attribute = Attribute::find($id);
        $attribute->name = $request->name;
        $attribute->save();
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
        $postCate = Attribute::find($id);
        $postCate->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editValueAttribute(Request $request , $id)
    {

        //dd($request->all());
        $isExists = AttributeValue::where('attribute_id' , $request->id)->where('name' , $request->name)->first();

        if($isExists){
            return 'failed';
        }
        $value = AttributeValue::find($id);
        $value->name = $request->name;
        $value->save();
        return 'success';
        

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateValueAttribute(Request $request , $id)
    {
        AttributeValue::create([
            'attribute_id' => $id,
            'name' => $request->name
        ]);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteValueAttribute($id)
    {
        $postCate = AttributeValue::find($id);
        $postCate->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    
}
