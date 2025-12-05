<?php

namespace App\Mail;

use App\Models\ContactSubmission; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Dữ liệu liên hệ (dưới dạng Model Object).
     */
    public ContactSubmission $submission; 

    /**
     * Khởi tạo một đối tượng Mailable mới.
     *
     * @param ContactSubmission $submission Dữ liệu đã được validate và lưu
     * @return void
     */
    public function __construct(ContactSubmission $submission) 
    {
        $this->submission = $submission; 
    }

    /**
     * Lấy envelope (tiêu đề, người gửi) của mail.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // Tiêu đề mail cho Khách
            subject: 'Xác nhận: Chúng tôi đã nhận được liên hệ của bạn',
        );
    }

    /**
     * Lấy nội dung mail (view).
     */
    public function content(): Content
    {
        return new Content(
           
            view: 'emails.contact-confirmation',
            
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