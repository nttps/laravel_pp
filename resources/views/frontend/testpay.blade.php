@extends('layouts.frontend.home')

@section('content')
    
<form action="https://api.globalprimepay.com/gbp/gateway/qrcode" method="post"> 
    <div> 
      <label>Amount: </label> 
      <input type="text" name="amount" value="10.00" /> 
    </div> 
    <div> 
      <label>Response URL: </label> 
      <input type="text" name="responseUrl" value="https://pp.nttps.com" /> 
    </div> 
    <div> 
      <label>Background URL: </label> 
      <input type="text" name="backgroundUrl" value="https://pp.nttps.com" /> 
    </div> 
    <div> 
      <label>Detail: </label> 
      <input type="text" name="detail" value="money" /> 
    </div> 
    <div> 
      <label>Reference No: </label> 
      <input type="text" name="referenceNo" value="2018122600001" /> 
    </div> 
    <div> 
      <button type="submit">Pay</button> 
    </div> 
    <input type="hidden" name="token" value="4x/i41Oc7rQC67/CVpnLu84P7QY1ph8j6I4sCh6puBblye/8zO/AD3EHD2iobzuxuns0O8nVGUuyS+HUeQ1tlaBiCk8EYCdOin9XyiViVGvHxq4U0TT2l1cDPr1OPrOWOvKFmbcwB8ej2qY5u+CiN81QrXc=" /> 
    <input type="hidden" name="payType" value="F" /> 
  </form>    


  <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST"> 
    @csrf                    
    <div id="gb-form" style="height: 600px;"></div>  
  </form>                                                  
    
@endsection



@push('scripts')
<script src="{{ asset('js/GBPrimePay.js') }}"></script>  <!-- https://github.com/GBPrimepay/gbprimepay-js --> 
<script>                                                 
  new GBPrimePay({                                             
    publicKey: '8bCjNNDyEGT4gBLMKHcGH1NeXNaD8Wi0',                           
    gbForm: '#gb-form',                                        
    merchantForm: '#checkout-form',                            
    customStyle: {                                             
      backgroundColor: '#eaeaea'                               
    },                                                         
    env: 'test' // default prd | optional: test, prd           
  });                                                          
</script>      
@endpush