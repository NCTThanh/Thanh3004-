<?php

namespace App\Mail;

use App\Models\ContactSubmission; // <-- THÊM DÒNG NÀY
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Dữ liệu liên hệ (dưới dạng Model Object).
     * Phải là 'public' để view có thể thấy.
     */
    public ContactSubmission $submission; // <-- SỬA 1: Khai báo public property

    /**
     * Khởi tạo một đối tượng Mailable mới.
     *
     * @param ContactSubmission $submission Dữ liệu đã được validate và lưu
     * @return void
     */
    public function __construct(ContactSubmission $submission) // <-- SỬA 2: Đổi (array $data)
    {
        $this->submission = $submission; // <-- SỬA 3: Gán object
    }

    /**
     * Lấy envelope (tiêu đề, người gửi) của mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Trả lời thư này sẽ đi đến email của khách
            replyTo: $this->submission->email,
            // Tiêu đề mail cho Admin
            subject: 'Tin nhắn Liên hệ Mới: ' . $this->submission->subject,
        );
    }

    /**
     * Lấy nội dung mail (view).
     */
    public function content(): Content
    {
        return new Content(
            // Đảm bảo bạn có file view này:
            // resources/views/emails/contact-admin.blade.php
            view: 'emails.contact-admin',
            // Dữ liệu $submission sẽ tự động được truyền vào view
        );
    }

    /**
     * Lấy file đính kèm (nếu có).
     */
    public function attachments(): array
    {
        return [];
    }
}