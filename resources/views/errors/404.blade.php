<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Error - Sistem Beasiswa')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Additional Head Content -->
    @stack('styles')
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="bg-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>

    <!-- Glassmorphism Header -->
    <header class="glass-header">
        <nav class="header-nav">
            <div class="nav-container">
                <a class="brand-logo" href="{{ route('home') }}">
                    <div class="logo-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <span class="brand-text">Sistem Beasiswa</span>
                </a>
                
                <!-- User Info (if logged in) -->
                @auth
                    <div class="user-info">
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </div>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Error Content -->
    <main class="error-main">
        <div class="error-container">
            <div class="error-content">
                <!-- Animated 404 Number -->
                <div class="error-number">
                    <span class="four">4</span>
                    <span class="zero">0</span>
                    <span class="four">4</span>
                </div>
                
                <!-- Error Message -->
                <div class="error-message">
                    <h1 class="error-title">Oops! Halaman Tidak Ditemukan</h1>
                    <p class="error-description">
                        Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau URL yang Anda masukkan salah.
                    </p>
                </div>
                
                <!-- Floating Elements -->
                <div class="floating-elements">
                    <div class="float-element graduation-cap">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="float-element book">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="float-element trophy">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="float-element star">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="error-actions">
                    <a href="{{ route('home') }}" class="btn btn-home">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Glassmorphism Footer -->
    <footer class="glass-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-logo">
                        <i class="fas fa-graduation-cap"></i>
                        <span>© {{ date('Y') }} Sistem Beasiswa</span>
                    </div>
                    <p class="footer-tagline">Membangun masa depan melalui pendidikan</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Error Layout Specific JavaScript -->
    <script>

        // Add click animation to buttons (ripple effect)
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple-effect 0.6s ease-out;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
        
        // Add keyframe for ripple effect
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes ripple-effect {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(rippleStyle);

        // Enhanced parallax effect for floating elements
        document.addEventListener('mousemove', function(e) {
            const floatingElements = document.querySelectorAll('.float-element');
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;
            
            floatingElements.forEach((element, index) => {
                const speed = (index + 1) * 0.3;
                const moveX = x * speed * 20;
                const moveY = y * speed * 20;
                const rotate = (x + y) * speed * 10;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px) rotate(${rotate}deg)`;
            });
        });
        
        // Track 404 error for analytics (optional)
        console.log('404 Error tracked:', {
            url: window.location.href,
            referrer: document.referrer,
            timestamp: new Date().toISOString()
        });
        
        // Page load animation
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.animation = 'fadeInPage 0.8s ease-out forwards';
        });
    </script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

<style>
/* Color Variables */
:root {
    --mint-primary: #00c9a7;
    --mint-secondary: #00bcd4;
    --mint-dark: #00a693;
    --mint-light: #4dd0e1;
    --mint-blue: #0891b2;
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --text-primary: #2d3748;
    --text-secondary: #4a5568;
    --text-muted: #718096;
}

/* Global Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Animated Background */
.animated-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: -1;
}

.animated-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.bg-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    animation: float 6s ease-in-out infinite;
    transition: transform 0.3s ease;
}

.shape-1 {
    width: 200px;
    height: 200px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    top: 30%;
    right: 30%;
    animation-delay: 4s;
}

.shape-4 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 30%;
    animation-delay: 1s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-20px) rotate(5deg);
    }
    50% {
        transform: translateY(-40px) rotate(0deg);
    }
    75% {
        transform: translateY(-20px) rotate(-5deg);
    }
}

/* Glassmorphism Header */
.glass-header {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.header-nav {
    padding: 1rem 0;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.brand-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    font-weight: 700;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.brand-logo:hover {
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
}

.logo-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-blue));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    box-shadow: 0 8px 16px rgba(0, 201, 167, 0.3);
    transition: all 0.3s ease;
}

.brand-logo:hover .logo-icon {
    transform: rotateY(180deg);
    box-shadow: 0 12px 24px rgba(0, 201, 167, 0.4);
}

.logo-icon i {
    font-size: 1.5rem;
    color: white;
}

.brand-text {
    background: linear-gradient(45deg, #fff, #f0f9ff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1.25rem;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.user-avatar {
    width: 35px;
    height: 35px;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.user-name {
    color: white;
    font-weight: 500;
    font-size: 0.95rem;
}

/* Main Content & Error Container */
.error-main {
    min-height: calc(100vh - 160px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    position: relative;
}

.error-container {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
    width: 100%;
    min-height: inherit;
}

.error-content {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 4rem 3rem;
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.2);
    position: relative;
    max-width: 600px;
    width: 100%;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.error-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--mint-primary), var(--mint-blue));
}

/* 404 Number Animation */
.error-number {
    font-size: 8rem;
    font-weight: 900;
    margin-bottom: 2rem;
    position: relative;
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.error-number span {
    display: inline-block;
    animation: bounce 2s infinite;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-light));
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 10px 20px rgba(0, 201, 167, 0.3));
}

.error-number .four:nth-child(1) {
    animation-delay: 0s;
}

.error-number .zero {
    animation-delay: 0.2s;
    transform: rotate(10deg);
}

.error-number .four:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    40% {
        transform: translateY(-20px) rotate(-5deg);
    }
    60% {
        transform: translateY(-10px) rotate(5deg);
    }
}

/* Error Message */
.error-message {
    margin-bottom: 3rem;
}

.error-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, #ffffff, #f0f9ff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.error-description {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
    max-width: 480px;
    margin: 0 auto;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden;
}

.float-element {
    position: absolute;
    font-size: 2rem;
    opacity: 0.15;
    animation: float 6s ease-in-out infinite;
}

.graduation-cap {
    top: 20%;
    left: 15%;
    animation-delay: 0s;
    color: var(--mint-primary);
}

.book {
    top: 60%;
    right: 20%;
    animation-delay: 1s;
    color: var(--mint-blue);
}

.trophy {
    top: 40%;
    left: 10%;
    animation-delay: 2s;
    color: #ffd700;
}

.star {
    top: 25%;
    right: 15%;
    animation-delay: 3s;
    color: #ff6b6b;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    25% {
        transform: translateY(-20px) rotate(5deg);
    }
    50% {
        transform: translateY(-40px) rotate(0deg);
    }
    75% {
        transform: translateY(-20px) rotate(-5deg);
    }
}

/* Action Buttons */
.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
}

.btn {
    padding: 15px 30px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
    min-width: 160px;
    justify-content: center;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn:hover::before {
    left: 100%;
}

.btn-back {
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    color: white;
    text-decoration: none;
}

.btn-home {
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-blue));
    color: white;
    box-shadow: 0 4px 15px rgba(0, 201, 167, 0.4);
    border: 1px solid rgba(0, 201, 167, 0.3);
}

.btn-home:hover {
    background: linear-gradient(45deg, var(--mint-dark), #0671a6);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 201, 167, 0.5);
    color: white;
    text-decoration: none;
}

/* Help Section */
.error-help {
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.help-text {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 1rem;
    font-weight: 600;
}

.help-links {
    display: flex;
    gap: 2rem;
    justify-content: center;
    flex-wrap: wrap;
}

.help-link {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: rgba(0, 201, 167, 0.1);
    border: 1px solid rgba(0, 201, 167, 0.2);
}

.help-link:hover {
    background: rgba(0, 201, 167, 0.2);
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
    border-color: rgba(0, 201, 167, 0.4);
}

/* Animation for page load */
.error-content {
    animation: slideInUp 0.8s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Additional visual effects */
.error-content::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(from 0deg, transparent, rgba(0, 201, 167, 0.03), transparent);
    animation: rotate 20s linear infinite;
    pointer-events: none;
    z-index: -1;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Glassmorphism Footer */
.glass-footer {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: auto;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.footer-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 2rem;
}

.footer-left {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
}

.footer-logo i {
    width: 35px;
    height: 35px;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-blue));
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.footer-tagline {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    margin: 0;
    font-style: italic;
}

.footer-links {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.footer-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    padding: 0.75rem 1.25rem;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 500;
}

.footer-link:hover {
    color: white;
    background: rgba(0, 201, 167, 0.2);
    border-color: rgba(0, 201, 167, 0.3);
    transform: translateY(-2px);
    text-decoration: none;
    box-shadow: 0 8px 16px rgba(0, 201, 167, 0.2);
}

.footer-link i {
    font-size: 1rem;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
    background: var(--mint-primary);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--mint-dark);
}

/* Selection Styling */
::selection {
    background: rgba(0, 201, 167, 0.3);
    color: white;
}

::-moz-selection {
    background: rgba(0, 201, 167, 0.3);
    color: white;
}

/* Page Load Animation */
@keyframes fadeInPage {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-container {
        padding: 0 1.5rem;
    }
    
    .brand-text {
        font-size: 1.2rem;
    }
    
    .logo-icon {
        width: 40px;
        height: 40px;
        margin-right: 0.75rem;
    }
    
    .logo-icon i {
        font-size: 1.2rem;
    }
    
    .user-info {
        padding: 0.5rem 1rem;
    }
    
    .user-name {
        display: none;
    }
    
    .footer-container {
        padding: 1.5rem;
    }
    
    .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .footer-links {
        justify-content: center;
        gap: 1rem;
    }
    
    .footer-link {
        padding: 0.6rem 1rem;
        font-size: 0.85rem;
    }
    
    .error-main {
        min-height: calc(100vh - 140px);
        padding: 1rem;
    }
    
    .error-container {
        padding: 1rem;
    }
    
    .error-content {
        padding: 3rem 2rem;
        margin: 1rem 0;
    }
    
    .error-number {
        font-size: 6rem;
        gap: 0.5rem;
    }
    
    .error-title {
        font-size: 2rem;
    }
    
    .error-description {
        font-size: 1.1rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 280px;
    }
    
    .help-links {
        flex-direction: column;
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .nav-container {
        padding: 0 1rem;
    }
    
    .brand-logo {
        font-size: 1.1rem;
    }
    
    .logo-icon {
        width: 35px;
        height: 35px;
        margin-right: 0.5rem;
    }
    
    .logo-icon i {
        font-size: 1rem;
    }
    
    .footer-links {
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }
    
    .footer-link {
        justify-content: center;
        width: 100%;
        max-width: 250px;
        margin: 0 auto;
    }
    
    .shape {
        display: none;
    }
    
    .error-content {
        padding: 2rem 1.5rem;
    }
    
    .error-number {
        font-size: 4rem;
    }
    
    .error-title {
        font-size: 1.8rem;
    }
    
    .error-description {
        font-size: 1rem;
    }
    
    .float-element {
        font-size: 1.5rem;
        opacity: 0.1;
    }
}
</style>