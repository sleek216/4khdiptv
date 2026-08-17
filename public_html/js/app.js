/**
 * BestLiveIPTV - Premium JavaScript
 * Ultra Modern Interactive Features
 */

document.addEventListener('DOMContentLoaded', function () {
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            disable: 'mobile'
        });
    }

    // Header Scroll Effect
    initHeaderScroll();

    // Mobile Menu Toggle
    initMobileMenu();

    // FAQ Accordion
    initFaqAccordion();

    // Back to Top Button
    initBackToTop();

    // Pricing Tabs
    initPricingTabs();

    // Smooth Scroll for Anchor Links
    initSmoothScroll();

    // Number Counter Animation
    initCounterAnimation();

    // Form Validation
    initFormValidation();

    // Hero Channel Scroll Arrows
    initChannelScroll();
});

/**
 * Header Scroll Effect
 */
function initHeaderScroll() {
    const header = document.getElementById('header');
    if (!header) return;

    let lastScroll = 0;
    const scrollThreshold = 50; // Reduced threshold for quicker response
    let ticking = false;

    function updateHeader() {
        const currentScroll = window.pageYOffset;

        // Add/remove scrolled class based on scroll position
        if (currentScroll > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateHeader);
            ticking = true;
        }
    }

    // Use passive scroll listener for better performance
    window.addEventListener('scroll', requestTick, { passive: true });

    // Initial check in case page is already scrolled
    updateHeader();
}

/**
 * Mobile Menu Toggle
 */
function initMobileMenu() {
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const body = document.body;

    if (!mobileToggle || !mobileMenu) return;

    // Enhanced mobile toggle functionality
    mobileToggle.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const isActive = mobileToggle.classList.contains('active');

        if (isActive) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    });

    function openMobileMenu() {
        mobileToggle.classList.add('active');
        mobileMenu.classList.add('active');
        body.style.overflow = 'hidden';

        // Add entrance animation to menu items
        const menuItems = mobileMenu.querySelectorAll('.mobile-nav-links a');
        menuItems.forEach((item, index) => {
            item.style.transform = 'translateX(-20px)';
            item.style.opacity = '0';
            setTimeout(() => {
                item.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                item.style.transform = 'translateX(0)';
                item.style.opacity = '1';
            }, index * 50 + 100);
        });
    }

    function closeMobileMenu() {
        mobileToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
        body.style.overflow = '';

        // Reset menu items animation
        const menuItems = mobileMenu.querySelectorAll('.mobile-nav-links a');
        menuItems.forEach(item => {
            item.style.transform = '';
            item.style.opacity = '';
            item.style.transition = '';
        });
    }

    // Close menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            // Add ripple effect
            createRipple(e, link);

            setTimeout(() => {
                closeMobileMenu();
            }, 150);
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
            if (mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
}


/**
 * FAQ Accordion
 */
function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active', !isActive);
        });
    });
}

/**
 * Hero Channel Scroll Arrows
 */
function initChannelScroll() {
    const channelGrid = document.getElementById('channelGrid');
    const scrollLeftBtn = document.getElementById('channelScrollLeft');
    const scrollRightBtn = document.getElementById('channelScrollRight');

    if (!channelGrid || !scrollLeftBtn || !scrollRightBtn) return;

    const scrollAmount = 260;

    scrollLeftBtn.addEventListener('click', () => {
        channelGrid.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    scrollRightBtn.addEventListener('click', () => {
        channelGrid.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
}

/**
 * Back to Top Button
 */
function initBackToTop() {
    const backToTop = document.getElementById('backToTop');
    if (!backToTop) return;

    const scrollThreshold = 500;

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > scrollThreshold) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Pricing Tabs
 */
function initPricingTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all buttons
            tabBtns.forEach(b => b.classList.remove('active'));

            // Add active to clicked button
            btn.classList.add('active');

            // Here you would typically filter/show packages based on the selected duration
            const duration = btn.dataset.tab;
            console.log('Selected duration:', duration);

            // Add loading animation to pricing cards
            const pricingCards = document.querySelectorAll('.pricing-card');
            pricingCards.forEach(card => {
                card.style.opacity = '0.5';
                card.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 200);
            });
        });
    });
}

/**
 * Smooth Scroll for Anchor Links
 */
function initSmoothScroll() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');

            if (href === '#') return;

            const target = document.querySelector(href);
            if (!target) return;

            e.preventDefault();

            const headerOffset = 100;
            const elementPosition = target.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        });
    });
}

/**
 * Number Counter Animation
 */
function initCounterAnimation() {
    const counters = document.querySelectorAll('.stat-number[data-count]');

    if (counters.length === 0) return;

    const animateCounter = (counter) => {
        const target = parseFloat(counter.dataset.count);
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = current.toFixed(1) + '%';
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target + '%';
            }
        };

        updateCounter();
    };

    // Use Intersection Observer to trigger animation when visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
}

/**
 * Form Validation
 */
function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                removeError(field);

                if (!field.value.trim()) {
                    isValid = false;
                    showError(field, 'This field is required');
                } else if (field.type === 'email' && !isValidEmail(field.value)) {
                    isValid = false;
                    showError(field, 'Please enter a valid email address');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
}

function showError(field, message) {
    field.classList.add('error');

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;

    field.parentNode.appendChild(errorDiv);
}

function removeError(field) {
    field.classList.remove('error');

    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Lazy Load Images
 */
function initLazyLoad() {
    const lazyImages = document.querySelectorAll('img[data-src]');

    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
        });
    }
}

/**
 * Parallax Effect
 */
function initParallax() {
    const parallaxElements = document.querySelectorAll('[data-parallax]');

    if (parallaxElements.length === 0) return;

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;

        parallaxElements.forEach(el => {
            const speed = parseFloat(el.dataset.parallax) || 0.5;
            const yPos = -(scrolled * speed);
            el.style.transform = `translateY(${yPos}px)`;
        });
    });
}

/**
 * Ripple Effect for Buttons
 */
document.addEventListener('click', function (e) {
    const button = e.target.closest('.btn');
    if (!button) return;

    const ripple = document.createElement('span');
    ripple.className = 'ripple';

    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = e.clientX - rect.left - size / 2 + 'px';
    ripple.style.top = e.clientY - rect.top - size / 2 + 'px';

    button.appendChild(ripple);

    setTimeout(() => ripple.remove(), 600);
});

// Add ripple styles dynamically
const rippleStyles = document.createElement('style');
rippleStyles.textContent = `
    .btn {
        position: relative;
        overflow: hidden;
    }
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
        pointer-events: none;
    }
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyles);

/**
 * Toast Notification System
 */
window.showToast = function (message, type = 'info', duration = 3000) {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <i class="ph-fill ${getToastIcon(type)}"></i>
        <span>${message}</span>
    `;

    // Create container if it doesn't exist
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    container.appendChild(toast);

    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);

    // Remove after duration
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, duration);
};

function getToastIcon(type) {
    const icons = {
        success: 'ph-check-circle',
        error: 'ph-x-circle',
        warning: 'ph-warning',
        info: 'ph-info'
    };
    return icons[type] || icons.info;
}

// Add toast styles dynamically
const toastStyles = document.createElement('style');
toastStyles.textContent = `
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .toast {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: #1e293b;
        color: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        transform: translateX(120%);
        transition: transform 0.3s ease;
        min-width: 280px;
    }
    .toast.show {
        transform: translateX(0);
    }
    .toast i {
        font-size: 1.25rem;
    }
    .toast-success i { color: #10B981; }
    .toast-error i { color: #EF4444; }
    .toast-warning i { color: #F59E0B; }
    .toast-info i { color: #3B82F6; }
`;
document.head.appendChild(toastStyles);

/**
 * Create ripple effect for buttons
 */
function createRipple(event, element) {
    const ripple = document.createElement('div');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;

    ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(0, 102, 255, 0.3);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
        z-index: 1000;
    `;

    // Add ripple styles if not already present
    if (!document.querySelector('#ripple-styles')) {
        const style = document.createElement('style');
        style.id = 'ripple-styles';
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    element.style.position = element.style.position || 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);

    setTimeout(() => {
        ripple.remove();
    }, 600);
}


/**
 * Full-Screen Hero Playing Overlay
 */
document.addEventListener('DOMContentLoaded', function () {
    initHeroPlayingOverlay();
});

function initHeroPlayingOverlay() {
    const channelCards = document.querySelectorAll('.interactive-channel');
    const heroSection = document.getElementById('heroSection');
    const heroPlayingOverlay = document.getElementById('heroPlayingOverlay');
    const backToHomeBtn = document.getElementById('backToHome');
    const fullscreenChannelName = document.getElementById('fullscreenChannelName');

    if (!heroSection || !heroPlayingOverlay || channelCards.length === 0) return;

    // Open fullscreen playing view when clicking on a channel card
    channelCards.forEach(card => {
        card.addEventListener('click', function (e) {
            e.preventDefault();

            const channelName = this.dataset.channel;
            const channelColor = this.dataset.color;
            const channelText = this.querySelector('span').textContent;

            // Update channel name
            if (fullscreenChannelName) {
                fullscreenChannelName.textContent = channelText;
                fullscreenChannelName.style.color = channelColor;
            }

            // Add channel-specific class to hero section
            heroSection.className = 'hero playing-mode';
            heroSection.classList.add('playing-' + channelName);

            // Apply channel color branding
            applyFullscreenBranding(channelColor);

            // Show overlay immediately (CSS handles animation)
            heroPlayingOverlay.classList.add('active');
        });
    });

    // Back to home button
    if (backToHomeBtn) {
        backToHomeBtn.addEventListener('click', function () {
            // Hide overlay
            heroPlayingOverlay.classList.remove('active');

            // Reset hero section after animation
            setTimeout(() => {
                heroSection.className = 'hero';
            }, 400);
        });
    }

    function applyFullscreenBranding(color) {
        const playIconHuge = heroPlayingOverlay.querySelector('.play-icon-huge');
        const liveDotLarge = heroPlayingOverlay.querySelector('.live-dot-large');
        const qualityTagsLarge = heroPlayingOverlay.querySelectorAll('.quality-tag-large');

        if (playIconHuge) {
            playIconHuge.style.background = `linear-gradient(135deg, ${color}, ${adjustColor(color, -20)})`;
            playIconHuge.style.boxShadow = `0 25px 70px ${hexToRgba(color, 0.5)}`;
        }

        if (liveDotLarge) {
            liveDotLarge.style.background = color;
            liveDotLarge.style.boxShadow = `0 0 20px ${hexToRgba(color, 0.8)}`;
        }

        qualityTagsLarge.forEach(tag => {
            tag.style.borderColor = hexToRgba(color, 0.3);
            tag.style.background = hexToRgba(color, 0.15);
        });
    }

    // Helper function to convert hex to rgba
    function hexToRgba(hex, alpha) {
        const r = parseInt(hex.slice(1, 3), 16);
        const g = parseInt(hex.slice(3, 5), 16);
        const b = parseInt(hex.slice(5, 7), 16);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    // Helper function to adjust color brightness
    function adjustColor(color, amount) {
        const num = parseInt(color.replace('#', ''), 16);
        const r = Math.max(0, Math.min(255, (num >> 16) + amount));
        const g = Math.max(0, Math.min(255, ((num >> 8) & 0x00FF) + amount));
        const b = Math.max(0, Math.min(255, (num & 0x0000FF) + amount));
        return '#' + ((r << 16) | (g << 8) | b).toString(16).padStart(6, '0');
    }

    // Add click animation to play icon
    const playIconHuge = heroPlayingOverlay?.querySelector('.play-icon-huge');
    if (playIconHuge) {
        playIconHuge.addEventListener('click', function () {
            // Add pulse animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);

            // Show toast notification
            if (typeof showToast === 'function') {
                showToast('Starting playback...', 'info', 2000);
            }
        });
    }
}
