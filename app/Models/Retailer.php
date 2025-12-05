<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $type
 * @property string $lat
 * @property string $lng
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Retailer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Retailer extends Model
{
    //
}
