<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Retailer;
use App\Models\Timeline;
use App\Models\Event;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
       
        // 1. RETAILERS
        Retailer::create(['name' => 'McLaren Sài Gòn', 'address' => 'Deutsches Haus, 33 Lê Duẩn, Quận 1', 'phone' => '(028) 38XX.XXXX', 'type' => 'Flagship', 'lat' => 10.7769, 'lng' => 106.7009]);
        Retailer::create(['name' => 'McLaren Hà Nội', 'address' => 'Quận Hoàn Kiếm, Hà Nội', 'phone' => '(024) 37XX.XXXX', 'type' => 'Showroom', 'lat' => 21.0285, 'lng' => 105.8542]);

        // 2. TIMELINE (HERITAGE)
        $timelines = [
            ['year' => 1963, 'tag' => 'Sự Khởi Đầu', 'title' => 'Tầm Nhìn Của Bruce', 'description' => 'Bruce McLaren Motor Racing được thành lập. Không chỉ là một tay đua, Bruce là một kỹ sư thiên tài.', 'image_url' => 'https://mclaren.scene7.com/is/image/mclaren/Bruce-McLaren-M7A-1968:crop-16x9?wid=1600&hei=900'],
            ['year' => 1988, 'tag' => 'Kỷ Nguyên Vàng', 'title' => 'Sự Thống Trị Tuyệt Đối', 'description' => 'Chiếc MP4/4 huyền thoại cùng Ayrton Senna và Alain Prost đã thắng 15 trên 16 chặng đua.', 'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/33/McLaren_MP4-4_Honda_Turbo_%2825723782053%29.jpg'],
            ['year' => 1992, 'tag' => 'Huyền Thoại Đường Phố', 'title' => 'McLaren F1', 'description' => 'Chiếc xe thương mại đầu tiên, và cũng là vĩ đại nhất. Tốc độ 386 km/h.', 'image_url' => 'https://mclaren.scene7.com/is/image/mclaren/McLaren-F1-Road-Car-01:crop-16x9?wid=1600&hei=900'],
            ['year' => 2013, 'tag' => 'Hybrid Hypercar', 'title' => 'McLaren P1™', 'description' => 'Bước vào kỷ nguyên mới với hệ động lực Hybrid hiệu suất cao.', 'image_url' => 'https://carsguide-res.cloudinary.com/image/upload/f_auto,fl_lossy,q_auto,t_cg_hero_large/v1/editorial/mclaren-p1-blue-2013.png'],
        ];
        foreach ($timelines as $t) Timeline::create($t);

        // 3. EVENTS (  
        $events = [
            ['category' => 'PURE McLAREN', 'title' => 'Arctic Experience', 'description' => 'Băng qua những hồ nước đóng băng tại Ivalo, Phần Lan dưới ánh cực quang huyền ảo.', 'image_url' => 'https://mclaren.scene7.com/is/image/mclaren/McLaren-Ice-Driving-Academy-01:crop-16x9?wid=1920&hei=1080', 'link' => '#'],
            ['category' => 'RACING', 'title' => 'GT Series', 'description' => 'Biến giấc mơ tay đua thành hiện thực tại các trường đua F1 danh tiếng.', 'image_url' => 'https://mclaren.scene7.com/is/image/mclaren/Pure-McLaren-Silverstone-06:crop-16x9?wid=1920&hei=1080', 'link' => '#'],
            ['category' => 'BEHIND THE SCENES', 'title' => 'McLaren Technology Centre', 'description' => 'Bước vào thánh địa Woking. Tận mắt chứng kiến quy trình lắp ráp thủ công tỉ mỉ.', 'image_url' => 'https://mclaren.scene7.com/is/image/mclaren/McLaren-MTC-Boulevard-01:crop-16x9?wid=1920&hei=1080', 'link' => '#'],
        ];
        foreach ($events as $e) Event::create($e);
    }
}