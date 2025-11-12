<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    /**
     * Tên bảng (nếu tên model khác tên bảng)
     * Nếu tên Model là ContactSubmission và tên bảng là contact_submissions
     * thì dòng này KHÔNG CẦN THIẾT, nhưng để cho chắc.
     */
    protected $table = 'contact_submissions';

    /**
     * Dòng này CỰC KỲ QUAN TRỌNG.
     * Khai báo các cột mà bạn cho phép `::create()` điền vào.
     * Hãy đảm bảo tên cột khớp với validate VÀ database.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}