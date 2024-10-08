<?php

namespace NttpsApp\Http\Controllers\Backend\API;

use Illuminate\Http\Request;
use NttpsApp\Http\Controllers\Controller;
use NttpsApp\Models\Attribute;
use NttpsApp\Models\AttributeValue;
use NttpsApp\Models\Product;
use NttpsApp\Models\ProductVariant;
use NttpsApp\Models\Product\ModelProduct;
use NttpsApp\Models\Product\ModelProductVarientAttibute;
use NttpsApp\Models\Product\ModelProductAttributeValue;
use NttpsApp\Models\Product\ModelProductAttribute;

class AjaxDataController extends Controller
{
    public function index(Request $request){
        $action = $request->action; //set action to variable

        switch ($action) {
            case 'add_attribute_to_product':
                return $this->addAttributeToProduct($request);
                break;
            case 'save_attributes':
                return $this->saveAttributeBox($request);
                break;
            case 'remove_attribute':
                return $this->removeAttributeBox($request);
                break;
            case 'add_variation':
                return $this->addVarientProduct($request);
                break;
            case 'save_options':
                return $this->saveVariationProduct($request);
                break;
            case 'save_product_options':
                $values = array();
                parse_str($request->data, $values);
                return $this->saveOptionProduct($values);
                break;
            default:
                return 'no';
                break;
        }
    }

    public function addAttributeToProduct($data){

        $select_attribute   =               $data->attribute_id;
        $setIDToDiv         =               $data->i;
        $table              =               '';
        if ($select_attribute != null) {

            $attribute = Attribute::find($select_attribute);
            $array_value = AttributeValue::where('attribute_id',$attribute->id)->get();
            $table .=  '<table class="table_attribute">
                <tr>
                    <td class="attribute_name"><label>ชื่อคุณสมบัติ:</label> <strong>' . $attribute->name . '</strong><input type="hidden" name="attribute_id[' . $setIDToDiv . ']" value="' . $attribute->id . '"></td>
                    <td rowspan="3"><label>เลือกคุณสมบัติ:</label><select class="attribute_value form-control m-select2" name="attribute_value_id[' . $setIDToDiv . '][]" multiple="multiple">';
            foreach ($array_value as $value) {
                $table .= '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
            $table .= '</select></td>
                </tr>
                <tr>
                    <td>
                        <div class="m-checkbox-inline">
                            <label class="m-checkbox">
                                <input type="checkbox" class="enable_visible" name="enable_visible[' . $setIDToDiv . ']" value="1" checked="checked" style="font-size: 14px;">
                                    แสดงผลหน้ารายละเอียดสินค้า
                                <span></span>
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="m-checkbox-inline enable_option_product">
                            <label class="m-checkbox">
                                <input type="checkbox" class="checkbox_enable_option_product" name="enable_option_product[' . $setIDToDiv . ']"  value="1" style="font-size: 14px;">
                                    ใช้เป็นคุณสมบัติของสินค้าตัวเลือก
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
    }
    protected function saveAttributeBox($request)
    {
        if (isset($request->data)) {
            $params = array();
            parse_str($request->data, $params);
            $i = 0;
            foreach ($params['attribute_id'] as $key => $value) {
                $product_attribute = ModelProductAttribute::where('model_product_id' , $request->data_id)->where('attribute_id' , $value)->first();
        
                if(empty($product_attribute)){
                    $product_attribute = ModelProductAttribute::create([
                        'model_product_id' => $request->data_id , 
                        'attribute_id' => $value,
                        'enable_visible' => $params['enable_visible'][$key] ?? 0, 
                        'enable_varient' => $params['enable_option_product'][$key] ?? 0
                    ]);
                  
                }else{
                    $product_attribute->enable_visible = !empty($params['enable_visible'][$key]) ? 1: 0;
                    $product_attribute->enable_varient = !empty($params['enable_option_product'][$key]) ? 1: 0;
                    $product_attribute->save();

                }
                ModelProductAttributeValue::where('model_product_attribute_id' , $product_attribute->id)->delete();
                foreach($params['attribute_value_id'][$key] as $attribute_value_id) {
                    ModelProductAttributeValue::create([
                        'model_product_attribute_id' => $product_attribute->id , 
                        'attribute_value_id' => $attribute_value_id
                    ]);
                }
            }
           
        }
    }
    protected function removeAttributeBox($request)
    {
        if (isset($request->id)) {        
            ModelProductAttribute::find($request->id)->delete();
            return response()->json(['status' => 'success']);           
        }
    }
    public function addVarientProduct($data){
        $setIDToDiv         =               $data->loop;
        $data = ModelProduct::find($data->data_id);
        $options_product = $data->attribute_varients();

      
        $form = '';
        $form .= '<form class="addoptionProductFrom"><div class="m-portlet m-portlet--head-solid-bg m-portlet--head-sm option_product_value" m-portlet="true" id="m_portlet_tools_0">
            <div class="m-portlet__head m-portlet__sm ">
                <div class="m-portlet__head-caption">
                    <div class="form-group m-form__group row pb-0">';

                   
        foreach ($options_product as $option_product) {
            
            $form .= '             
        <label class="col-form-label text-left col-lg-auto col-sm-12">' . $option_product->attribute->name . '</label>
        <div class="col-lg-3 col-md-3 col-sm-12">  
       
        <select name="option_value[' . $setIDToDiv . '][]" class="option_value form-control d-inline-block" required>
                                <option value="">เลือก</option>';
            foreach ($option_product->values as $optionvalue) {
            
               
                $form .=                        '<option value="' . $optionvalue->id . '">' . $optionvalue->value->name . '</option>';
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
                    <div class="row"> 
                        <div class="col-12 col-md-6">
                            <div class="form-group m-form__group row">
                                        
                                <label for="SKU" class="col-form-label col-lg-2 col-md-2 col-sm-12">SKU</label>
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    <input type="text" name="sku_varient[' . $setIDToDiv . ']" class="form-control m-input" id="SKU" aria-describedby="SKUHelp" placeholder="รหัส SKU ของสินค้า ตัวอย่าง E-1001-SM" value="" required>
                                </div>                        
                               
                        
                            </div>                            
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group m-form__group row">
                                <label for="stock" class="col-form-label col-lg-2 col-md-2 col-sm-12">คลังสินค้า</label>
                                <div class="col-lg-auto col-md-auto col-sm-12">
                                    <div class="m-checkbox-inline">
                                        <label class="m-checkbox">
                                            <input type="checkbox" value="1"> ระบุจำนวน
                                            <span></span>
                                        </label>
                                    </div>
                                    
                                
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input type="text" name="stock_varient[' . $setIDToDiv . ']" class="form-control m-input" id="Stock" aria-describedby="StockHelp" placeholder="ระบุจำนวนสินค้าในคลัง" value="">
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group m-form__group row">
                                <label for="regular_price" class="col-form-label col-lg-2 col-md-2 col-sm-12">ราคาสินค้า</label>
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    <input type="text" name="regular_price_varient[' . $setIDToDiv . ']" class="form-control m-input" id="regular_price" aria-describedby="SKUHelp" placeholder="ราคาสินค้า" value="" required>
                                </div>                                                          
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group m-form__group row">
                                <label class="col-form-label col-lg-auto col-sm-12">ลดราคาสินค้า</label>
                                <div class="col-lg-2 col-md-2 col-sm-12">                                
                                    <span class="m-bootstrap-switch m-bootstrap-switch--pill">
                                        <input data-switch="true" type="checkbox" name="sale_price_enable[' . $setIDToDiv . ']" data-on-color="brand" class="sale_price_enable">
                                    </span>
                                </div>
                                <label for="sale_price" class="col-form-label col-lg-2 col-md-2 col-sm-12 sale_price" style="display:none">ลดเหลือ</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input type="text" name="sale_price_varient[' . $setIDToDiv . ']" class="form-control m-input sale_price" style="display:none" aria-describedby="sale_priceHelp" placeholder="ราคา" value="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <div class="form-group m-form__group row">
                                <label for="shipping_price" class="col-form-label col-lg-2 col-md-2 col-sm-12">ค่าจัดส่ง</label>
                                <div class="col-lg-10 col-md-10 col-sm-12">
                                    <input type="text" name="shipping_price_varient[' . $setIDToDiv . ']" class="form-control m-input" id="shipping_price" aria-describedby="SKUHelp" placeholder="ค่าจัดส่งสินค้า (ถ้ามี)" value="">
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div></form>';

        return $form;

    }

    protected function saveVariationProduct($request)
    {
        $product = ModelProduct::find($request->data_id);
        if (isset($request->data)) {
            $params = array();
            parse_str($request->data, $params);
            $name = '';
            $id = null;
            foreach ($params['option_value'] as $keyOption => $value) {
                $i = 0;
                foreach ($value as $attibute_value) {
                    $attribute_value_data =  ModelProductAttributeValue::find($attibute_value);
                    
                    if ($attribute_value_data) {
                        $name .= $attribute_value_data->value->name. ' ';
                        
                    } else {         
                        return response()->json(['status' => 'failed', 'message' => 'กรุณาเลือกคุณสมบัติก่อนเพิ่มสินค้า']);
                        //unset($params['option_value'][$key]);
                    }

                    if($i === 0){
                        $inventory_quantity =   empty($params['stock_varient'][$keyOption]) ? NULL : $params['stock_varient'][$keyOption];
                        $sale_price =  empty($params['sale_price_varient'][$keyOption]) ? NULL : $params['sale_price_varient'][$keyOption];
                        $shipping_price =  empty($params['shipping_price_varient'][$keyOption]) ? NULL : $params['shipping_price_varient'][$keyOption];
        
                        //$product = Product::where('product_parent', $request->data_id)->first();
        
        
                        $data =  new ModelProduct;
                        $data->sku = $params['sku_varient'][$keyOption];
                        $data->regular_price = $params['regular_price_varient'][$keyOption];
                        $data->sale_price =  $sale_price;
                        $data->shipping_price = $shipping_price;
                        $data->stock = $inventory_quantity;
                        $data->type =  'variable';     
                        $data->parent_id =  $request->data_id;  
                        $data->save();    

                        $id = $data->id;
                        
                    }
                    ModelProductVarientAttibute::create([
                        'model_product_id' => $request->data_id,
                        'model_varient_id' => $id,
                        'product_attribute_id' => $attribute_value_data->product_attribute->id,
                        'product_attribute_value_id' => $attibute_value,
                    ]);  

                    $i++;
                }
                return response()->json(['status' => 'success']);
            }
        }
    }
    protected function saveOptionProduct($request)
    {
       
        foreach ($request['option_id'] as $key => $option_id) {
            //dd($request->is_show );

            $SKU                =   isset($request['sku_varient'][$key]) ? $request['sku_varient'][$key] : NULL;
            $enable_stock       =   NULL;
            $inventory_quantity =   NULL;
            $regularPrice       =   empty($request['regular_price_varient'][$key]) ? NULL : $request['regular_price_varient'][$key];
            $salePrice          =   empty($request['sale_price_varient'][$key]) ? NULL : $request['sale_price_varient'][$key];
            $shippingPrice      =   empty($request['shipping_price_varient'][$key]) ? NULL : $request['shipping_price_varient'][$key];

            if (isset($request['enable_stock_varient'][$key])) {
                if ($request['enable_stock_varient'][$key] == 'on') {
                    $enable_stock   =   1;
                }
                
                $inventory_quantity = $request['stock_varient'][$key];
            }
            $data   =   ModelProduct::find($option_id);
            $data->stock       = $inventory_quantity;
            $data->regular_price                    = $regularPrice;
            $data->sale_price           = $salePrice;
            $data->shipping_price           =  $shippingPrice;
            $data->sku                          = $SKU;
            //$data->enable_stock                 = $enable_stock;

            $data->save();
        }
        return response()->json(['status' => 'success']);
    }

}
