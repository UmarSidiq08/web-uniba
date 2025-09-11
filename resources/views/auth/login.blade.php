@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-container relative min-h-screen overflow-hidden">
    <!-- Background Elements -->
    <div class="background-elements absolute inset-0 pointer-events-none overflow-hidden">
        <div class="floating-shape shape-1 absolute rounded-full opacity-10"></div>
        <div class="floating-shape shape-2 absolute rounded-full opacity-10"></div>
        <div class="floating-shape shape-3 absolute rounded-full opacity-10"></div>
        <div class="floating-shape shape-4 absolute rounded-full opacity-10"></div>
    </div>

    <div class="container mx-auto px-4">
        <div class="row flex justify-center items-center min-h-screen">
            <div class="col-md-5 col-lg-4 w-full md:w-5/12 lg:w-4/12">
                <!-- Login Card -->
                <div class="login-card bg-white rounded-3xl shadow-2xl overflow-hidden relative backdrop-blur-lg border border-white/20">
                    <!-- Card Header -->
                    <div class="login-header px-10 pt-12 pb-8 text-center relative">
                        <div class="login-icon w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center text-3xl text-white shadow-lg">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h2 class="login-title text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
                        <p class="login-subtitle text-base text-gray-600 m-0">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>

                    <!-- Card Body -->
                    <div class="login-body px-10 pb-10">
                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            
                            <!-- Email Field -->
                            <div class="form-group mb-6">
                                <label for="email" class="form-label block font-semibold text-sm text-gray-800 mb-2 tracking-wide">
                                    <i class="fas fa-envelope mr-2"></i> Email
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="email" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-800 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Masukkan email Anda"
                                           required>
                                    <div class="input-focus-border absolute bottom-0 left-1/2 w-0 h-0.5 rounded transition-all duration-300 transform -translate-x-1/2"></div>
                                </div>
                                @error('email')
                                    <div class="error-message text-red-600 text-sm mt-2 px-3 py-2 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-6">
                                <label for="password" class="form-label block font-semibold text-sm text-gray-800 mb-2 tracking-wide">
                                    <i class="fas fa-lock mr-2"></i> Password
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="password" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-800 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <div class="input-focus-border absolute bottom-0 left-1/2 w-0 h-0.5 rounded transition-all duration-300 transform -translate-x-1/2"></div>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 bg-transparent border-0 text-gray-600 cursor-pointer p-2 rounded-full transition-all duration-300" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="error-message text-red-600 text-sm mt-2 px-3 py-2 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login w-full px-8 py-4 text-white border-0 rounded-xl text-lg font-semibold cursor-pointer transition-all duration-300 relative overflow-hidden mb-6 shadow-lg">
                                <span class="btn-content relative z-10 flex items-center justify-center gap-2">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Masuk
                                </span>
                                <div class="btn-shine absolute top-0 -left-full w-full h-full transition-all duration-500"></div>
                            </button>
                        </form>
                        
                        <!-- Divider -->
                        <div class="divider text-center my-8 relative">
                            <span class="divider-text bg-white px-4 text-gray-600 text-sm relative z-10">atau</span>
                        </div>
                        
                        <!-- Register Link -->
                        <div class="register-link text-center">
                            <p class="text-gray-600 mb-4 text-base">Belum punya akun?</p>
                            <a href="{{ route('register') }}" class="btn-register inline-flex items-center gap-2 px-6 py-3 bg-transparent border-2 rounded-xl no-underline font-semibold text-base transition-all duration-300">
                                <i class="fas fa-user-plus"></i>
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS with New Color Palette -->
<style>
/* New Color Variables Based on Palette */
:root {
    --primary-orange: #FF9800;
    --dark-orange: #F57C00;
    --light-orange: #FFB74D;
    --primary-yellow: #FFD600;
    --dark-yellow: #FFC107;
    --light-yellow: #FFEB3B;
    --primary-cream: #F5E6CA;
    --dark-cream: #E8D5B7;
    --light-cream: #FFF8E1;
    --accent-gold: #FFA726;
    --text-primary: #5D4037;
    --text-secondary: #795548;
    --bg-light: #FFF9F5;
    --white: #ffffff;
    --shadow-light: rgba(255, 152, 0, 0.1);
    --shadow-medium: rgba(255, 152, 0, 0.2);
    --shadow-heavy: rgba(255, 152, 0, 0.3);
}

/* Global Styles */
body {
    background: linear-gradient(135deg, var(--light-cream) 0%, var(--primary-cream) 50%, var(--bg-light) 100%);
}

/* Background Elements with New Colors */
.shape-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, var(--primary-orange), var(--primary-yellow));
    top: 10%;
    left: -5%;
    animation: float 6s ease-in-out infinite;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, var(--dark-orange), var(--light-yellow));
    top: 60%;
    right: -3%;
    animation: float 6s ease-in-out infinite;
    animation-delay: 2s;
}

.shape-3 {
    width: 100px;
    height: 100px;
    background: linear-gradient(45deg, var(--primary-yellow), var(--accent-gold));
    top: 20%;
    right: 20%;
    animation: float 6s ease-in-out infinite;
    animation-delay: 4s;
}

.shape-4 {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, var(--light-orange), var(--dark-yellow));
    bottom: 20%;
    left: 15%;
    animation: float 6s ease-in-out infinite;
    animation-delay: 1s;
}

@keyframes float {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg); 
    }
    33% { 
        transform: translateY(-20px) rotate(120deg); 
    }
    66% { 
        transform: translateY(10px) rotate(240deg); 
    }
}

/* Login Card */
.login-card {
    animation: slideInUp 0.8s ease;
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

.login-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow), var(--dark-orange));
    background-size: 200% 100%;
    animation: shimmer 3s ease infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Login Icon with New Colors */
.login-icon {
    background: linear-gradient(135deg, var(--primary-orange), var(--dark-orange));
    box-shadow: 0 10px 30px var(--shadow-medium);
    animation: pulse 2s ease infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Form Label Icons */
.form-label i {
    color: var(--primary-orange);
}

/* Input Focus Effects with New Colors */
.form-input:focus {
    background: var(--white);
    border-color: var(--primary-orange);
    box-shadow: 0 0 0 4px var(--shadow-light);
    transform: translateY(-2px);
}

.input-focus-border {
    background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow));
}

.form-input:focus + .input-focus-border {
    width: 100%;
}

/* Password Toggle Hover */
.password-toggle:hover {
    color: var(--primary-orange);
    background: var(--shadow-light);
}

/* Login Button with New Colors */
.btn-login {
    background: linear-gradient(135deg, var(--primary-orange), var(--dark-orange));
    box-shadow: 0 4px 15px var(--shadow-medium);
}

.btn-login:hover {
    background: linear-gradient(135deg, var(--dark-orange), var(--accent-gold));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px var(--shadow-heavy);
}

.btn-login:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px var(--shadow-medium);
}

.btn-shine {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
}

.btn-login:hover .btn-shine {
    left: 100%;
}

/* Divider */
.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--primary-cream);
}

/* Register Button with New Colors */
.btn-register {
    color: var(--primary-orange);
    border-color: var(--primary-orange);
}

.btn-register:hover {
    background: var(--primary-orange);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px var(--shadow-medium);
}

/* Error Messages */
.form-input.is-invalid {
    border-color: #dc3545;
    background: #fff5f5;
}

/* Loading State */
.btn-login.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-login.loading .btn-content::after {
    content: '';
    width: 20px;
    height: 20px;
    margin-left: 10px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Focus Styles */
.btn-login:focus,
.btn-register:focus,
.forgot-password:focus {
    outline: none;
    box-shadow: 0 0 0 4px var(--shadow-light);
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-header {
        padding: 2rem 1.5rem 1.5rem;
    }
    
    .login-body {
        padding: 0 1.5rem 2rem;
    }
    
    .login-title {
        font-size: 1.75rem;
    }
    
    .login-icon {
        width: 70px;
        height: 70px;
        font-size: 1.75rem;
    }
    
    .floating-shape {
        opacity: 0.05;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 1rem;
    }
    
    .login-card {
        border-radius: 16px;
    }
    
    .login-header {
        padding: 1.5rem 1rem 1rem;
    }
    
    .login-body {
        padding: 0 1rem 1.5rem;
    }
    
    .btn-login {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    window.togglePassword = function() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    };

    // Form submission loading state
    const loginForm = document.querySelector('.login-form');
    const loginButton = document.querySelector('.btn-login');
    
    if (loginForm && loginButton) {
        loginForm.addEventListener('submit', function() {
            loginButton.classList.add('loading');
            loginButton.disabled = true;
        });
    }

    // Enhanced input focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Floating label effect (optional enhancement)
    inputs.forEach(input => {
        const handleInputChange = () => {
            if (input.value.trim() !== '') {
                input.parentElement.classList.add('has-value');
            } else {
                input.parentElement.classList.remove('has-value');
            }
        };
        
        input.addEventListener('input', handleInputChange);
        input.addEventListener('change', handleInputChange);
        
        // Check on page load
        handleInputChange();
    });

    // Add ripple effect to buttons (optional)
    const buttons = document.querySelectorAll('.btn-login, .btn-register');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
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
                pointer-events: none;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Add CSS for ripple animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection