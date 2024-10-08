<?php

namespace NttpDev\Http\Controllers\Customer;

use Illuminate\Http\Request;
use NttpDev\Http\Controllers\Controller;
use NttpDev\User;
use NttpDev\Model\Address;
use NttpDev\Model\AddressUser;
use NttpDev\Model\Order;
use NttpDev\Model\Payment;
use DB;
use Hash;
class MainController extends Controller
{
    /**
     * INDEX CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.index');
    }

     /**
     * HISTORY CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function historyIndex()
    {
        $orders = Order::where('user_id' , auth()->user()->id)->orderBy('created_at' , 'DESC')->paginate(5);
        return view('customer.history.index' , compact('orders'));
    }
    
     /**
     * HISTORY SHOW ORDER CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function historyShow($id)
    {
        $order = Order::find($id);
        return view('customer.history.show' , compact('order'));
    }

    /**
     * HISTORY CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentIndex()
    {
        $orders = Order::where('user_id' , auth()->user()->id)->where('status' , 'AWAIT-PAYMENT')->orderBy('created_at' , 'DESC')->paginate(5);
        return view('customer.payment.index' , compact('orders'));
    }

    /**
     * HISTORY CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentUpload(Request $request ,$id)
    {


         //dd($request->is_show );
         $messages = [
            'fUpload.required' => 'แนบสลิกการชำระ',
        ];

        $this->validate($request, [
            'fUpload' => 'required',
        ], $messages);


        $order = Order::find($id);

        if($request->hasFile('fUpload')){
            $value = uploading()->uploadFiles('fUpload', $request->slug , 'images/slips');

            Payment::create([
                'order_id' => $id,
                'proof_payment' => $value
            ]);
        }


        $order->update(['status' => 'AWAIT-CONFIRM']);
        return redirect()->back()->with('success_message', 'ลูกค้าได้แนบหลักฐานการชำระเงินเรียบร้อยแล้ว');
    }

    
    /**
     * HISTORY CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function shippedIndex()
    {
        $orders = Order::where('user_id' , auth()->user()->id)->where('status' , 'AWAIT-SHIPMENT')->orWhere('status' , 'SHIPPED')->orderBy('created_at' , 'DESC')->paginate(5);
        return view('customer.shipped.index' , compact('orders'));
    }


     /**
     * HISTORY CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function orderCancle($id)
    {
        $order = Order::find($id);
        $order->update(['status' => 'CANCELLED']);
        return redirect()->route('customer.history.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
    }

    

    /**
     * PROFILE CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function profileIndex()
    {
        $user = User::find(auth()->user()->id);

        return view('customer.profile.index' , compact('user'));
    }
       /**
     * PROFILE CUSTOMER
     *
     * @return \Illuminate\Http\Response
     */
    public function profileStore(Request $request)
    {

        $messages = [
            'password.required' => 'Please enter password',
          ];
        
        $this->validate($request, [
            'password' => 'required|same:password|min:8|confirmed',
            'password_confirmation' => 'required|same:password',     
        ], $messages);

        $user = User::find(auth()->user()->id);
        $user->name = $request->fullname;
        $user->phone = $request->phone;

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $request->session()->flash('success', 'บันทึกข้อมูลเรียบร้อย');
        return redirect()->back();
    }
    
    /**
     * INDEX ADDRESS
     *
     * @return \Illuminate\Http\Response
     */
    public function addressIndex()
    { 
        $user = User::find(auth()->user()->id);
        $addresses = $user->addresses()->where('is_default' , 1)->first();
        $countries = DB::table('countries_data')->get();
        $provinces = DB::table('provinces')->get();
        $amphures = DB::table('amphures')->get();
        $districts = DB::table('districts')->get();
        return view('customer.address.index' , compact('countries' , 'addresses' , 'provinces' , 'amphures' , 'districts' ,  'user'));
    }

    /**
     * SAVE ADDRESS
     *
     * @return \Illuminate\Http\Response
     */
    public function addressNew(Request $request)
    {

        try {

        
        //$fulladdress2 = isset($request->address_2) ? $request->address_2.' '.$request->address_3 : $request->address_3;
            $address = Address::create([
                'first_name'            => $request->firstname,
                'last_name'             => $request->lastname,
                'address_1'             => $request->address_1,
                'tumbon'                => $request->address_3,
                'city'                  => $request->city,
                'state'                 => $request->state,
                'postcode'              => $request->postcode,
                'country'               => $request->country,
                'email'                 => $request->email,
                'phone'                 => $request->phone,
                'is_default'            =>  1,
            ]);

            AddressUser::create([
                'user_id' => auth()->user()->id,
                'address_id' => $address->id,
            ]);

        } catch (Exception $e) {
            return redirect(url()->previous());
        }
        return redirect(url()->previous());
    }

     /**
     * EDIT ADDRESS
     *
     * @return \Illuminate\Http\Response
     */
    public function addressEdit(Request $request , $id)
    {
        $address = Address::find($id);
        $address->first_name= $request->firstname;
        $address->last_name= $request->lastname;
        $address->address_1= $request->address_1;
        $address->tumbon= $request->address_3;
        $address->city= $request->city;
        $address->state=$request->state ;
        $address->postcode= $request->postcode;
        $address->country= $request->country;
        $address->email= $request->email;
        $address->phone= $request->phone;
        $address->save();
        return redirect(url()->previous());
    }







}