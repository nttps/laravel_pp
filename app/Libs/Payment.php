<?php
namespace NttpDev\Libs;

class Payment {

    private static $getCardArray;
    public function getMerchantId()
    {

        $configkey = env('PAYMENT_PUBLIC_KEY');
        $url = gbp_instances('URL_CHECKPUBLICKEY_TEST');
        
        if (empty($configkey)) {
            return false;
        }
        $field = [];
        $type = 'GET';
        $key = base64_encode("{$configkey}".":");
        $ch = curl_init($url);
        $request_headers = array(
            "Accept: application/json",
            "Authorization: Basic {$key}",
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);
        $json = json_decode($body, true);
        if (isset($json['error'])) {
            return false;
        }
        curl_close($ch);
        return $json['merchantId'];
    }
    public static function encode($string,$key)
      {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $j = 0;
        $hash = '';
            for ($i = 0; $i < $strLen; $i++) {
                $ordStr = ord(substr($string,$i,1));
                if ($j == $keyLen) { $j = 0; }
                $ordKey = ord(substr($key,$j,1));
                $j++;
                $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
            }
        return $hash;
      }
    public static function generateID()
      {
        $microtime = md5(microtime());
        $encoded = self::encode($microtime , "GBPrimePay");
        $serial = implode('-', str_split(substr(strtolower($encoded), 0, 32), 5));
        return $serial;
      }
    
    public static function sendTokenCurl($url, $field, $type)
    {
        $configkey = env('PAYMENT_PUBLIC_KEY');
        if (empty($configkey)) {
            return false;
        }
        $ch = curl_init($url);
        $request_headers = array(
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "token=".urlencode($configkey));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);
        $json = json_decode($body, true);
        if (isset($json['error'])) {
            return false;
        }
        curl_close($ch);
        return json_decode($body, true);
    }
    public static function sendCHARGECurl($url , $field  , $type)
    {   
      
        $configkey = env('PAYMENT_SECRET_KEY');
        $key = base64_encode("{$configkey}".":");

        //dd($url);
        $ch = curl_init($url);
  
        //dd($ch);application/x-www-form-encoded
        $request_headers = array(
            "Accept: application/json",
            "Authorization: Basic {$key}",
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);
        $json = json_decode($body, true);

        if (isset($json['error'])) {
            return false;
        }
        curl_close($ch);
        return json_decode($body, true);
    }
    
    public static function sendAPICurl($url, $field, $type)
    {
        //dd($url);
        $configkey = env('PAYMENT_PUBLIC_KEY');
        $key = base64_encode("{$configkey}".":");
        $ch = curl_init($url);

      
        $request_headers = array(
            "Accept: application/json",
            "Authorization: Basic {$key}",
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        );

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);
        $json = json_decode($body, true);

        //dd($json);
        if (isset($json['error'])) {
            return false;
        }
        curl_close($ch);
        return json_decode($body, true);
    }
    public static function sendBARCurl($url, $field, $type)
    {
        $configkey = env('PAYMENT_PUBLIC_KEY');
        if (empty($configkey)) {
            return false;
        }
        $ch = curl_init($url);
        $request_headers = array(
            "Cache-Control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);
        if ($body=="Incomplete information") {
          $body = 'error : Incomplete information';
        }else{
          // $body = ob_start();'\n<img src="data:image/png;base64,' . base64_encode($body) . '">';
          $body = $body;
        }
        curl_close($ch);
        return $body;
    }

    public static function sendQRCurl($url, $field, $type)
    {

      
        $configkey = env('PAYMENT_PUBLIC_KEY');
       
        if (empty($configkey)) {
            return false;
        }
        $ch = curl_init($url);
        $request_headers = array(
            "Cache-Control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
        $body = curl_exec($ch);

        if ($body=="Incomplete information") {
          $body = 'error : Incomplete information';
        }else{
          //$body = ob_start();'\n<img src="data:image/png;base64,' . base64_encode($body) . '">';
          $body = 'data:image/png;base64,' . base64_encode($body) . '';
        }
        curl_close($ch);
        return $body;
    }

    /**
     * ============ CARD ACCOUNT METHODS =============
     */
    public static function createCardAccount($body) {
        try {
                $customer_rememberCard = $body['is_save'];
                $cc_number = $body['number'];
                $customer_cc_exp_month = $body['expiry_month'];
                $customer_cc_exp_year = $body['expiry_year'];
                $cc_cid = $body['cvv'];
                $customer_full_name = $body['full_name'];
                $getgbprimepay_customer_id = $body['user_id'];
                $url = gbp_instances('URL_API_TEST');
              
                $iniactive = 0;
                if((isset($customer_cc_exp_month)) && (isset($customer_cc_exp_year))){
                    $field = "{\r\n\"rememberCard\": $customer_rememberCard,\r\n\"card\": {\r\n\"number\": \"$cc_number\",\r\n\"expirationMonth\": \"$customer_cc_exp_month\",\r\n\"expirationYear\": \"$customer_cc_exp_year\",\r\n\"securityCode\": \"$cc_cid\",\r\n\"name\": \"$customer_full_name\"\r\n}\r\n}";
                  
                    $callback = self::sendAPICurl("$url", $field, 'POST');
                    if ($callback['resultCode']=="54") {
                    }else if ($callback['resultCode']=="02") {
                    }else if ($callback['resultCode']=="00") {
                        $token_id = $callback['card']['token'];
                        $iniactive = 1;
                    }
                }
                if($iniactive==1 && !empty($token_id)){
                $currentdate = date('Y-m-d H:i');
                $response = array(
                    'active' => true,
                    'created_at' => $currentdate,
                    'updated_at' => $currentdate,
                    'id' => $token_id,
                    'id_customer' => $getgbprimepay_customer_id,
                    'links' => array(
                                    'self' => "/card_accounts/$token_id",
                                    'users' => "/card_accounts/$token_id/users"
                                ),
                    'card' => $callback['card'],
                );
                self::$getCardArray = $response;
           // AS_Gbprimepay::log(  'createCardAccount Response: ' . print_r( $response, true ) );
          }
            if ($response) return $response;
            else {
                throw new Exception(__('Something went wrong while creating card account.'));
            }
        } catch (Exception $e) {
            wc_add_notice( $e->getMessage(), 'error' );
            AS_Gbprimepay::log(  'createCardAccount error Response: ' . print_r( $e->getMessage(), true ) );
            return;
        }
    }

    
}