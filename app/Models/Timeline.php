<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $year
 * @property string $tag
 * @property string $title
 * @property string $description
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Timeline whereYear($value)
 * @mixin \Eloquent
 */
class Timeline extends Model
{
    //
}
