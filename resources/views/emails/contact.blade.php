<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liên Hệ từ McLaren VN</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f7f7f7; color: #333; padding: 20px; }
        .container { background-color: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
        h2 { color: #d40000; }
        p { line-height: 1.6; }
        .footer { font-size: 12px; color: #777; margin-top: 20px; }
        .logo { text-align: center; margin-bottom: 20px; }
        .logo img { width: 150px; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 10px;}
        .content-table td { padding: 8px; border-bottom: 1px solid #eee; }
        .content-table td.label { font-weight: bold; width: 120px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo-mclaren.png') }}" alt="McLaren VN Logo">
        </div>

        <h2>Liên Hệ Từ McLaren VN</h2>

        <table class="content-table">
            <tr>
                <td class="label">Tên:</td>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <td class="label">Điện thoại:</td>
                <td>{{ $phone ?? 'Chưa cung cấp' }}</td>
            </tr>
            <tr>
                <td class="label">Nội dung:</td>
                <td>{{ $messageBody }}</td>
            </tr>
        </table>

        <p class="footer">Mail được gửi tự động từ hệ thống McLaren VN. Vui lòng không trả lời trực tiếp.</p>
    </div>
</body>
</html>
