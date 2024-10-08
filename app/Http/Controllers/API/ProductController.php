<?php

namespace NttpDev\Http\Controllers\API;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\Model\OptionProduct;
use NttpDev\Model\OptionProductValue;
use NttpDev\Model\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOption(Request $request){

        $option = OptionProduct::withCount('children')->with('children')->find($request->option_id);
        $name_sub_option = $option->children()->first()->option_name;
        $children_count = $option->children()->withCount('children')->first()->children_count;
        
        $values = OptionProductValue::where('parent_id' ,$request->id)->withCount('children')->with('option')->get();
        return response()->json(['status' => 'success', 'option_sub_name' => $name_sub_option , 'children_count' => $children_count , 'data' => $values]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProduct(Request $request){
        $product = Product::where('product_type', 'option_product')->where('option_product_value_id' ,$request->value_id )->where('option_product_id' ,$request->option_id)->first();
        return response()->json(['status' => 'success', 'data' => $product]);
    }
    

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductToCompare(Request $request){


      //dd($request->data);
        $product = Product::find($request->data);
        $short_description = ($product->short_description != '') ? $product->short_description : 'No';
        $attribute_tr = '';
        $price ='ราคา ' .$product->price .' บาท';
        if($product->discount_price != null || $product->discount_price != ''){
            $price = '<div class="d-inline-block"> ราคาเต็ม '.$product->price.' บาท </div> <div class="sale_price text-danger"> ลดเหลือ '.$product->discount_price.' บาท</div>';

        }
        if($product->shipping_price == NULL || $product->shipping_price == 0){
            $shipping_price = 'ไม่มีค่าจัดส่ง';
        }else{
            $shipping_price = $product->shipping_price;
        }
        if($product->is_option == 1) {
            $btn = '<button onclick="location.href=\''.route('products.show' , $product->slug).'\'" class="btn btn-danger"><i class="fas fa-shopping-cart"></i> ดูรายละเอียดสินค้า</button>';
            $price = $product->getRealPriceAttribute();
        }else{
            $btn = '<button data-id="308" data-type="product" class="btn btn-danger btn-cart"><i class="fas fa-shopping-cart"></i> ซื้อทันที</button>';
        }
        foreach($product->attributes()->get() as $attribute){
            $attribute_tr .= '<tr>
                <td style="vertical-align: top;">'.$attribute->name .'</td>
                <td style="vertical-align: top;text-align: left;word-break: break-word;">'.$attribute->pivot->attribute_value .'</td>
            </tr>';
        }
        $div = '<div class="col-3 compareItemParent relPos" id="'.$product->id.'">
            <ul class="product">
                <li class="compHeader">
                    <a class="remove selectedItemCloseBtn rotateBtn text-danger" data-id="'.$product->id.'" href="javascript:void(0)"><i class="far fa-times-circle"></i></a>
                    <img src="'.\Storage::url($product->image).'" class="compareThumb">
                </li>
                <li>'.$product->name.'</li>
                <li>'.$price.'</li>
                <li>'.$shipping_price.'</li>
                <li class="cpu">
                    <table class="table" style="width:100%">'.$attribute_tr.'</table>
                </li>
                <li>'.$btn.'
                    
                </li>
            </ul>
        </div>';
        return $div;
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductFrmCookie(Request $request){

//dd($request->data);
          $products = Product::whereIn( 'id' ,$request->data)->get();
         
          $div = '';
          foreach($products  as $product){
            $short_description = ($product->short_description != '') ? $product->short_description : 'No';
            $attribute_tr = '';
            $price = 'ราคา ' .$product->price .' บาท';
            if($product->discount_price != null || $product->discount_price != ''){
                $price = '<div class="d-inline-block"> ราคาเต็ม '.$product->price.' บาท </div> <div class="sale_price text-danger"> ลดเหลือ '.$product->discount_price.' บาท</div>';
    
            }
            if($product->shipping_price == NULL || $product->shipping_price == 0){
                $shipping_price = 'ไม่มีค่าจัดส่ง';
            }else{
                $shipping_price = $product->shipping_price;
            }
            if($product->is_option == 1) {
                $btn = '<button onclick="location.href=\''.route('products.show' , $product->slug).'\'" class="btn btn-danger"><i class="fas fa-shopping-cart"></i> ดูรายละเอียดสินค้า</button>';
                $price = $product->getRealPriceAttribute();
            }else{
                $btn = '<button data-id="308" data-type="product" class="btn btn-danger btn-cart"><i class="fas fa-shopping-cart"></i> ซื้อทันที</button>';
            }
            foreach($product->attributes()->get() as $attribute){
                $attribute_tr .= '<tr>
                    <td style="vertical-align: top;">'.$attribute->name .'</td>
                    <td style="vertical-align: top;text-align: left;word-break: break-word;">'.$attribute->pivot->attribute_value .'</td>
                </tr>';
            }
            $div .= '<div class="col-3 compareItemParent relPos" id="'.$product->id.'">
                <ul class="product">
                    <li class="compHeader">
                        <a class="remove selectedItemCloseBtn rotateBtn text-danger" data-id="'.$product->id.'" href="javascript:void(0)"><i class="far fa-times-circle"></i></a>
                        <img src="'.\Storage::url($product->image).'" class="compareThumb">
                    </li>
                    <li>'.$product->name.'</li>
                    <li>'.$price.'</li>
                    <li>'.$shipping_price.'</li>
                    <li class="cpu">
                        <table class="table" style="width:100%">'.$attribute_tr.'</table>
                    </li>
                    <li>'.$btn.'
                        
                    </li>
                </ul>
            </div>';
          }
          
          return $div;
         
      }
    
}
