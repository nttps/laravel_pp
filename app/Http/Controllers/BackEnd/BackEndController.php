<?php

namespace NttpDev\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\Attribute;
use NttpDev\Model\AttributeProduct;
use NttpDev\Model\Product;
use NttpDev\Model\OptionProduct;
use NttpDev\Model\OptionProductValue;
use NttpDev\Model\VariantProduct;
use NttpDev\Model\ShippingZone;
use NttpDev\Model\ShippingZoneValue;
use NttpDev\Model\ShippingRule;
use NttpDev\Model\Category;
use NttpDev\Model\Order;
use NttpDev\Model\Bank;
use NttpDev\User;

class BackEndController extends Controller
{
    public function index()
    {


        $staticOrder = Order::count();
        $staticUser = User::count();
        $staticProduct = Product::whereNull('product_parent')->count();

        $lastestProduct = Product::whereNull('product_parent')->orderBy('created_at', 'DESC')->take(6)->get();

        return view('backend.dashboard', compact('staticOrder', 'staticUser', 'staticProduct', 'lastestProduct'));
    }

    protected function ajaxLoad(Request $request)
    {

        $action = $request->action; //set action to variable


        $result = null;
        if ($action == 'pp_add_attribute') {
            $result = $this->AddAttributeBox($request);
        }
        if ($action == 'pp_save_attributes') {
            $result = $this->SaveAttributeBox($request);
        }
        if ($action == 'pp_add_variation') {
            $result = $this->AddVarisationFrom($request);
        }
        if ($action == 'pp_save_options') {
            $result = $this->AddVariationProduct($request);
        }
        if ($action == 'add_shipping_zone') {
            $values = array();
            parse_str($request->data, $values);
            $result =   $this->AddShippingZone($values);
        }
        if ($action == 'add_bank') {
            $values = array();
            parse_str($request->data, $values);
            $result =   $this->AddBank($values);
        }
        if ($action == 'edit_bank') {
            $values = array();
            parse_str($request->data, $values);
            $result =   $this->EditBank($values);
        }
        if ($action == 'add_shipping_rule') {
            $result =   $this->AddShippingRule($request);
        }
        if ($action == '_changeStatus') {
            $result =   $this->ChangeStatusProduct($request);
        }
        if ($action == '_changeStatusCategories') {
            $result =   $this->ChangeStatusCategories($request);
        }
        if ($action == 'remove_option') {
            $result =   $this->removeOption($request);
        }
        // if($action == 'remove_attribute'){
        //     $result =   $this->removeAttribute($request);
        // }
        if ($action == 'pp_save_product_options') {
            $values = array();
            parse_str($request->data, $values);
            $result =   $this->saveOptionProduct($values);
        }
        if ($action == 'attribute_order') {
            $values = array();
            parse_str($request->data, $values);
            $result =   $this->attributeOrder($values);
        }



        return $result;
    }

    protected function AddAttributeBox($request)
    {
        $select_attribute   =               $request->attribute_id;
        $setIDToDiv         =               $request->i;
        $table              =               '';
        if ($select_attribute != null) {

            $attribute = Attribute::find($select_attribute);
            $array_value = array();
            $array_value = explode(',', $attribute->value);
            $table .=  '<table class="table_attribute">
                <tr>
                    <td class="attribute_name"><label>Name:</label> <strong>' . $attribute->name . '</strong><input type="hidden" name="name_attribute[' . $setIDToDiv . ']" value="' . $attribute->id . '"></td>
                    <td rowspan="3"><label>Value(s):</label><select class="attribute_value form-control m-select2" name="attribute_value[' . $setIDToDiv . '][]" multiple="multiple">';
            foreach ($array_value as $value) {
                $table .= '<option value="' . htmlentities($value) . '">' . $value . '</option>';
            }
            $table .= '</select></td>
                </tr>
                <tr>
                    <td>
                        <div class="m-checkbox-inline">
                            <label class="m-checkbox">
                                <input type="checkbox" class="enable_visible" name="enable_visible[' . $setIDToDiv . ']" value="1" checked="checked" style="font-size: 14px;">
                                    Visible on the product page
                                <span></span>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="m-checkbox-inline enable_option_product">
                            <label class="m-checkbox">
                                <input type="checkbox" class="checkbox_enable_option_product" name="enable_option_product[' . $setIDToDiv . ']" style="font-size: 14px;">
                                    Use for option product
                                <span></span>
                            </label>
                        </div>
                    </td>
                </tr>
            </table>';
            $box = '<div class="attribute m-portlet m-portlet--head-solid-bg m-portlet--head-sm taxonomy" data-taxonomy="' . $attribute->id . '" m-portlet="true" id="m_portlet_tools_' . $setIDToDiv . '">';
            $box .= '<div class="m-portlet__head m-portlet__sm ">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h4 class="m-portlet__head-text">
                                ' . $attribute->name . '
                            </h4>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>	
                            </li>
                            <li class="m-portlet__nav-item">
                                <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon remove_row"><i class="la la-close"></i></a>	
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">' . $table . '</div>';
            $box .= '</div>';
            return $box;
        }
        $table .=  '<table class="table_attribute">
            <tr>
                <td class="attribute_name"><label>Name:</label><input type="text" name="name_attribute[' . $setIDToDiv . ']" class="form-control m-input name_attribute"></td>
                <td rowspan="3"><label>Value(s):</label><textarea name="name_attribute[' . $setIDToDiv . ']" class="form-control m-input" cols="5" rows="5" placeholder="Enter some text, or some attributes by , separating values."></textarea></td>
            </tr>
            <tr>
                <td>
                    <div class="m-checkbox-inline">
                        <label class="m-checkbox">
                            <input type="checkbox" class="enable_visible" name="enable_visible[' . $setIDToDiv . ']" value="1" checked="checked" style="font-size: 14px;">
                                Visible on the product page
                            <span></span>
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="m-checkbox-inline">
                        <label class="m-checkbox">
                            <input type="checkbox" class="checkbox_enable_option_product" name="enable_option_product[' . $setIDToDiv . ']" style="font-size: 14px;">
                                Use for option product
                            <span></span>
                        </label>
                    </div>
                </td>
            </tr>
        </table>';
        $box = '<div class="attribute m-portlet m-portlet--head-solid-bg m-portlet--head-sm" m-portlet="true" id="m_portlet_tools_' . $setIDToDiv . '">';
        $box .= '<div class="m-portlet__head m-portlet__sm ">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        </h4>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="#" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>	
                        </li>
                        <li class="m-portlet__nav-item">
                            <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon remove_row"><i class="la la-close"></i></a>	
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">' . $table . '</div>';
        $box .= '</div>';

        return $box;
    }

    protected function SaveAttributeBox($request)
    {
        if ($request->product_type == 'selectedproduct') {
            $product = Product::find($request->data_id);
            $product->is_option = 1;
            $product->save();
        } else {
            $product = Product::find($request->data_id);
            $product->is_option = 0;
            $product->save();
        }
        AttributeProduct::where('product_id', $request->data_id)->delete();
        if (isset($request->data)) {
            $params = array();
            parse_str($request->data, $params);
            $i = 0;
            foreach ($params['name_attribute'] as $key => $value) {
                $attribute_value  = null;
                if (!empty($params['attribute_value'][$key])) {
                    $attribute_value = implode(',', array_filter($params['attribute_value'][$key]));
                }
                AttributeProduct::create([
                    'product_id'            =>          $request->data_id,
                    'attribute_id'          =>          $value,
                    'attribute_value'       =>          $attribute_value,
                    'position'              =>          $i,
                    'is_show'               =>          isset($params['enable_visible'][$key]) ? 1 : 0,
                    'is_option'             =>          isset($params['enable_option_product'][$key]) ? 1 : 0,
                ]);
                $i++;
            }
        }
    }
    protected function AddVarisationFrom($request)
    {
        //dd($request);
        $setIDToDiv         =               $request->loop;
        $data = Product::find($request->data_id);
        $options_product = $data->attributes()->where('is_option', 1)->orderBy('position', 'ASC')->get();
        $form = '';
        $form .= '<form class="addoptionProductFrom"><div class="m-portlet m-portlet--head-solid-bg m-portlet--head-sm option_product_value" m-portlet="true" id="m_portlet_tools_0">
            <div class="m-portlet__head m-portlet__sm ">
                <div class="m-portlet__head-caption">
                    <div class="form-group m-form__group row pb-0">';
        foreach ($options_product as $option_product) {

            $form .= '             
        <div class="col-lg-4 col-md-4 col-sm-12">  
        
        <input type="hidden" name="option_name[' . $setIDToDiv . '][]" value="' . $option_product->name . '">
        <select name="option_value[' . $setIDToDiv . '][]" class="option_value form-control d-inline-block" required>
                                <option value="">Any ' . $option_product->name . '</option>';
            $array_optionvalue = explode(',', $option_product->pivot->attribute_value);
            foreach ($array_optionvalue as $optionvalue) {

                $form .=                        '<option value="' . htmlentities($optionvalue) . '">' . $optionvalue . '</option>';
            }
            $form .= '</select>';
            $form .= '</div>';
        }


        $form .= '                </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a data-toggle="collapse" data-parent="#accordion" href="#dd-' . $setIDToDiv . '" aria-expanded="true" aria-controls="dd-' . $setIDToDiv . '" href="#" m-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon"><i class="la la-angle-down"></i></a>	
                        </li>
                        <li class="m-portlet__nav-item">
                            <a href="#" m-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon remove_row"><i class="la la-close"></i></a>	
                        </li>
                    </ul>
                </div>
            </div>
            <div id="dd-' . $setIDToDiv . '" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="dd-' . $setIDToDiv . '">

                <div class="m-portlet__body">
                    <input type="hidden" name="option[' . $setIDToDiv . ']" value="' . $option_product->id . '">
                    
                    <div class="form-group m-form__group row">
                        <label for="SKU" class="col-form-label text-left col-lg-2 col-md-2 col-sm-12">SKU</label>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="SKU_OPTION[' . $setIDToDiv . ']" class="form-control m-input" id="SKU" aria-describedby="SKUHelp" placeholder="Enter SKU" value="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row pt-0 stock-form">
                        <label for="SKU" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Manage stock</label>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="checkbox" class="enable_stock_option" name="enable_stock_option[' . $setIDToDiv . ']">
                                        Enable stock management
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="setStockoption" style="display:none;padding-bottom:15px;">
                        <div class="form-group m-form__group row">
                            <label for="Stock" class="col-form-label col-form-sm col-lg-2 text-left col-md-2 col-sm-12">Stock quantity</label>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <input type="text" name="inventory_quantity_option[' . $setIDToDiv . ']" class="form-control m-input" id="Stock" aria-describedby="StockHelp" value="0">
                            </div>
                        </div>
                    </div>
                        <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_5" role="tablist">                      

                        <!--begin::Item-->              
                            <div class="m-accordion__item m-accordion__item--success">
                                <div class="m-accordion__item-head collapsed " srole="tab" id="m_accordion_5_item_1_head" data-toggle="collapse" href="#m_accordion_5_item_1_body" aria-expanded="false">
                                    <span class="m-accordion__item-icon"><i class="fa 	fa-user"></i></span>
                                    <span class="m-accordion__item-title">User Price</span>
                                        
                                    <span class="m-accordion__item-mode"></span>     
                                </div>

                                <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_1_body" role="tabpanel" aria-labelledby="m_accordion_5_item_1_head" data-parent="#m_accordion_5" style=""> 
                                    <div class="m-accordion__item-content">
                                        <div class="row m--margin-bottom-25">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="RegularPrice">Regular price</label>
                                                    <input type="text" name="regularPrice_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="RegularPrice" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="SalePrice">Sale price</label>
                                                    <input type="text" name="salePrice_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="SalePrice" aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item--> 

                            <!--begin::Item--> 
                            <div class="m-accordion__item m-accordion__item--info">
                                <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_2_head" data-toggle="collapse" href="#m_accordion_5_item_2_body" aria-expanded="false">
                                    <span class="m-accordion__item-icon"><i class="fa	fa-users"></i></span>
                                    <span class="m-accordion__item-title">Distibutor Price</span>
                                        
                                    <span class="m-accordion__item-mode"></span>     
                                </div>

                                <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_2_body" role="tabpanel" aria-labelledby="m_accordion_5_item_2_head" data-parent="#m_accordion_5" style=""> 
                                    <div class="m-accordion__item-content">
                                        <div class="row m--margin-bottom-25">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="regularPrice_Distibutor_option">Regular price</label>
                                                    <input type="text" name="regularPrice_Distibutor_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="regularPrice_Distibutor_option" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="regularPrice_Distibutor_option">Sale price</label>
                                                    <input type="text" name="salePrice_Distibutor_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="regularPrice_Distibutor_option" aria-describedby="SalePriceHelp" placeholder="Enter sale price" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-accordion__item m-accordion__item--brand">
                                <div class="m-accordion__item-head" role="tab" id="m_accordion_5_item_3_head" data-toggle="collapse" href="#m_accordion_5_item_3_body" aria-expanded="true">
                                    <span class="m-accordion__item-icon"><i class="fa fa-user-tie"></i></span>
                                    <span class="m-accordion__item-title">Dealer Price</span>
                                        
                                    <span class="m-accordion__item-mode"></span>     
                                </div>

                                <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_3_body" role="tabpanel" aria-labelledby="m_accordion_5_item_3_head" data-parent="#m_accordion_5" style=""> 
                                    <div class="m-accordion__item-content">
                                        <div class="row m--margin-bottom-25">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="regularPrice_Dealer_option">Regular price</label>
                                                    <input type="text" name="regularPrice_Dealer_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="salePrice_Dealer_option" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="salePrice_Dealer_option">Sale price</label>
                                                    <input type="text" name="salePrice_Dealer_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="salePrice_Dealer_option" aria-describedby="RegularPriceHelp" placeholder="Enter regular price" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                            </div>
                            <!--end::Item-->  
                            <!--begin::Item--> 
                            <div class="m-accordion__item m-accordion__item--shipping">
                                <div class="m-accordion__item-head" role="tab" id="m_accordion_5_item_4_head" data-toggle="collapse" href="#m_accordion_5_item_4_body" aria-expanded="true">
                                    <span class="m-accordion__item-icon"><i class="fa flaticon-truck"></i></span>
                                    <span class="m-accordion__item-title">Shipping Price</span>
                                        
                                    <span class="m-accordion__item-mode"></span>     
                                </div>

                                <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_4_body" role="tabpanel" aria-labelledby="m_accordion_5_item_4_head" data-parent="#m_accordion_5" style=""> 
                                    <div class="m-accordion__item-content">
                                        <div class="row m--margin-bottom-25">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group m-form__group">
                                                    <label for="ShippingPrice">Shipping price</label>
                                                    <input type="text" name="shippingPrice_option[' . $setIDToDiv . ']" class="form-control form-control-sm m-input" id="shippingPrice_option" aria-describedby="shippingPrice_optionHelp" placeholder="Enter shipping price" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                       
                            </div>
                            <!--end::Item-->
                        </div>
                    
                </div>
                
            </div>
        </div></form>';

        return $form;
    }
    protected function AddVariationProduct($request)
    {
        //dd($request);


        $data = Product::find($request->data_id);
        $mainProductID = $data->id;
        if (isset($request->data)) {
            $params = array();
            parse_str($request->data, $params);

            $name = '';

            foreach ($params['option_name'] as $keyOption => $value) {
                $parent_id = NULL;
                $parent_value_id = NULL;
                $i = 0;
                $len = count($params['option_name'][$keyOption]);
                foreach ($params['option_name'][$keyOption] as $keyOptionName => $optionName) {
                    //$testCount = OptionProduct::where('product_id' , $mainProductID)->where('option_name' , $optionName)->count();
                    $option = OptionProduct::where('product_id', $mainProductID)->where('option_name', $optionName)->first();

                    if (!$option) {
                        $option = OptionProduct::create([
                            'product_id' =>  $mainProductID,
                            'option_name' =>  $optionName,
                            'parent_id' => $parent_id
                        ]);
                    }

                    $parent_id = isset($option->id) ? $option->id : NULL;
                    if ($params['option_value'][$keyOption][$keyOptionName] == '') {
                        return response()->json(['status' => 'failed', 'message' => 'Select option to add product']);
                        //unset($params['option_value'][$key]);
                    } else {

                        //dd($optionvalue);
                        $optionvalue = OptionProductValue::where('option_product_id', $option->id)->where('value', $params['option_value'][$keyOption][$keyOptionName])->where('parent_id', $parent_value_id)->first();
                        if ($i == 0) {
                            $optionvalue = OptionProductValue::where('option_product_id', $option->id)->where('value', $params['option_value'][$keyOption][$keyOptionName])->whereNull('parent_id')->first();
                        }
                        if (!$optionvalue) {
                            $optionvalue = OptionProductValue::create([
                                'option_product_id' => $option->id,
                                'value' => $params['option_value'][$keyOption][$keyOptionName],
                                'parent_id' => $parent_value_id

                            ]);
                        }

                        $parent_value_id = isset($optionvalue->id) ? $optionvalue->id : NULL;

                        $name .= $option->option_name . ' ' . $optionvalue->value . ' ';
                    }



                    $i++;
                }

                $enable_stock       =   0;
                $inventory_quantity =   0;

                if (isset($params['enable_stock_option'][$keyOption])) {
                    if ($params['enable_stock_option'][$keyOption] == 'on') {
                        $enable_stock   =   1;
                    }
                    $inventory_quantity = $params['inventory_quantity_option'][$keyOption];
                }
                //$product = Product::where('product_parent', $request->data_id)->first();

                Product::create([
                    'name' => $data->slug . ' ' . trim($name) . '-' . $params['SKU_OPTION'][$keyOption],
                    'slug' => $data->slug . '-' . make_slug($name) . '-' . $params['SKU_OPTION'][$keyOption],
                    'product_type' => 'option_product',
                    'product_parent' => $request->data_id,
                    'option_product_id' => $option->id,
                    'option_product_value_id'  => $optionvalue->id,
                    'price' => $params['regularPrice_option'][$keyOption],
                    'sku'   => $params['SKU_OPTION'][$keyOption],
                    'discount_price'    => $params['salePrice_option'][$keyOption],
                    'dealer_discount_price' =>   $params['salePrice_Dealer_option'][$keyOption],
                    'dealer_price' =>   $params['regularPrice_Dealer_option'][$keyOption],
                    'distibutor_discount_price' =>   $params['salePrice_Distibutor_option'][$keyOption],
                    'distibutor_price' =>   $params['regularPrice_Distibutor_option'][$keyOption],
                    'shipping_price'    => $params['shippingPrice_option'][$keyOption],
                    'inventory_quantity'       => $inventory_quantity,
                    'enable_stock'             => $enable_stock,
                ]);
                // } else {
                //     return response()->json(['status' => 'failed', 'message' => 'This option is product already available.']);
                // }

                // if (empty($params['option_value'][$keyOption])) {
                //    //empty array
                // }
                return response()->json(['status' => 'success']);
            }
        }
    }
    protected function AddVariation($request)
    {

        //dd($request);



        $data = Product::find($request->data_id);
        if ($request->loop == 0) {
            OptionProduct::where('product_id', $request->data_id)->delete();
        }
        $countOption = $data->attributes()->where('is_option', 1)->orderBy('id', 'DESC')->count();
        $options_product = $data->attributes()->where('is_option', 1)->orderBy('id', 'DESC')->get();

        $parent_id = null;

        foreach ($options_product as $key => $option_product) {
            //print_r($option_product);
            $option = OptionProduct::create([
                'product_id' =>  $request->data_id,
                'option_name' =>  $option_product->name,
                'parent_id' => $parent_id
            ]);

            $parent_id = isset($option->id) ? $option->id : NULL;
            $array_optionvalue = explode(',', $option_product->pivot->attribute_value);
            $parent_value_id = NULL;
            foreach ($array_optionvalue as $optionvalue) {
                $optionvalue = OptionProductValue::create([
                    'option_product_id' => $option->id,
                    'value' => $optionvalue,
                    'parent_id' => $parent_value_id

                ]);
                $parent_value_id = isset($optionvalue->id) ? $optionvalue->id : NULL;

                $messages = [
                    'name.unique' => 'Product name has already',
                    'slug.unique' => 'Product slug has already',
                    //'SKU.unique' => 'SKU has already'
                ];


                Product::create([
                    'name' => $data->slug . '-' . $option->option_name . '-' . $optionvalue->value,
                    'slug' => $data->slug . '-' . $option->option_name . '-' . $optionvalue->value,
                    'product_type' => 'option_product',
                    'product_parent' => $request->data_id,
                    'option_product_id' => $option->id,
                    'option_product_value_id'  => $optionvalue->id,
                ]);
            }
        }
    }

    protected function AddBank($values)
    {

        $name                           =       $values['name_bank'];
        $number                           =       $values['number'];
        $bank                           =       $values['bank'];

        Bank::create([
            'name'  => $name,
            'number'       => $number,
            'bank'       => $bank
        ]);

        return response()->json(['status' => 'success']);
    }

    protected function EditBank($values)
    {
        $bank = Bank::find($values['bank_id']);
        $bank->name = $values['name_bank'];
        $bank->number = $values['number'];
        $bank->bank = $values['bank'];

        $bank->save();

        return response()->json(['status' => 'success']);
    }

    ///////////////////////// SHIPPING FUC

    protected function AddShippingZone($values)
    {



        $name                           =       $values['name'];
        $type                           =       $values['type'];
        $advance_option                 =       isset($values['advance_option']) ? $values['advance_option'] : NULL;



        //dd($name, $type ,$zip_value , $state_value);
        if ($type === "ADVANCED") {
            $shippingzone = ShippingZone::create([
                'name' => $name,
                'type' => $type,
                'options' => $advance_option,
            ]);
            $state_value_select             =       $values['advance_' . $advance_option . '_value'];
        }
        if ($type === "STATE") {
            $shippingzone = ShippingZone::create([
                'name' => $name,
                'type' => $type,
                'options' => $advance_option,
            ]);
            $state_value_select             =       $values['state_value_select'];
        }

        if (is_array($state_value_select)) {
            foreach ($state_value_select as $value) {
                ShippingZoneValue::create([
                    'shipping_zone_id'  => $shippingzone->id,
                    'province_id'       => $value
                ]);
            }
        } else {
            ShippingZoneValue::create([
                'shipping_zone_id'  => $shippingzone->id,
                'province_id'       => $state_value_select
            ]);
        }




        return response()->json(['status' => 'success']);
    }
    protected function AddShippingRule($request)
    {
        //dd($request);



        if ($request->type == 'free-shipping') {
            $price = 0;
            if ($request->limit_free_shipping == 'yes') {
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
            ShippingRule::create([
                'shipping_zone_id'  => $request->zone_id,
                'name'              => $request->name,
                'method'            => $request->type,
                'rules'             => $json_rules,
            ]);
        }
        if ($request->type == 'shipping-choice') {

            foreach ($request->name_choice as $key => $value) {
                $rules['name'][]    = $value;
                $rules['days'][]    = $request->days_choice[$key];
                $rules['price'][]    = $request->price_choice[$key];
                # code...
            }
            //dd($rules);
            $json_rules = json_encode($rules);

            ShippingRule::create([
                'shipping_zone_id'  => $request->zone_id,
                'name'              => $request->name,
                'method'            => $request->type,
                'rules'             => $json_rules,
            ]);
        }
        if ($request->type == 'shipping-order') {

            foreach ($request->from_order as $key => $value) {
                $rules['from_order'][]    = $value;
                $rules['upto_order'][]    = $request->upto_order[$key];
                $rules['price_order'][]    = $request->price_order[$key];
                # code...
            }
            $json_rules = json_encode($rules);

            ShippingRule::create([
                'shipping_zone_id'  => $request->zone_id,
                'name'              => $request->name,
                'method'            => $request->type,
                'rules'             => $json_rules,
            ]);
        }
        return redirect()->back();
    }
    protected function ChangeStatusProduct($request)
    {
        if ($request->status == 'true') {
            $product = Product::find($request->data);
            $product->is_show = 1;
            if ($product->save()) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        } else {
            $product = Product::find($request->data);
            $product->is_show = 0;
            if ($product->save()) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        }
    }
    protected function ChangeStatusCategories($request)
    {
        if ($request->status == 'true') {
            $product = Category::find($request->data);
            $product->enable_home = 1;
            if ($product->save()) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        } else {
            $product = Category::find($request->data);
            $product->enable_home = 0;
            if ($product->save()) {
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'failed']);
            }
        }
    }

    protected function removeOption($request)
    {

        $data = OptionProductValue::find($request->id);
        $data->delete();

        return response()->json(['status' => 'success']);
    }
    // protected function removeAttribute($request)
    // {

    //     $data = Attribute::find($request->id);
    //     $data->delete();

    //     return response()->json(['status' => 'success']);
    // }

    protected function saveOptionProduct($request)
    {

        foreach ($request['option_id'] as $key => $option_id) {
            //dd($request->is_show );

            $SKU                =   isset($request['SKU_OPTION'][$key]) ? $request['SKU_OPTION'][$key] : NULL;
            $enable_stock       =   0;
            $inventory_quantity =   0;
            $regularPrice       =   $request['regularPrice_option'][$key];
            $salePrice          =   $request['salePrice_option'][$key];
            $dealer_regularPrice       =   $request['salePrice_Dealer_option'][$key];
            $dealer_salePrice          =   $request['regularPrice_Dealer_option'][$key];
            $distibutor_regularPrice       =   $request['regularPrice_Distibutor_option'][$key];
            $distibutor_salePrice          =   $request['salePrice_Distibutor_option'][$key];
            $shippingPrice      =   $request['shippingPrice_option'][$key];

            if (isset($request['enable_stock_option'][$key])) {
                if ($request['enable_stock_option'][$key] == 'on') {
                    $enable_stock   =   1;
                }
                $inventory_quantity = $request['inventory_quantity_option'][$key];
            }
            $data   =   Product::find($option_id);
            $data->inventory_quantity       = $inventory_quantity;
            $data->price                    = $regularPrice;
            $data->discount_price           = $salePrice;
            $data->shipping_price           =  $shippingPrice;
            $data->distibutor_price             = $distibutor_regularPrice;
            $data->distibutor_discount_price    = $distibutor_salePrice;
            $data->dealer_price                 = $dealer_regularPrice;
            $data->dealer_discount_price        = $dealer_salePrice;
            $data->sku                          = $SKU;
            $data->enable_stock                 = $enable_stock;

            $data->save();
        }
        return response()->json(['status' => 'success']);
    }

    protected function attributeOrder($request)
    {
        $i = 0;

        foreach ($request['m_portlet_tools'] as $value) {
            $attribute = AttributeProduct::find($value);
            $attribute->position = $i;
            $attribute->save();
            $i++;
        }
        return response()->json(['status' => 'success']);
    }
}
