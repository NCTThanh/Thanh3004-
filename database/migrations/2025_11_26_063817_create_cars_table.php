<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model_key')->unique(); 
            $table->string('name');              
            $table->string('series');              
            $table->string('slogan')->nullable();  
            $table->string('tagline')->nullable(); 
            $table->text('description')->nullable(); 
            
            // Hình ảnh
            $table->string('image_url');          
            $table->json('gallery')->nullable(); 
            $table->string('video_url')->nullable();
            
            // Thông số
            $table->json('stats')->nullable();     
            $table->json('specs')->nullable();  
            $table->json('stories')->nullable();
            // 3D Model
            $table->string('model_3d_url')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};