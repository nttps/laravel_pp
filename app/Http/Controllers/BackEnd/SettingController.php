<?php

namespace NttpsApp\Http\Controllers\Backend;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Setting;

class SettingController extends Controller
{
    public function general()
    {
        $setting_genarals = Setting::orderBy('sorting_number')->where('groups', 'general')->get();
        $setting_socials = Setting::orderBy('sorting_number')->where('groups', 'social')->get();
        return view('backend.pages.settings', compact('setting_genarals', 'setting_socials'));
    }
    public function generalPost(Request $request)
    {
        foreach (array_except($request->toArray(), ['_token']) as $name => $value) {

            if ($request->hasFile($name)) {
                $value = uploading()->uploadFiles($name, $name, 'images/settings');
            }
            Setting::where('name', $name)->firstOrFail()->update(['value' => $value]);
        }

        toastr()->success('', 'Saved success', [
            'timeOut' => '1000'
        ]);
        return redirect()->back();
    }
    public function shopIndex(){
        $this->middleware('permission:setting-shop-view');
        $shop_setups = Setting::orderBy('sorting_number')->where('groups' , 'shop_setup')->get();
        $states      = getState();
        $shipping_zones = ShippingZone::all();
        $banks = Bank::all();
        return view('backend.settings.shop.index' , compact('shop_setups' , 'states' , 'shipping_zones' , 'banks'));
    }
    public function shopPost(Request $request){

        foreach (array_except($request->toArray(), ['_token']) as $name => $value) {

            if($request->hasFile($name)){
                $value = uploading()->uploadFiles($name , $name , 'images/settings');
            }
            Setting::where('name' , $name)->firstOrFail()->update(['value' => $value]);
        }

        toastr()->success('','Saved success', [
            'timeOut'=> '1000'
        ]);
        return redirect()->back();
    }
    public function shippingIndex($id){
        $shipping_zone = ShippingZone::find($id);
        $shipping_zone_value = $shipping_zone->values()->get();
        $shipping_zone_rules = $shipping_zone->rules()->first();
        $states      = getState();
        return view('backend.settings.shop.shipping.index' , compact('shipping_zone' , 'states' , 'shipping_zone_value' , 'shipping_zone_rules'));
    }
    public function shippingEdit(Request $request , $id){

        $shipping_zone = ShippingZone::find($id);
        $shipping_zone->name                           =       $request->name;
        $shipping_zone->type                           =       $request->type;
        $shipping_zone->options                         =       $request->advance_option;
        
        //dd($name, $type ,$zip_value , $state_value);
        if($shipping_zone->type === "ADVANCED"){
            $state_value_select             =       $request->advance_state_value;  
        }
        if($shipping_zone->type === "STATE"){
            $state_value_select             =        $request->state_value_select;
        }
        ShippingZoneValue::where('shipping_zone_id', $id)->delete();
        if (is_array($state_value_select)){
            foreach ($state_value_select as $value) {
                ShippingZoneValue::create([
                    'shipping_zone_id'  => $id ,
                    'province_id'       => $value
                ]);
            }
        }else{
            ShippingZoneValue::create([
                'shipping_zone_id'  => $id ,
                'province_id'       => $state_value_select
            ]);
        }
        toastr()->success('','Edited Shipping Zone', [
            'timeOut'=> '1000'
        ]);
        return redirect()->back();
    }
    public function shippingDelete(Request $request){
        $shipping_zone = ShippingZone::find($request->id);
        $shipping_zone->delete();
        toastr()->success('','Removed Shipping Zone', [
            'timeOut'=> '1000'
        ]);
        return response()->json(['status' => 'success']);
    }

    public function shippingRuleEdit(Request $request , $id){
        $shipping_rule = ShippingRule::find($id);
        if($request->type == 'free-shipping'){
            $price = 0;
            if($request->limit_free_shipping == 'yes'){
                $price = $request->price;
            }

            //dd($price);

            $rules = array([
                'price' => $price,
                'limit_free_shipping' => $request->limit_free_shipping,
                'fixed_cost' => $request->fixed_cost,
            ]);

            $json_rules = json_encode($rules);
            //dd($json_rules);
            $shipping_rule->name = $request->name;
            $shipping_rule->method = $request->type;
            $shipping_rule->rules = $json_rules;
        }
        if($request->type == 'shipping-choice'){
            
            foreach ($request->name_choice as $key => $value) {
                $rules['name'][]    = $value;
                $rules['days'][]    = $request->days_choice[$key];
                $rules['price'][]    = $request->price_choice[$key];
                # code...
            }
            //dd($rules);
            $json_rules = json_encode($rules);

            $shipping_rule->name = $request->name;
            $shipping_rule->method = $request->type;
            $shipping_rule->rules = $json_rules;

        }
        if($request->type == 'shipping-order'){

            foreach ($request->from_order as $key => $value) {
                $rules['from_order'][]    = $value;
                $rules['upto_order'][]    = $request->upto_order[$key];
                $rules['price_order'][]    = $request->price_order[$key];
                # code...
            }
            $json_rules = json_encode($rules);

            $shipping_rule->name = $request->name;
            $shipping_rule->method = $request->type;
            $shipping_rule->rules = $json_rules;

        }
        $shipping_rule->save();
        toastr()->success('','Edited Shipping Rules', [
            'timeOut'=> '1000'
        ]);
        return redirect()->back();
    }
}
