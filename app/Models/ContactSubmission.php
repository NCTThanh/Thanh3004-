<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission query()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $subject
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactSubmission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ContactSubmission extends Model
{
    use HasFactory;

    
    protected $table = 'contact_submissions';

    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];
}