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
        .message-content { background-color: #fcfcfc; padding: 15px; border-radius: 5px; white-space: pre-line; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            {{-- Đảm bảo bạn có thể truy cập asset này. Nếu gửi mail thật, bạn nên dùng URL tuyệt đối --}}
            {{-- <img src="{{ asset('images/logo-mclaren.png') }}" alt="McLaren VN Logo"> --}}
             <img src="https://i.imgur.com/your-logo-url.png" alt="McLaren VN Logo"> {{-- Ví dụ URL tuyệt đối --}}
        </div>

        <h2>Tin Nhắn Liên Hệ Mới</h2>
        <p>Bạn vừa nhận được một liên hệ mới từ website với thông tin như sau:</p>

        <table class="content-table">
            <tr>
                <td class="label">Tên:</td>
                {{-- SỬA 1: Đổi $name thành $submission->name --}}
                <td>{{ $submission->name }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                {{-- SỬA 2: Đổi $email thành $submission->email --}}
                <td>{{ $submission->email }}</td>
            </tr>
            <tr>
                <td class="label">Điện thoại:</td>
                {{-- SỬA 3: Đổi $phone thành $submission->phone --}}
                <td>{{ $submission->phone ?? 'Chưa cung cấp' }}</td>
            </tr>
             <tr>
                <td class="label">Chủ đề:</td>
                {{-- SỬA 4: Thêm $submission->subject --}}
                <td>{{ $submission->subject }}</td>
            </tr>
        </table>

        <h4 style="margin-top: 20px;">Nội dung tin nhắn:</h4>
        <div class="message-content">
             {{-- SỬA 5: Đổi $messageBody thành $submission->message (và dùng nl2br) --}}
            {!! nl2br(e($submission->message)) !!}
        </div>

        <p class="footer">Mail được gửi tự động từ hệ thống McLaren VN.</p>
    </div>
</body>
</html>