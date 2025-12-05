<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class FixOldCarData extends Command
{
    protected $signature = 'db:fix-cars';
    protected $description = 'Fixes malformed JSON data in old Car records by setting them to [].';

    public function handle()
    {
        $this->info('Starting data migration for cars table...');
        $cars = Car::all();
        $count = 0;

        foreach ($cars as $car) {
            $update = false;
            $data = [];

            // Kiểm tra và sửa cột 'stats'
            if (empty($car->stats) || !is_iterable($car->stats)) {
                $data['stats'] = '[]';
                $update = true;
            }

            // Kiểm tra và sửa cột 'specs'
            if (empty($car->specs) || !is_iterable($car->specs)) {
                $data['specs'] = '{}'; // Specs là object
                $update = true;
            }
            
            // Kiểm tra và sửa cột 'gallery_images'
            if (empty($car->gallery_images) || !is_iterable($car->gallery_images)) {
                $data['gallery_images'] = '[]';
                $update = true;
            }

            if ($update) {
                // Sử dụng DB::table để bỏ qua Model casting, force update chuỗi JSON
                DB::table('cars')->where('id', $car->id)->update($data);
                $this->line("Fixed car ID: {$car->id} ({$car->name})");
                $count++;
            }
        }

        $this->info("Finished! Successfully fixed {$count} car records.");
        return 0;
    }
}