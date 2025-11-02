<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue; // Thêm nếu bạn muốn dùng Queue

class ContactMail extends Mailable // implements ShouldQueue // Thêm implements ShouldQueue nếu dùng Queue
{
    use Queueable, SerializesModels;

    // Khai báo các thuộc tính công khai. Laravel sẽ tự động truyền chúng vào view.
    public $name;
    public $email;
    public $phone;
    public $subject; // Đổi tên công khai thành $subject để dễ dùng trong view
    public $messageBody; // Giữ nguyên $messageBody để tránh xung đột với $message của PHP/Laravel

    /**
     * Khởi tạo một đối tượng Mailable mới.
     *
     * @param array $data Dữ liệu đã được validate từ form liên hệ.
     * @return void
     */
    public function __construct(array $data)
    {
        // Ánh xạ dữ liệu form vào các thuộc tính công khai
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'] ?? null;
        
        // CẬP NHẬT: Sử dụng $data['subject'] -> $this->subject
        $this->subject = $data['subject']; 
        $this->messageBody = $data['message']; 
    }

    /**
     * Xây dựng mail message (Gửi cho Admin).
     *
     * @return $this
     */
    public function build()
    {
        // SỬA LỖI: Đổi tên view từ 'emails.contact-admin' sang 'emails.contact'
        // để khớp với file contact.blade.php hiện có trong thư mục views/emails.
        return $this->subject('[YÊU CẦU LIÊN HỆ MỚI] ' . $this->subject)
                    ->view('emails.contact'); 
    }
}
