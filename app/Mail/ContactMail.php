<?php

namespace App\Mail;

use App\Models\ContactSubmission; 
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
            
            view: 'emails.contact-admin',
            
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