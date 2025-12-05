<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_key', 'name', 'series', 'slogan', 'tagline', 'description', 
        'image_url', 'video_url', 'model_3d_url', 'stats', 'specs', 
        'gallery_images', 'stories' 
    ];

    
    
  
    protected function stats(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_array($value) ? $value : (json_decode($value, true) ?: []),
        );
    }
    
    // Xử lý cột 'specs'
    protected function specs(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_array($value) ? $value : (json_decode($value, true) ?: []),
        );
    }
    
    // Xử lý cột 'gallery_images'
    protected function galleryImages(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_array($value) ? $value : (json_decode($value, true) ?: []),
        );
    }
    
    // Xử lý cột 'stories'
    protected function stories(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_array($value) ? $value : (json_decode($value, true) ?: []),
        );
    }
}