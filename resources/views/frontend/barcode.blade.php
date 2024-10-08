<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
    <style>
       .barcode_display {
            overflow:hidden;
            height:100%;
        }
        .barcode_display object{
            height: auto;
        }
    </style>
</head>
<body>
    <div class="barcode_display" id="gbprimepay-barcode-waiting-payment" style="display:block;">
    <object width="100%" height="100%" data="data:application/pdf;base64,{{ base64_encode($barcode) }}" type="application/pdf" class="internal"  style="min-height: 700px;" /></object>
    </div>
    
</body>
</html>