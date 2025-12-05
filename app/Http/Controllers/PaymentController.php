<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config; // Cần thiết để đọc cấu hình MoMo
use Illuminate\Support\Facades\Log;    // Cần thiết để ghi nhật ký lỗi

class PaymentController extends Controller
{
    /**
     * Khởi tạo yêu cầu thanh toán qua API MoMo.
     * Route: /payment/initiate
     */
    public function initiate(Request $request)
    {
        // 1. Validation
        $request->validate([
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
            'subject' => 'required|in:tu_van_mua_xe',
        ]);

        $user = Auth::user();
        $momoConfig = Config::get('momo');
        
        // 2. Chuẩn bị dữ liệu giao dịch
        $amount = 50000000; // 50,000,000 VNĐ - Số tiền cọc cố định
        $orderId = 'MCL-' . time() . '-' . $user->id; // Mã đơn hàng duy nhất
        $requestId = time() . '-' . uniqid(); // Mã yêu cầu (dùng 1 lần)
        $orderInfo = 'Dat coc xe McLaren - User: ' . $user->id;

        // 3. TẠO CHỮ KÝ BẢO MẬT (HMAC SHA256)
        // Các tham số phải được sắp xếp và nối chuỗi ĐÚNG theo tài liệu MoMo
        $rawHash = "partnerCode=" . $momoConfig['partner_code'] .
                   "&accessKey=" . $momoConfig['access_key'] .
                   "&requestId=" . $requestId .
                   "&amount=" . $amount .
                   "&orderId=" . $orderId .
                   "&orderInfo=" . $orderInfo .
                   "&returnUrl=" . $momoConfig['return_url'] .
                   "&notifyUrl=" . $momoConfig['notify_url'] .
                   "&extraData="; 

        $signature = hash_hmac('sha256', $rawHash, $momoConfig['secret_key']);

        // 4. Tạo Payload JSON gửi đến MoMo
        $data = [
            'partnerCode' => $momoConfig['partner_code'],
            'accessKey' => $momoConfig['access_key'],
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $momoConfig['return_url'],
            'notifyUrl' => $momoConfig['notify_url'],
            'extraData' => '',
            'requestType' => 'captureWallet',
            'signature' => $signature
        ];

        // 5. Gửi yêu cầu qua cURL
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $momoConfig['request_url']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Bỏ qua xác minh SSL trong môi trường TEST
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $result = curl_exec($ch);
            
            if (curl_errno($ch)) {
                Log::error('MoMo cURL Execution Error: ' . curl_error($ch));
                throw new \Exception("Lỗi cURL: " . curl_error($ch));
            }

            curl_close($ch);
            $response = json_decode($result, true);

            // 6. Xử lý phản hồi từ MoMo
            if (isset($response['payUrl']) && $response['resultCode'] == 0) {
                // Thành công: MoMo trả về URL thanh toán
                return redirect($response['payUrl']);
            } else {
                // Thất bại: MoMo trả về lỗi (Ví dụ: signature sai)
                $errorMessage = $response['message'] ?? 'Lỗi không xác định khi gọi API MoMo.';
                Log::error('MoMo API Error: ' . $errorMessage, ['response' => $response]);
                return back()->with('error', 'Lỗi thanh toán MoMo: ' . $errorMessage);
            }

        } catch (\Exception $e) {
            Log::error('MoMo API Exception: ' . $e->getMessage());
            return back()->with('error', 'Lỗi kết nối đến cổng thanh toán: ' . $e->getMessage());
        }
    }
    
    /**
     * Route nhận kết quả từ Cổng Thanh Toán MoMo (Return URL)
     * Route: /payment/return
     */
    public function returnUrl(Request $request)
    {
        $momoConfig = Config::get('momo');
        
        // 1. Lấy tất cả dữ liệu MoMo trả về
        $data = $request->all();

        // 2. Tái tạo Chữ ký để kiểm tra tính toàn vẹn của dữ liệu
        $rawHash = "partnerCode=" . $data['partnerCode'] . 
                   "&accessKey=" . $momoConfig['access_key'] .
                   "&requestId=" . $data['requestId'] .
                   "&amount=" . $data['amount'] .
                   "&orderId=" . $data['orderId'] .
                   "&orderInfo=" . $data['orderInfo'] .
                   "&returnUrl=" . $data['returnUrl'] .
                   "&notifyUrl=" . $data['notifyUrl'] .
                   "&extraData=" . $data['extraData'];

        $expectedSignature = hash_hmac('sha256', $rawHash, $momoConfig['secret_key']);

        if ($data['signature'] === $expectedSignature) {
            // Chữ ký hợp lệ
            if ($data['resultCode'] == 0) {
                // Giao dịch thành công
                // *** CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG TRONG DB TỪ PENDING -> APPROVED ***

                return redirect()->route('contact')->with('success', 'Đặt cọc thành công qua MoMo! Mã đơn hàng: ' . $data['orderId']);

            } else {
                // Giao dịch thất bại (Khách hàng hủy hoặc lỗi khác)
                return redirect()->route('contact')->with('info', 'Giao dịch MoMo không thành công. Lời nhắn: ' . $data['message']);
            }
        } else {
            // Chữ ký không hợp lệ (Dữ liệu bị giả mạo)
            Log::warning('MoMo Signature Mismatch', ['orderId' => $data['orderId'], 'request' => $data]);
            return redirect()->route('contact')->with('error', 'Lỗi bảo mật: Dữ liệu giao dịch không hợp lệ.');
        }
    }
}