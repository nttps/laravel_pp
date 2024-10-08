<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <strong style="font-size: 18px;">มีข้อความติดต่อจาก TGOBAL ถึงคุณ</strong>
    <table style="border-spacing: 0;border-collapse: collapse;font-size: 16px;width:100%;border-left: 1px dashed #e7ebed;border-right: 1px dashed #e7ebed;border-bottom: 1px dashed #e7ebed;">
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                ชื่อ - นามสกุล:	
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #292929;min-width: 200px;">
               {{ $name }} - {{ $surname }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                ที่อยู่:	
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #292929;min-width: 200px;">
                {{ $address }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                เบอร์โทรศัพท์:
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;font-size: 16px;color: #292929;min-width: 200px;">
                {{ $telephone }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                อีเมล:
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;font-size: 16px;color: #292929;min-width: 200px;">
                {{ $email }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                รายละเอียด:
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;font-size: 16px;color: #292929;min-width: 200px;">
                {{ $description }}
            </td>
        </tr>
        <tr>
            <td style="border-collapse: collapse;padding-top: 10px;font-size: 16px;padding-right: 10px;color: #646464;width: 30%;">
                ติดต่อกลับโดย:
            </td>
            <td style="border-collapse: collapse;padding-top: 10px;padding-right: 10px;font-size: 16px;color: #292929;min-width: 200px;">
                {{ $contact_by }}
            </td>
        </tr>
    </table>
</body>
</html>