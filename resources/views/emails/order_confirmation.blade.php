<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; overflow: hidden; }
        .header { background: #121212; padding: 30px; text-align: center; border-bottom: 4px solid #FF7E00; }
        .header h1 { color: #fff; margin: 0; text-transform: uppercase; letter-spacing: 2px; }
        .content { padding: 30px; color: #333; }
        .order-info { background: #f9f9f9; padding: 15px; margin: 20px 0; border-left: 4px solid #FF7E00; }
        .btn { display: inline-block; padding: 12px 25px; background: #FF7E00; color: #fff; text-decoration: none; font-weight: bold; text-transform: uppercase; margin-top: 20px; }
        .footer { background: #121212; color: #666; padding: 20px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>McLaren Vietnam</h1>
        </div>
        <div class="content">
            <h2>Xin chào {{ $order->user->name }},</h2>
            <p>Chúng tôi đã nhận được yêu cầu đặt cọc xe <strong>{{ $order->car->name }}</strong> của bạn.</p>
            <p>Vui lòng thực hiện chuyển khoản số tiền cọc để hoàn tất thủ tục giữ chỗ.</p>
            
            <div class="order-info">
                <p><strong>Mã đơn:</strong> {{ $order->order_code }}</p>
                <p><strong>Số tiền cọc:</strong> 50,000,000 VNĐ</p>
                <p><strong>Ngân hàng:</strong> Vietcombank CN TP.HCM</p>
                <p><strong>Số tài khoản:</strong> 9999 8888 6666</p>
                <p><strong>Chủ tài khoản:</strong> MCLAREN VIETNAM LTD</p>
                <p><strong>Nội dung CK:</strong> {{ $order->order_code }} {{ $order->user->phone }}</p>
            </div>
            
            <p>Bộ phận kinh doanh sẽ liên hệ với bạn qua số điện thoại <strong>{{ $order->user->phone ?? 'đã đăng ký' }}</strong> trong vòng 24 giờ.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} McLaren Automotive Limited. All rights reserved.
        </div>
    </div>
</body>
</html>