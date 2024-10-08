<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>อีเมลยืนยันของหมายเลขคำสั่งซื้อ</title>
    <style>
        .logo{
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ \Storage::url(getSetting($value = 'site_logo')) }}" width="130px" alt="">
    </div>
    


    <strong style="font-size: 16px;"> เรียนคุณ {{ $name }}, </strong>   
    <p style="margin-top: 10px;margin-bottom: 20px;border-bottom: 2px solid #646464;font-size:16px;">หมายเลขของคำสั่งซื้อ # {{ $id }} ของคุณ <strong>ได้ถูกจัดส่งแล้ว กรุณาตรวจสอบการจัดส่งได้ที่หมายเลข {{ $shipped_no }}</strong> </p>
    <strong>รายละเอียดของคำสั่งซื้อ:</strong>
    <table style="border-spacing: 0;border-collapse: collapse;font-size: 14px;width:100%;border-left: 1px dashed #e7ebed;border-right: 1px dashed #e7ebed;border-top: 1px dashed #e7ebed;">
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">ชื่อสินค้า</td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;text-align:center;">จำนวน</td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;text-align:right;">ราคา</td>
        </tr>
        @foreach ($order_items as $item)
            <tr>
                <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
                    {{ $item->name }} [{{ $item->sku }}]
                </td>
                <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;text-align:center;">
                    {{ $item->pivot->quantity }}
                </td>
                <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;text-align:right;">
                    {{ number_format($item->price*$item->pivot->quantity,2) }}
                </td>
            </tr>
        @endforeach       
    </table>
    

    <table style="border-spacing: 0;border-collapse: collapse;font-size: 14px;width:100%;border-left: 1px dashed #e7ebed;border-right: 1px dashed #e7ebed;border-bottom: 1px dashed #e7ebed;"
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;color: #646464;width: 80%;text-align:right;">
                ยอดรวม:	
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;color: #292929;min-width: 140px;text-align:right;">
                {{ number_format($price,2) }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;color: #646464;width: 80%;text-align:right;">
                ค่าธรรมเนียมการสั่งซื้อขั้นต่ำ:	
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;color: #292929;min-width: 140px;text-align:right;">
                {{ number_format($shipping,2) }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 80%;text-align:right;">
                <strong> ยอดสุทธิ:</strong> 	
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;font-size: 16px;color: #292929;min-width: 140px;text-align:right;">
                {{ number_format($total,2) }}
            </td>
        </tr>
    </table>
    <p>อีเมลนี้เป็นระบบอัตโนมัติ ห้ามตอบกลับ</p>
    
</body>
</html>