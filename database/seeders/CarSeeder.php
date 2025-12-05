<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
  
        $cars = [
            // ==================== 1. ULTIMATE SERIES (ĐỈNH CAO) ====================
            [
                'model_key' => 'w1',
                'name' => 'W1',
                'series' => 'Ultimate',
                'slogan' => 'KẾ THỪA HUYỀN THOẠI.',
                'tagline' => 'Hậu duệ của F1 và P1.',
                'image_url' => 'images/w1-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_W1_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Chiếc xe đường phố mạnh mẽ nhất lịch sử McLaren. Động cơ V8 Hybrid hoàn toàn mới.',
                'gallery_images' => ['images/w1-2.jpg', 'images/w1-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Bộ Ba Thần Thánh', 'content' => 'W1 là mảnh ghép tiếp theo trong dòng dõi xe "1" huyền thoại, đứng cạnh F1 và P1™.'],
                    ['title' => 'Khí Động Học Biến Hình', 'content' => 'Chế độ McLaren Race Mode hạ thấp xe và biến đổi cánh gió, tạo ra lực ép xuống lên tới 1000kg.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 1275], ['l' => 'Mô-men (Nm)', 'v' => 1340], ['l' => '0-200 km/h (s)', 'v' => 5.8, 'd' => true]],
                'specs' => ['Động cơ' => 'V8 Hybrid MHP-8', 'Trọng lượng' => '1,399 kg', 'Giới hạn' => '399 chiếc'],
            ],
            [
                'model_key' => 'f1',
                'name' => 'F1',
                'series' => 'Ultimate',
                'slogan' => 'KHỞI NGUỒN HUYỀN THOẠI.',
                'tagline' => 'Siêu xe vĩ đại nhất.',
                'image_url' => 'images/f1-1.jpg', 
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_F1_Anniversary', 
                'model_3d_url' => null,
                'description' => 'Chiếc xe nhanh nhất thế giới dùng động cơ hút khí tự nhiên. Một tượng đài không thể xô đổ.',
                'gallery_images' => ['images/f1-2.jpg', 'images/f1-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Vàng Ròng', 'content' => 'Khoang động cơ được dát vàng 24k để tản nhiệt tốt nhất cho khối động cơ BMW V12.'],
                    ['title' => 'Ghế Lái Trung Tâm', 'content' => 'Thiết kế 3 chỗ ngồi với người lái ngồi chính giữa để có tầm nhìn và cảm giác lái như xe đua F1.']
                ],
                'stats' => [['l' => 'Tốc độ (km/h)', 'v' => 386], ['l' => 'Công suất (PS)', 'v' => 627], ['l' => '0-100 km/h (s)', 'v' => 3.2, 'd' => true]],
                'specs' => ['Động cơ' => '6.1L V12', 'Năm SX' => '1992', 'Giới hạn' => '106 chiếc'],
            ],
            [
                'model_key' => 'speedtail',
                'name' => 'Speedtail',
                'series' => 'Ultimate',
                'slogan' => 'HYPER-GT.',
                'tagline' => 'Nhanh nhất lịch sử.',
                'image_url' => 'images/speedtail-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_Speedtail_Launch',
                'model_3d_url' => null,
                'description' => 'Thiết kế giọt nước với 3 chỗ ngồi, vô lăng đặt giữa. Tốc độ tối đa 403 km/h.',
                'gallery_images' => ['images/speedtail-2.jpg', 'images/speedtail-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Di Sản F1', 'content' => 'Kế thừa bố trí ghế ngồi trung tâm từ huyền thoại McLaren F1.'],
                    ['title' => 'Vật Liệu Tương Lai', 'content' => 'Sợi carbon dẻo cho phép các cánh tà phía sau uốn cong theo thân xe mà không cần khớp nối.']
                ],
                'stats' => [['l' => 'Tốc độ (km/h)', 'v' => 403], ['l' => 'Công suất (PS)', 'v' => 1070], ['l' => '0-300 km/h (s)', 'v' => 13.0, 'd' => true]],
                'specs' => ['Động cơ' => 'Hybrid V8', 'Cấu hình' => '3 Chỗ ngồi', 'Giới hạn' => '106 chiếc'],
            ],
            [
                'model_key' => 'senna',
                'name' => 'Senna',
                'series' => 'Ultimate',
                'slogan' => 'THUẦN KHIẾT ĐƯỜNG ĐUA.',
                'tagline' => 'Không thỏa hiệp.',
                'image_url' => 'images/senna-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_Senna_Launch',
                'model_3d_url' => null,
                'description' => 'Chiếc xe đường phố tập trung vào đường đua nhất của McLaren.',
                'gallery_images' => ['images/senna-2.jpg', 'images/senna-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Tôn Vinh Ayrton', 'content' => 'Mang tên tay đua F1 vĩ đại nhất mọi thời đại, Senna được thiết kế để thống trị đường đua.'],
                    ['title' => 'Cửa Trong Suốt', 'content' => 'Tùy chọn cửa kính giúp người lái nhìn thấy mặt đường lướt qua ngay bên cạnh.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 800], ['l' => 'Lực ép (kg)', 'v' => 800], ['l' => 'Trọng lượng (kg)', 'v' => 1198]],
                'specs' => ['Động cơ' => '4.0L V8', 'Cánh gió' => 'Active Aero', 'Giới hạn' => '500 chiếc'],
            ],
            [
                'model_key' => 'p1',
                'name' => 'P1™',
                'series' => 'Ultimate',
                'slogan' => 'HUYỀN THOẠI.',
                'tagline' => 'Hypercar Hybrid đầu tiên.',
                'image_url' => 'images/p1-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_P1_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Biểu tượng công nghệ, đặt nền móng cho kỷ nguyên điện khí hóa.',
                'gallery_images' => ['images/p1-2.jpg', 'images/p1-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Công Nghệ F1', 'content' => 'Hệ thống IPAS (Tăng tốc tức thời) và DRS (Giảm lực cản) từ xe đua F1.'],
                    ['title' => 'Race Mode', 'content' => 'Xe hạ thấp 50mm, cánh gió vươn cao, tạo lực ép như xe đua GT3.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 916], ['l' => 'Mô-men (Nm)', 'v' => 900], ['l' => 'Tốc độ (km/h)', 'v' => 350]],
                'specs' => ['Động cơ' => 'V8 + E-Motor', 'Giới hạn' => '375 chiếc', 'Công nghệ' => 'IPAS/DRS'],
            ],
            [
                'model_key' => 'elva',
                'name' => 'Elva',
                'series' => 'Ultimate',
                'slogan' => 'KHÔNG KÍNH CHẮN GIÓ.',
                'tagline' => 'Kết nối trực tiếp.',
                'image_url' => 'images/elva-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_Elva_Launch',
                'model_3d_url' => null,
                'description' => 'Hệ thống AAMS tạo bóng khí ảo bảo vệ người lái.',
                'gallery_images' => ['images/elva-2.jpg', 'images/elva-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Bóng Khí Ảo', 'content' => 'Hệ thống AAMS hắt luồng khí qua đầu người lái, thay thế kính chắn gió vật lý.'],
                    ['title' => 'Tự Do Tuyệt Đối', 'content' => 'Không mui, không cửa sổ, xóa nhòa ranh giới với thiên nhiên.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 815], ['l' => 'Trọng lượng (kg)', 'v' => 1269], ['l' => '0-100 km/h (s)', 'v' => 2.8, 'd' => true]],
                'specs' => ['Động cơ' => 'V8 Twin-Turbo', 'Hệ thống' => 'AAMS', 'Giới hạn' => '149 chiếc'],
            ],
            [
                'model_key' => 'solus-gt',
                'name' => 'Solus GT',
                'series' => 'Ultimate',
                'slogan' => 'TỪ ẢO RA THỰC.',
                'tagline' => 'Gran Turismo Concept.',
                'image_url' => 'images/solus-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/Solus_GT_Reveal',
                'model_3d_url' => null,
                'description' => 'Hiện thực hóa chiếc xe ảo trong game Gran Turismo Sport.',
                'gallery_images' => ['images/solus-2.jpg', 'images/solus-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Động Cơ V10', 'content' => 'Sử dụng động cơ V10 5.2L hút khí tự nhiên quay tới hơn 10.000 vòng/phút.'],
                    ['title' => 'Buồng Lái Tiêm Kích', 'content' => 'Cửa kính dạng vòm trượt về phía trước, người lái ngồi vào như phi công.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 840], ['l' => 'Vòng tua (RPM)', 'v' => 10000], ['l' => 'Lực ép (kg)', 'v' => 1200]],
                'specs' => ['Động cơ' => 'V10 NA', 'Ghế ngồi' => '1', 'Giới hạn' => '25 chiếc'],
            ],

            // ==================== 2. SUPERCARS SERIES (DÒNG CHỦ LỰC) ====================
            [
                'model_key' => '750s',
                'name' => '750S',
                'series' => 'Supercars',
                'slogan' => 'HIỆU SUẤT THUẦN KHIẾT.',
                'tagline' => 'Nhẹ nhất. Mạnh nhất.',
                'image_url' => 'images/750s-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/750S_Launch_Film_Desktop',
                'model_3d_url' => null,
                'description' => 'Định nghĩa lại phân khúc siêu xe. 30% linh kiện mới so với 720S.',
                'gallery_images' => ['images/750s-2.jpg', 'images/750s-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Sự Tiến Hóa', 'content' => '750S là sự chắt lọc tinh túy từ 720S, nhẹ hơn và sắc bén hơn.'],
                    ['title' => 'Kết Nối Cảm Xúc', 'content' => 'Hệ thống ống xả trung tâm bằng thép không gỉ mang lại âm thanh uy lực.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 750], ['l' => '0-100 km/h (s)', 'v' => 2.8, 'd' => true], ['l' => 'Tốc độ (km/h)', 'v' => 332]],
                'specs' => ['Động cơ' => '4.0L V8 Twin-Turbo', 'Trọng lượng' => '1,277 kg', 'Hộp số' => '7 cấp SSG'],
            ],
            [
                'model_key' => '750s-spider',
                'name' => '750S Spider',
                'series' => 'Supercars',
                'slogan' => 'KHÔNG GIỚI HẠN.',
                'tagline' => 'Mui trần. Tốc độ.',
                'image_url' => 'images/750s-spider1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/750S_Spider_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Mui cứng thu vào (RHT) trong 11 giây mà không làm giảm hiệu suất.',
                'gallery_images' => ['images/750s-spider2.jpg', 'images/750s-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Mui Trần Siêu Tốc', 'content' => 'Cơ chế RHT đóng mở chỉ trong 11 giây ở tốc độ lên đến 50km/h.'],
                    ['title' => 'Âm Thanh Vòm', 'content' => 'Cửa sổ sau hạ xuống độc lập để tận hưởng âm thanh V8.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 750], ['l' => 'Đóng mui (s)', 'v' => 11], ['l' => 'Tốc độ (km/h)', 'v' => 332]],
                'specs' => ['Động cơ' => '4.0L V8', 'Mui xe' => 'RHT Composite', 'Trọng lượng' => '1,326 kg'],
            ],
            [
                'model_key' => '765lt',
                'name' => '765LT',
                'series' => 'Supercars',
                'slogan' => 'LONGTAIL TỐI THƯỢNG.',
                'tagline' => 'Giới hạn. Cực đoan.',
                'image_url' => 'images/765lt-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_765LT_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Phiên bản giới hạn 765 chiếc, giảm trọng lượng tối đa.',
                'gallery_images' => ['images/765lt-2.jpg', 'images/765lt-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Di Sản Longtail', 'content' => 'Thân xe dài hơn giúp ổn định luồng khí ở tốc độ cao.'],
                    ['title' => 'Ống Xả Titanium', 'content' => 'Hệ thống 4 ống xả nhẹ hơn thép 40% và chuyển màu khi nóng.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 765], ['l' => '0-200 km/h (s)', 'v' => 7.0, 'd' => true], ['l' => 'Trọng lượng (kg)', 'v' => 1229]],
                'specs' => ['Động cơ' => 'V8 Twin-Turbo', 'Giới hạn' => '765 chiếc', 'Mô-men' => '800 Nm'],
            ],
            [
                'model_key' => '765lt-spider',
                'name' => '765LT Spider',
                'series' => 'Supercars',
                'slogan' => 'ĐỈNH CAO MUI TRẦN.',
                'tagline' => 'Chỉ dành cho số ít.',
                'image_url' => 'images/765lt-spider1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/765LT_Spider_Reveal',
                'model_3d_url' => null,
                'description' => 'Mẫu xe mui trần mạnh mẽ nhất của dòng Longtail.',
                'gallery_images' => ['images/765lt-spider2.jpg', 'images/765lt-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Không Cần Gia Cố', 'content' => 'Giữ nguyên hiệu suất bản Coupe nhờ khung gầm Monocage II-S.'],
                    ['title' => 'Âm Thanh Trực Tiếp', 'content' => 'Âm thanh từ 4 ống xả titan dội thẳng vào khoang lái.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 765], ['l' => '0-100 km/h (s)', 'v' => 2.8, 'd' => true], ['l' => 'Đóng mui (s)', 'v' => 11]],
                'specs' => ['Động cơ' => 'V8 Twin-Turbo', 'Sản xuất' => '765 chiếc', 'Mui' => 'RHT Carbon'],
            ],
            [
                'model_key' => '720s',
                'name' => '720S',
                'series' => 'Supercars',
                'slogan' => 'NÂNG TẦM CHUẨN MỰC.',
                'tagline' => 'Hoàn hảo mọi góc độ.',
                'image_url' => 'images/720s-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_720S_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Thiết kế khí động học lấy cảm hứng từ cá mập trắng.',
                'gallery_images' => ['images/720s-2.jpg', 'images/720s-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Hốc Mắt Độc Đáo', 'content' => 'Đèn pha tích hợp trong hốc hút gió, mô phỏng hốc mắt cá mập trắng.'],
                    ['title' => 'Monocage II', 'content' => 'Khung gầm carbon liền khối bảo vệ tuyệt đối và siêu nhẹ.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 720], ['l' => 'Mô-men xoắn (Nm)', 'v' => 770], ['l' => '0-100 km/h (s)', 'v' => 2.9, 'd' => true]],
                'specs' => ['Động cơ' => '4.0L V8', 'Khung gầm' => 'Monocage II', 'Trọng lượng' => '1,283 kg'],
            ],
            [
                'model_key' => '720s-spider',
                'name' => '720S Spider',
                'series' => 'Supercars',
                'slogan' => 'NÂNG TẦM CHUẨN MỰC.',
                'tagline' => 'Mui trần.',
                'image_url' => 'images/720s-spider1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/720S_Spider_Product_Film',
                'model_3d_url' => null,
                'description' => 'Sức mạnh 720S kết hợp với mui kính điện hóa đổi màu độc đáo.',
                'gallery_images' => ['images/720s-spider2.jpg', 'images/720s-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Mui Kính Điện Hóa', 'content' => 'Mui xe có thể chuyển từ trong suốt sang mờ đục chỉ bằng một nút bấm.'],
                    ['title' => 'Trụ Kính', 'content' => 'Trụ sau bằng kính giúp tăng tầm nhìn tối đa.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 720], ['l' => 'Đóng mui (s)', 'v' => 11], ['l' => '0-100 km/h (s)', 'v' => 2.9, 'd' => true]],
                'specs' => ['Động cơ' => '4.0L V8', 'Mui' => 'RHT Kính điện', 'Trọng lượng' => '1,332 kg'],
            ],
            [
                'model_key' => '675lt',
                'name' => '675LT',
                'series' => 'Supercars',
                'slogan' => 'SỰ TRỞ LẠI CỦA LONGTAIL.',
                'tagline' => 'Sắc lẹm.',
                'image_url' => 'images/675lt-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_675LT_Launch_Film',
                'model_3d_url' => null,
                'description' => 'Hồi sinh cái tên Longtail huyền thoại. Tập trung hoàn toàn vào đường đua.',
                'gallery_images' => ['images/675lt-2.jpg', 'images/675lt-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Di Sản 1997', 'content' => 'Vinh danh chiếc F1 GTR Longtail 1997.'],
                    ['title' => 'Nhẹ Hơn', 'content' => 'Nhẹ hơn 650S tới 100kg.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 675], ['l' => '0-100 km/h (s)', 'v' => 2.9, 'd' => true], ['l' => 'Tốc độ', 'v' => 330]],
                'specs' => ['Động cơ' => '3.8L V8', 'Sản xuất' => '500 chiếc', 'Đặc điểm' => 'Longtail'],
            ],
            [
                'model_key' => '650s',
                'name' => '650S',
                'series' => 'Supercars',
                'slogan' => 'KẾT HỢP HOÀN HẢO.',
                'tagline' => 'Cổ điển hiện đại.',
                'image_url' => 'images/650s-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_650S_Launch',
                'model_3d_url' => null,
                'description' => 'Hội tụ 50 năm kinh nghiệm đua xe. Mạnh hơn, nhanh hơn 12C.',
                'gallery_images' => ['images/650s-2.jpg', 'images/650s-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Hệ Thống PCC', 'content' => 'ProActive Chassis Control giúp xe vừa êm ái khi đi phố, vừa cứng vững trong trường đua.'],
                    ['title' => 'Thiết Kế Lai', 'content' => 'Đầu xe mang ngôn ngữ thiết kế của P1.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 650], ['l' => 'Mô-men (Nm)', 'v' => 678], ['l' => '0-100 km/h (s)', 'v' => 3.0, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Khí động học' => 'Active Airbrake', 'Năm SX' => '2014'],
            ],
            [
                'model_key' => '12c',
                'name' => 'MP4-12C',
                'series' => 'Supercars',
                'slogan' => 'SỰ KHỞI ĐẦU.',
                'tagline' => 'Kỷ nguyên mới.',
                'image_url' => 'images/12c-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_12C_Footage',
                'model_3d_url' => null,
                'description' => 'Chiếc xe sản xuất hàng loạt đầu tiên của McLaren Automotive hiện đại.',
                'gallery_images' => ['images/12c-2.jpg', 'images/12c-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Tên Gọi', 'content' => 'MP4 là Project 4 (F1), 12 là chỉ số hiệu suất, C là Carbon.'],
                    ['title' => 'Phanh Khí', 'content' => 'Cánh gió sau hoạt động như phanh không khí.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 600], ['l' => 'Mô-men', 'v' => 600], ['l' => '0-100', 'v' => 3.1, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Năm SX' => '2011', 'Công nghệ' => 'Brake Steer'],
            ],

            // ==================== 3. HYBRID & GT SERIES ====================
            [
                'model_key' => 'artura',
                'name' => 'Artura',
                'series' => 'Hybrid',
                'slogan' => 'KỶ NGUYÊN MỚI.',
                'tagline' => 'Hiệu suất cao Hybrid.',
                'image_url' => 'images/artura-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/Artura-Launch-Film',
                'model_3d_url' => null,
                'description' => 'Sự kết hợp hoàn hảo giữa động cơ V6 và E-Motor trên khung gầm MCLA mới.',
                'gallery_images' => ['images/artura-2.jpg', 'images/artura-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Kiến Trúc MCLA', 'content' => 'Sử dụng kiến trúc McLaren Carbon Lightweight Architecture (MCLA) tối ưu hóa cho hệ truyền động Hybrid.'],
                    ['title' => 'Phản Ứng Tức Thì', 'content' => 'E-motor lấp đầy khoảng trễ của Turbo.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 680], ['l' => 'Phạm vi điện (km)', 'v' => 30], ['l' => '0-100 km/h (s)', 'v' => 3.0, 'd' => true]],
                'specs' => ['Động cơ' => 'V6 Hybrid', 'Trọng lượng' => '1,395 kg', 'Khung gầm' => 'MCLA'],
            ],
            [
                'model_key' => 'artura-spider',
                'name' => 'Artura Spider',
                'series' => 'Hybrid',
                'slogan' => 'CẢM XÚC CHÂN THỰC.',
                'tagline' => 'Gió và Tốc độ.',
                'image_url' => 'images/artura-spider-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/Artura_Spider_Launch',
                'model_3d_url' => null,
                'description' => 'Trải nghiệm lái xe điện khí hóa mui trần đầy cảm xúc.',
                'gallery_images' => ['images/artura-spider2.jpg', 'images/artura-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Yên Tĩnh Tuyệt Đối', 'content' => 'Lướt đi trong sự im lặng hoàn toàn ở chế độ EV.'],
                    ['title' => 'Spinning Wheels', 'content' => 'Hệ thống kiểm soát lực kéo mới cho phép drift an toàn.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 680], ['l' => 'Đóng mui (s)', 'v' => 11], ['l' => '0-100 km/h (s)', 'v' => 3.0, 'd' => true]],
                'specs' => ['Động cơ' => 'V6 Hybrid', 'Mui' => 'RHT', 'Trọng lượng' => '1,457 kg'],
            ],
            [
                'model_key' => 'gts',
                'name' => 'GTS',
                'series' => 'GT',
                'slogan' => 'THÁCH THỨC MỌI CUNG ĐƯỜNG.',
                'tagline' => 'Siêu xe tiện nghi.',
                'image_url' => 'images/gts-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_GTS_Launch',
                'model_3d_url' => null,
                'description' => 'Thoải mái cho những hành trình dài nhưng vẫn giữ ADN đường đua.',
                'gallery_images' => ['images/gts-2.jpg', 'images/gts-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Nâng Gầm Cực Nhanh', 'content' => 'Hệ thống nâng mũi xe chỉ mất 4 giây.'],
                    ['title' => 'Không Gian Hành Lý', 'content' => 'Tổng dung tích 570 lít, đủ cho những chuyến du lịch dài ngày.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 635], ['l' => 'Hành lý (Lít)', 'v' => 570], ['l' => '0-100 km/h (s)', 'v' => 3.2, 'd' => true]],
                'specs' => ['Động cơ' => 'V8 Twin-Turbo', 'Khoang hành lý' => '570 Lít', 'Trọng lượng' => '1,530 kg'],
            ],
            [
                'model_key' => 'gt',
                'name' => 'GT',
                'series' => 'GT',
                'slogan' => 'LUẬT CHƠI MỚI.',
                'tagline' => 'Grand Tourer hiện đại.',
                'image_url' => 'images/gt-1.jpg', 
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_GT_Launch',
                'model_3d_url' => null,
                'description' => 'Chiếc xe siêu nhẹ định nghĩa lại dòng Grand Tourer.',
                'gallery_images' => ['images/gt-2.jpg', 'images/gt-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Động Cơ Đặt Thấp', 'content' => 'Thiết kế động cơ thấp giúp tạo ra khoang hành lý rộng rãi phía sau.'],
                    ['title' => 'Êm Ái', 'content' => 'Hệ thống treo được tinh chỉnh để hấp thụ rung động tốt nhất.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 620], ['l' => 'Hành lý (L)', 'v' => 570], ['l' => '0-100 (s)', 'v' => 3.2, 'd' => true]],
                'specs' => ['Động cơ' => '4.0L V8', 'Loại xe' => 'Grand Tourer', 'Năm SX' => '2019'],
            ],

            // ==================== 4. SPORTS SERIES (THỂ THAO & NHẬP MÔN) ====================
            [
                'model_key' => '600lt',
                'name' => '600LT',
                'series' => 'Sports Series',
                'slogan' => 'DẤU ẤN LONGTAIL.',
                'tagline' => 'Top-Exit Exhaust.',
                'image_url' => 'images/600lt-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_600LT_Launch',
                'model_3d_url' => 'models/2019_mclaren_600lt.glb', 
                'description' => 'Ống xả đặt trên đỉnh độc đáo, phun lửa và âm thanh uy lực.',
                'gallery_images' => ['images/600lt-2.jpg', 'images/600lt-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Ống Xả Phun Lửa', 'content' => 'Ống xả Top-exit tạo ra cột lửa ngoạn mục ngay trong tầm nhìn gương chiếu hậu.'],
                    ['title' => 'Lốp Trofeo R', 'content' => 'Trang bị lốp chuyên dụng đường đua Pirelli P Zero Trofeo R.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 600], ['l' => 'Trọng lượng (kg)', 'v' => 1247], ['l' => '0-100 km/h (s)', 'v' => 2.9, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Ống xả' => 'Top-Exit', 'Lốp' => 'Pirelli Trofeo R'],
            ],
            [
                'model_key' => '600lt-spider',
                'name' => '600LT Spider',
                'series' => 'Sports Series',
                'slogan' => 'LONGTAIL MUI TRẦN.',
                'tagline' => 'Âm thanh cực đại.',
                'image_url' => 'images/600lt-spider1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/600LT_Spider_Launch',
                'model_3d_url' => null,
                'description' => 'Tận hưởng âm thanh ống xả Top-exit trực tiếp hơn bao giờ hết.',
                'gallery_images' => ['images/600lt-spider2.jpg', 'images/600lt-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Tăng Cân Tối Thiểu', 'content' => 'Chỉ nặng hơn bản Coupe 50kg nhờ khung carbon.'],
                    ['title' => 'Gió Và Lửa', 'content' => 'Trải nghiệm đa giác quan với gió trời và lửa từ ống xả sau gáy.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 600], ['l' => 'Tăng trọng lượng (kg)', 'v' => 50], ['l' => '0-100 km/h (s)', 'v' => 2.9, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Mui' => 'RHT', 'Ống xả' => 'Top-Exit'],
            ],
            [
                'model_key' => '620r',
                'name' => '620R',
                'series' => 'Sports Series',
                'slogan' => 'XE ĐUA ĐƯỜNG PHỐ.',
                'tagline' => 'GT4 hợp pháp.',
                'image_url' => 'images/620r-1.jpg', 
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_620R_Launch',
                'model_3d_url' => null,
                'description' => 'Phiên bản đường phố của xe đua 570S GT4.',
                'gallery_images' => ['images/620r-2.jpg', 'images/620r-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Hệ Thống Treo Đua', 'content' => 'Sử dụng giảm xóc chỉnh cơ 2 chiều (bằng tay) lấy trực tiếp từ xe đua GT4.'],
                    ['title' => 'Không Cốp Xe', 'content' => 'Tối ưu trọng lượng và thiết kế khí động học.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 620], ['l' => 'Lực ép (kg)', 'v' => 185], ['l' => '0-100 (s)', 'v' => 2.9, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Giới hạn' => '350 chiếc', 'Gốc' => 'GT4 Race Car'],
            ],
            [
                'model_key' => '570s',
                'name' => '570S',
                'series' => 'Sports Series',
                'slogan' => 'THỂ THAO HÀNG NGÀY.',
                'tagline' => 'Dành cho người lái.',
                'image_url' => 'images/570s-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_570S_Launch',
                'model_3d_url' => null,
                'description' => 'Dễ lái, tiện nghi nhưng vẫn mang lại hiệu suất siêu xe đích thực.',
                'gallery_images' => ['images/570s-2.jpg', 'images/570s-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'MonoCell II', 'content' => 'Khung gầm được tinh chỉnh để ra vào xe dễ dàng hơn hàng ngày.'],
                    ['title' => 'Thiết Kế Cửa', 'content' => 'Cửa xe có các "gân" nổi dẫn luồng khí làm mát động cơ.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 570], ['l' => 'Mô-men (Nm)', 'v' => 600], ['l' => '0-100 km/h (s)', 'v' => 3.2, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Khung gầm' => 'MonoCell II', 'Cửa' => 'Dihedral'],
            ],
            [
                'model_key' => '570s-spider',
                'name' => '570S Spider',
                'series' => 'Sports Series',
                'slogan' => 'TỰ DO TUYỆT ĐỐI.',
                'tagline' => 'Mui trần thể thao.',
                'image_url' => 'images/570s-spider1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/570S_Spider_Launch',
                'model_3d_url' => null,
                'description' => 'Mui cứng hai mảnh thu vào gọn gàng, giữ nguyên thiết kế khí động học.',
                'gallery_images' => ['images/570s-spider2.jpg', 'images/570s-spider3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Cánh Gió Cao Hơn', 'content' => 'Cánh gió đuôi cao thêm 12mm để bù đắp khí động học khi mở mui.'],
                    ['title' => 'Cứng Vững', 'content' => 'Không cần thanh gia cường nặng nề nhờ khung carbon siêu cứng.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 570], ['l' => 'Đóng mui (s)', 'v' => 15], ['l' => 'Tốc độ (km/h)', 'v' => 328]],
                'specs' => ['Động cơ' => '3.8L V8', 'Mui' => 'RHT', 'Trọng lượng' => '1,359 kg'],
            ],
            [
                'model_key' => '570gt',
                'name' => '570GT',
                'series' => 'Sports Series',
                'slogan' => 'DU LỊCH PHONG CÁCH.',
                'tagline' => 'Tinh tế & Êm ái.',
                'image_url' => 'images/570gt-1.jpg',
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_570GT_Launch',
                'model_3d_url' => null,
                'description' => 'Biến thể sang trọng và thực dụng hơn của 570S.',
                'gallery_images' => ['images/570gt-2.jpg', 'images/570gt-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'Cốp Sau Kính', 'content' => 'Cửa kính phía sau mở sang một bên độc đáo.'],
                    ['title' => 'Êm Ái', 'content' => 'Hệ thống treo mềm hơn cho những chuyến đi dài.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 570], ['l' => 'Hành lý (L)', 'v' => 370], ['l' => '0-100', 'v' => 3.4, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Cửa sau' => 'Kính mở ngang', 'Giảm xóc' => 'Mềm hơn'],
            ],
            [
                'model_key' => '540c',
                'name' => '540C',
                'series' => 'Sports Series',
                'slogan' => 'KHỞI ĐẦU ĐAM MÊ.',
                'tagline' => 'Nhập môn siêu xe.',
                'image_url' => 'images/540c-1.jpg', 
                'video_url' => 'https://mclaren.scene7.com/is/content/mclaren/McLaren_540C_Launch',
                'model_3d_url' => null,
                'description' => 'Mẫu xe dễ tiếp cận nhất của McLaren, dành cho việc sử dụng hàng ngày.',
                'gallery_images' => ['images/540c-2.jpg', 'images/540c-3.jpg'], // 💡 SỬA TÊN CỘT
                'stories' => [
                    ['title' => 'DNA Siêu Xe', 'content' => 'Vẫn dùng chung khung gầm carbon và động cơ V8 như các đàn anh.'],
                    ['title' => 'Thân Thiện', 'content' => 'Hệ thống treo được tinh chỉnh để đi phố êm ái nhất.']
                ],
                'stats' => [['l' => 'Công suất (PS)', 'v' => 540], ['l' => 'Mô-men (Nm)', 'v' => 540], ['l' => '0-100 (s)', 'v' => 3.5, 'd' => true]],
                'specs' => ['Động cơ' => '3.8L V8', 'Giá' => 'Thấp nhất', 'Thị trường' => 'Châu Á/Âu'],
            ],
        ];

        
        foreach ($cars as $car) {
            try {
                // Sửa logic JSON encoding: Đảm bảo chỉ encode khi là mảng, nếu không để nguyên
                if (isset($car['stories']) && is_array($car['stories'])) {
                    $car['stories'] = json_encode($car['stories'], JSON_UNESCAPED_UNICODE);
                } else {
                    unset($car['stories']);
                }

                if (isset($car['gallery_images']) && is_array($car['gallery_images'])) { // 💡 SỬA TÊN CỘT
                    $car['gallery_images'] = json_encode($car['gallery_images'], JSON_UNESCAPED_UNICODE);
                } else {
                    unset($car['gallery_images']);
                }

                if (isset($car['stats']) && is_array($car['stats'])) {
                    $car['stats'] = json_encode($car['stats'], JSON_UNESCAPED_UNICODE);
                } else {
                    unset($car['stats']);
                }

                if (isset($car['specs']) && is_array($car['specs'])) {
                    $car['specs'] = json_encode($car['specs'], JSON_UNESCAPED_UNICODE);
                } else {
                    unset($car['specs']);
                }
                
                // Đảm bảo các trường không tồn tại trong mảng cars (ví dụ: 'gallery') bị loại bỏ
                unset($car['gallery']);

                \App\Models\Car::updateOrCreate(['model_key' => $car['model_key']], $car);
                echo "✅ Inserted/Updated: {$car['name']}\n"; 
            } catch (\Exception $e) {
                echo "\n❌ LỖI: {$car['name']}\n";
                echo "Chi tiết: " . $e->getMessage() . "\n"; 
            }
        }
    }
}