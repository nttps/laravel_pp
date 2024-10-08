<?php

namespace NttpDev\Http\Controllers\Auth;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use NttpDev\User;
use NttpDev\Libs\SendMessageService;

class VerifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $active =  Auth::user()->active;

        if($active == 1){
            return redirect('/');
        }
        return view('auth.verified');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number_confirm =  Auth::user()->active_code;


        if($request->number_confirm != $number_confirm ){
            return redirect()->back()->withInput()->withErrors([
                'number_confirm' => 'รหัสยืนยันตนไม่ถูกต้อง'
            ]);
        }else{
            $user = User::where('email',Auth::user()->email )->first();
            $user->active = 1;
            $user->active_code = null;
            $user->save();

            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function againVerified(Request $request)
    {

        //dd($request);
            $rules = [
                'tel_number' => 'required|digits:10'
                
            ];
        
            $customMessages = [
                'required' => 'กรอกเบอร์โทรศัพท์',
                'digits'   => 'เบอร์โทรศัพท์ 10 หลัก'
            ];
        
            $this->validate($request, $rules, $customMessages);

    
            $confirmation_code = mt_rand(100000, 999999);
           
            $user = User::find(auth()->user()->id);

         
            $user->active_code =  $confirmation_code;
            $user->phone =  $request->tel_number;
            $user->save();
            $sendsmd = $this->sendsms( $confirmation_code ,$request->tel_number);
            //dd($sendsmd);
            return redirect()->back();
    
    }

    public function sendsms($confirmation_code,$number){

       // define account and password
       $account = 'post01@loyalty';
       $password = '1F7DEE015717431DA14A0B817856DD32CA12428E47BB026B0A91F89D644309EC';

       // Send Single Message
       $mobile_no = $number;
       $message = 'รหัส OTP PP ของคุณคือ ' .$confirmation_code;
       $category = 'General';
       $sender_name = '';

       $results = SendMessageService::sendMessage($account, $password, $mobile_no, $message, '', $category, $sender_name);


       return $results;
       // use http proxy
       //$proxy = 'localhost:8888';
       //$proxy_userpwd = 'username:password';
       //$results = SendMessageService::sendMessage($account, $password, $mobile_no, $message, '', $category, $sender_name, $proxy, $proxy_userpwd);

      
    }
}
