document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Navbar Scroll & Active Link Logic ---
    const navbar = document.querySelector('header .navbar');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    let lastScrollTop = 0;

    
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        
        if (link.getAttribute('href') === currentPath || link.getAttribute('href').endsWith(currentPath)) {
             
            if (currentPath.startsWith('/car-details')) {
                
                if (link.getAttribute('href').endsWith('/cars')) {
                    link.classList.add('active');
                }
            } else {
                link.classList.add('active');
            }
        }
    });
    
    
    if (currentPath.includes('/car-details')) {
         navLinks.forEach(link => {
            if (link.getAttribute('href').endsWith('/cars')) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

       
        if (scrollTop > lastScrollTop && scrollTop > 150) { 
            navbar.style.transform = 'translateY(-100%)'; 
        } else {
            navbar.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
    });

    // --- 2. Scroll Reveal Effect ---
    
    const revealElements = document.querySelectorAll('.reveal');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1 
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                
                entry.target.classList.add('is-visible');
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    revealElements.forEach(el => {
        
        el.style.opacity = 0;
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        
        
        if (el.classList.contains('car-item-card')) {
            el.style.transitionDelay = `${Math.random() * 0.2}s`; 
        }

        observer.observe(el);
    });
    

    const style = document.createElement('style');
    style.textContent = `
        .is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);

    
});
