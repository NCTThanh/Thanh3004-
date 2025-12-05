
document.addEventListener('DOMContentLoaded', () => {
    // --------------------------------------------------------------------------
    // Logic 1: Xử lý Navbar khi cuộn trang (Sticky Navbar & Ẩn/Hiện)
    // --------------------------------------------------------------------------
    const navbar = document.querySelector('header .navbar');
    
    let lastScrollTop = 0; 
    
   
    if (navbar && navbar.style.position === 'fixed') {
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
           
            if (scrollTop > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
    
           
            if (scrollTop > lastScrollTop) {
                
                navbar.style.transform = 'translateY(-100%)'; 
            } else {
                
                navbar.style.transform = 'translateY(0)';
            }
    
            lastScrollTop = scrollTop;
        });
    }


    // --------------------------------------------------------------------------
    // Logic 2: Xử lý Chuyển đổi Dark/Light Theme
    // --------------------------------------------------------------------------
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    
    const currentTheme = localStorage.getItem('theme') || 'dark-theme';
    body.classList.add(currentTheme);
    
    
    if (themeToggle) {
        updateThemeIcon(currentTheme);

       
        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-theme')) {
                body.classList.replace('dark-theme', 'light-theme');
                localStorage.setItem('theme', 'light-theme');
                updateThemeIcon('light-theme');
            } else {
                body.classList.replace('light-theme', 'dark-theme');
                localStorage.setItem('theme', 'dark-theme');
                updateThemeIcon('dark-theme');
            }
        });
    }

    // Hàm cập nhật icon
    function updateThemeIcon(theme) {
        if (theme === 'dark-theme') {
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>'; 
        } else {
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>'; 
        }
    }


    // --------------------------------------------------------------------------
    // Logic 3: Xử lý Slideshow Hero Section
    // --------------------------------------------------------------------------
    const slideshow = document.getElementById('hero-slideshow');
    
    if (!slideshow) return;

    const slides = slideshow.querySelectorAll('.slide');
    let currentSlide = 0;

    // Khởi tạo slides: thiết lập background-image
    slides.forEach(slide => {
        const imageUrl = slide.getAttribute('data-image');
        slide.style.backgroundImage = `url('${imageUrl}')`;
    });

    function showSlide(index) {
        // Loại bỏ class active khỏi tất cả slide
        slides.forEach(slide => slide.classList.remove('slide-active'));
        
        // Thêm class active cho slide hiện tại
        slides[index].classList.add('slide-active');
    }

    function nextSlide() {
        // Tăng chỉ số slide, nếu vượt quá số lượng thì quay về 0
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    // Hiển thị slide đầu tiên khi tải trang
    showSlide(currentSlide);

    // Tự động chuyển slide sau mỗi 5 giây
    setInterval(nextSlide, 5000);
});
