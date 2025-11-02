document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Navbar Scroll & Active Link Logic ---
    const navbar = document.querySelector('header .navbar');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    let lastScrollTop = 0;

    // Highlight active nav link based on current URL
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        // Kiểm tra nếu href của link kết thúc bằng currentPath (dễ dàng hơn khi route không phải /)
        if (link.getAttribute('href') === currentPath || link.getAttribute('href').endsWith(currentPath)) {
             // Logic để xử lý route('cars') active cả trên route('car.details')
            if (currentPath.startsWith('/car-details')) {
                // Kiểm tra xem link có phải là link 'Xe McLaren' không
                if (link.getAttribute('href').endsWith('/cars')) {
                    link.classList.add('active');
                }
            } else {
                link.classList.add('active');
            }
        }
    });
    
    // Nếu trang hiện tại là trang chi tiết, đánh dấu link 'Xe McLaren' là active
    if (currentPath.includes('/car-details')) {
         navLinks.forEach(link => {
            if (link.getAttribute('href').endsWith('/cars')) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Add 'scrolled' class for styling (dù đã có CSS)
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Logic ẩn/hiện Navbar khi cuộn (hiệu ứng mượt mà)
        if (scrollTop > lastScrollTop && scrollTop > 150) { // Bắt đầu ẩn sau 150px
            navbar.style.transform = 'translateY(-100%)'; 
        } else {
            navbar.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
    });

    // --- 2. Scroll Reveal Effect ---
    // Hiệu ứng các phần tử hiện ra từ dưới lên khi cuộn đến
    const revealElements = document.querySelectorAll('.reveal');

    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.1 // 10% của phần tử nằm trong viewport
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Thêm class 'visible' để kích hoạt animation CSS
                entry.target.classList.add('is-visible');
                // Ngừng theo dõi sau khi đã hiện
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    revealElements.forEach(el => {
        // Thiết lập style ban đầu (opacity: 0, transform: translateY(20px))
        el.style.opacity = 0;
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        
        // Thêm một class trigger để CSS visibility khi cần thiết
        if (el.classList.contains('car-item-card')) {
            el.style.transitionDelay = `${Math.random() * 0.2}s`; // Hiệu ứng delay ngẫu nhiên cho các card xe
        }

        observer.observe(el);
    });
    
    // Thêm CSS cho hiệu ứng Scroll Reveal (vì không có file responsive.css)
    const style = document.createElement('style');
    style.textContent = `
        .is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    // --- 3. Slideshow Logic (for Homepage) - Giữ nguyên nếu cần, nhưng đã có slideshow.js ---
    // Kiểm tra và xóa logic slideshow thừa ở đây nếu có.
});
