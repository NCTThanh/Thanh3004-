<?php
// Cấu hình MoMo cho môi trường Test
return [
    // Mã Partner Code đã được điền, giữ nguyên
    'partner_code' => env('MOMO_PARTNER_CODE', 'MOMO5ZIJ20230613'), 
    'access_key' => env('MOMO_ACCESS_KEY', 'bAbusuVpcdguvDX7'),     
    'secret_key' => env('MOMO_SECRET_KEY', 'w6HsnH2Yu0UTDSfNo1ZxVZkPTESottzM'),     
    
    // Đã sửa lại URL MoMo, thêm endpoint API cần thiết
    'request_url' => 'https://test-payment.momo.vn/v2/gateway/api/create', 
    'return_url' => env('APP_URL') . '/payment/return', 
    'notify_url' => env('APP_URL') . '/api/momo/ipn', 
];