<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phản Hồi Từ McLaren VN</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #FF7E00;">Phản Hồi Từ Bộ phận Chăm Sóc Khách Hàng McLaren VN</h2>
        
        <p>Chào **{{ $details['name'] }}**,</p>
        
        <p>Chúng tôi đã nhận được yêu cầu liên hệ của bạn và xin gửi phản hồi dưới đây:</p>
        
        <div style="margin: 20px 0; padding: 15px; border-left: 4px solid #FF7E00; background-color: #f9f9f9;">
            {{-- Hiển thị nội dung phản hồi của Admin --}}
            <p style="margin: 0; white-space: pre-wrap;">{{ $details['body'] }}</p> 
        </div>
        
        <p>Nếu bạn có bất kỳ câu hỏi nào khác, vui lòng phản hồi lại email này.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <p style="font-size: 0.9em; color: #777;">Trân trọng,<br>Đội ngũ McLaren Vietnam.</p>
    </div>
    
</body>
</html>