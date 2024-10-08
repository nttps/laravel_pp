<?php

use \NttpDev\Model\Setting as setting;
use \NttpDev\Model\Content as content;

if(!function_exists('uploading')){
    function uploading(){
        return new \NttpDev\Libs\Upload;
    }
}
function filterKeyword($data, $search, $field = '')
{
    $filter = '';
    if (isset($search['value'])) {
        $filter = $search['value'];
    }
    if (!empty($filter)) {
        if (!empty($field)) {

            if (strpos(strtolower($field), 'created_at') !== false) {
                // filter by date range


                $data = filterByDateRange($data, $filter, $field);
            } else {
                // filter by column
                $data = array_filter($data, function ($a) use ($field, $filter) {
                    return (boolean)preg_match("/$filter/i", $a[$field]);
                });
            }
        } else {
            // general filter
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
        }
    }
    return $data;
}


function list_filter( $list, $args = array(), $operator = 'AND' )
{
	if ( ! is_array( $list ) ) {
		return array();
	}

	$util = new \NttpDev\Libs\List_Util( $list );

	return $util->filter( $args, $operator );
}


if(!function_exists('getSetting')){
    function getSetting($value = 'site_title'){
        $setting = setting::where('name' , $value)->first();
        return $setting == null ? $value : $setting->value;
    }
}

if(!function_exists('row_footer_three')){
    function row_footer($code = 'row_footer_three'){
        $contents = content::where('code' , $code)->get();
        return $contents;
    }
}


if(!function_exists('imageThumbnail')){
    function imageThumbnail($type , $image){
        // Return empty string if the field not found
        if (!isset($image)) {
            return '';
        }
                // We need to get extension type ( .jpeg , .png ...)
       

        // We remove extension from file name so we can append thumbnail type
        // We remove extension from file name so we can append thumbnail type
        $path = substr($image, 0,strrpos($image, '/'));
        //dd($name);
        // We merge original name + type + extension
        $name =explode('/', $image);
        //dd($name);
        // We merge original name + type + extension
        return '/'.$path.'/'.$type.'/'.end($name);
    }
}


/**
 * Return nav-here if current path begins with this path.
 *
 * @param string $path
 * @return string
 */
if(!function_exists('setActive')){
    function setActive($path)
    {
        return Request::is($path . '*') ? ' m-menu__item--active' :  '';
    }
}


if(!function_exists('nttpGetOptionProduct')){
    function nttpGetOptionProduct($value = 'site_title'){
    }
}
if(!function_exists('nttpGetSingleProduct')){
    function nttpGetSingleProduct($value = 'site_title'){
    }
}


if(!function_exists('make_slug')){
    function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}



if(!function_exists('getState')){
    function getState() {
        return DB::table('provinces')->get();
    }
}


if(!function_exists('gbp_instances')){

    function gbp_instances( $instances ) {
        $inc = array(
        '3D_SECURE_PAYMENT' => FALSE,  // Enabling 3-D Secure payment(TRUE/FALSE).
                                    // Please be informed that you must contact GB Prime Pay support team before enable or disable this option.
                                    // (3-D Secure only available in Production Mode).
        'URL_3D_SECURE_TEST' => 'https://api.globalprimepay.com/v1/tokens/3d_secured',
        'URL_3D_SECURE_LIVE' => 'https://api.gbprimepay.com/v1/tokens/3d_secured',
        'URL_API_TEST' => 'https://api.globalprimepay.com/v1/tokens',
        'URL_API_LIVE' => 'https://api.gbprimepay.com/v1/tokens',
        'URL_CHARGE_TEST' => 'https://api.globalprimepay.com/v1/tokens/charge',
        'URL_CHARGE_LIVE' => 'https://api.gbprimepay.com/v1/tokens/charge',
        'URL_QRCODE_TEST' => 'https://api.globalprimepay.com/gbp/gateway/qrcode',
        'URL_QRCODE_LIVE' => 'https://api.gbprimepay.com/gbp/gateway/qrcode',
        'URL_BARCODE_TEST' => 'https://api.globalprimepay.com/gbp/gateway/barcode',
        'URL_BARCODE_LIVE' => 'https://api.gbprimepay.com/gbp/gateway/barcode',
        'URL_CHECKPUBLICKEY_TEST' => 'https://api.globalprimepay.com/checkPublicKey',
        'URL_CHECKPUBLICKEY_LIVE' => 'https://api.gbprimepay.com/checkPublicKey',
        'URL_CHECKPRIVATEKEY_TEST' => 'https://api.globalprimepay.com/checkPrivateKey',
        'URL_CHECKPRIVATEKEY_LIVE' => 'https://api.gbprimepay.com/checkPrivateKey',
        'URL_CHECKCUSTOMERKEY_TEST' => 'https://api.globalprimepay.com/checkCustomerKey',
        'URL_CHECKCUSTOMERKEY_LIVE' => 'https://api.gbprimepay.com/checkCustomerKey',
    );
    $inc_code = isset( $inc[$instances] ) ? $inc[$instances] : $instances;
    return $inc_code;
    }
}

if(!function_exists('getresponseUrl')){
    function getresponseUrl($routeurl , $order)
    {
        //dd($routeurl);
        if($routeurl=='response_qrcode'){
          $routeurl = route('thankyou' , $order->id);
        }
        if($routeurl=='background_qrcode'){
          $routeurl = route('qr.success' , $order->id);
        }
        if($routeurl=='response_barcode'){
          $routeurl = route('thankyou' , $order->id);
        }
        if($routeurl=='background_barcode'){
          $routeurl = route('bar.code' , $order->id);
        }
        return $routeurl;
    }
}