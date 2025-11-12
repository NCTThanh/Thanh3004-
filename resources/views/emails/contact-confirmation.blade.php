<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>McLaren VN - Xác nhận liên hệ</title>
    <style>
        /* CSS cho Email */
        body { font-family: Arial, sans-serif; background-color: #f7f7f7; color: #333; padding: 20px; }
        .container { background-color: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
        h2 { color: #d40000; } /* Màu đỏ McLaren */
        p { line-height: 1.6; }
        .logo { text-align: center; margin-bottom: 20px; }
        /* Tùy chỉnh nếu bạn có một URL cố định cho logo: */
        .logo img { width: 150px; } 
        .footer { margin-top: 20px; padding-top: 10px; border-top: 1px solid #eee; font-size: 0.9em; color: #777; }
        .details-box { border-left: 3px solid #f99d1c; padding: 10px; margin: 15px 0; background-color: #fffaf0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            {{-- THAY THẾ URL NÀY BẰNG LINK TUYỆT ĐỐI CỦA LOGO --}}
            <img src="https://example.com/images/logo-mclaren.png" alt="McLaren VN Logo"> 
        </div>

        {{-- SỬA 1: Đổi $name thành $submission->name --}}
        <h2>Xin chào {{ $submission->name ?? 'Khách hàng' }}!</h2>
        <p>Cảm ơn bạn đã gửi liên hệ tới McLaren VN. Chúng tôi đã nhận được thông tin và sẽ phản hồi bạn sớm nhất có thể.</p>
        
        <div class="details-box">
            {{-- SỬA 2: Đổi $subject thành $submission->subject --}}
            <p><strong>Chủ đề:</strong> {{ $submission->subject ?? 'Không có chủ đề' }}</p>
            <p><strong>Nội dung tin nhắn bạn đã gửi:</strong></p>
            
            {{-- SỬA 3: Đổi $messageBody thành $submission->message --}}
            <p style="white-space: pre-line;">{!! nl2br(e($submission->message ?? 'Không có nội dung tin nhắn.')) !!}</p> 
        </div>

        <p>Trong thời gian chờ đợi, bạn có thể tham khảo thêm về các dòng xe mới nhất của McLaren tại website của chúng tôi.</p>
        
        <div class="footer">
            <p>Trân trọng,</p>
            <p>Đội ngũ McLaren Việt Nam</p>
            <p>Điện thoại: +84 858 970 088 | Email: mclarenvn@gmail.com</p>
        </div>
    </div>
</body>
</html>