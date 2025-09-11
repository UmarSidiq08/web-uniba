@extends('layouts.app')

@section('title', 'Register')

@section('content')
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary-orange': '#FF9500',
                    'secondary-orange': '#FFA500',
                    'primary-yellow': '#FFD700',
                    'secondary-yellow': '#FFC107',
                    'light-yellow': '#FFF59D',
                    'pale-yellow': '#FFFDE7',
                    'dark-orange': '#E67E00',
                    'accent-orange': '#FF8C00',
                }
            }
        }
    }
</script>

<div class="register-container min-h-screen relative overflow-hidden">
    <!-- Background Elements -->
    <div class="background-elements absolute inset-0 pointer-events-none overflow-hidden">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <div class="floating-shape shape-4"></div>
        <div class="floating-shape shape-5"></div>
    </div>

    <div class="container mx-auto px-4">
        <div class="row justify-content-center align-items-center min-vh-100 flex items-center justify-center min-h-screen">
            <div class="col-md-6 col-lg-5 w-full max-w-md">
                <!-- Register Card -->
                <div class="register-card bg-white rounded-3xl shadow-2xl overflow-hidden relative backdrop-blur-lg border border-white/20">
                    <!-- Card Header -->
                    <div class="register-header p-10 pb-6 text-center relative">
                        <div class="register-icon w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-primary-orange to-secondary-yellow rounded-full flex items-center justify-center text-3xl text-white shadow-lg">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="register-title text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
                        <p class="register-subtitle text-gray-600 text-sm">Bergabunglah dengan kami untuk mengakses layanan beasiswa</p>
                    </div>

                    <!-- Card Body -->
                    <div class="register-body px-10 pb-10">
                        <form method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="form-group mb-5">
                                <label for="name" class="form-label block font-semibold text-sm text-gray-700 mb-2">
                                    <i class="fas fa-user text-primary-orange mr-2"></i> Nama Lengkap
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="text" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-700 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                </div>
                                @error('name')
                                    <div class="error-message text-red-500 text-xs mt-2 p-2 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group mb-5">
                                <label for="email" class="form-label block font-semibold text-sm text-gray-700 mb-2">
                                    <i class="fas fa-envelope text-primary-orange mr-2"></i> Email
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="email" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-700 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Masukkan email Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                </div>
                                @error('email')
                                    <div class="error-message text-red-500 text-xs mt-2 p-2 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-5">
                                <label for="password" class="form-label block font-semibold text-sm text-gray-700 mb-2">
                                    <i class="fas fa-lock text-primary-orange mr-2"></i> Password
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="password" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-700 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 bg-transparent border-0 text-gray-500 cursor-pointer p-2 rounded-full transition-all duration-300 hover:text-primary-orange hover:bg-orange-50" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="toggleIconPassword"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="error-message text-red-500 text-xs mt-2 p-2 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="form-group mb-5">
                                <label for="password_confirmation" class="form-label block font-semibold text-sm text-gray-700 mb-2">
                                    <i class="fas fa-lock text-primary-orange mr-2"></i> Konfirmasi Password
                                </label>
                                <div class="input-wrapper relative">
                                    <input type="password" 
                                           class="form-input w-full px-5 py-4 text-base text-gray-700 bg-gray-50 border-2 border-transparent rounded-xl transition-all duration-300 outline-none" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Masukkan ulang password Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                    <button type="button" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 bg-transparent border-0 text-gray-500 cursor-pointer p-2 rounded-full transition-all duration-300 hover:text-primary-orange hover:bg-orange-50" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="toggleIconPasswordConfirmation"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-group mb-5">
                                <label class="checkbox-wrapper flex items-start cursor-pointer text-sm text-gray-600 leading-relaxed">
                                    <input type="checkbox" name="terms" required class="hidden">
                                    <span class="checkbox-custom w-5 h-5 border-2 border-gray-300 rounded mr-3 mt-0.5 relative transition-all duration-300 flex-shrink-0"></span>
                                    <span class="checkbox-label select-none flex-1">
                                        Saya menyetujui <a href="#" class="terms-link text-primary-orange no-underline font-medium hover:text-dark-orange hover:underline">Syarat dan Ketentuan</a> yang berlaku
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-register w-full py-4 px-8 bg-gradient-to-r from-primary-orange to-secondary-yellow text-white border-0 rounded-xl text-lg font-semibold cursor-pointer transition-all duration-300 relative overflow-hidden mb-6 shadow-lg hover:shadow-xl hover:transform hover:-translate-y-0.5">
                                <span class="btn-content relative z-10 flex items-center justify-center gap-2">
                                    <i class="fas fa-user-plus"></i>
                                    Daftar Sekarang
                                </span>
                                <div class="btn-shine"></div>
                            </button>
                        </form>
                        
                        <!-- Divider -->
                        <div class="divider text-center my-6 relative">
                            <span class="divider-text bg-white px-4 text-gray-500 text-sm relative z-10">atau</span>
                        </div>
                        
                        <!-- Login Link -->
                        <div class="login-link text-center">
                            <p class="text-gray-600 mb-4 text-sm">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="btn-login inline-flex items-center gap-2 py-3 px-6 bg-transparent text-primary-orange border-2 border-primary-orange rounded-xl no-underline font-semibold text-base transition-all duration-300 hover:bg-primary-orange hover:text-white hover:transform hover:-translate-y-0.5 hover:shadow-lg">
                                <i class="fas fa-sign-in-alt"></i>
                                Login Sekarang
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
/* Color Variables - New Orange/Yellow Palette */
:root {
    --primary-orange: #FF9500;
    --secondary-orange: #FFA500;
    --primary-yellow: #FFD700;
    --secondary-yellow: #FFC107;
    --light-yellow: #FFF59D;
    --pale-yellow: #FFFDE7;
    --dark-orange: #E67E00;
    --accent-orange: #FF8C00;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --text-primary: #2c3e50;
    --text-secondary: #6c757d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --shadow-light: rgba(0, 0, 0, 0.05);
    --shadow-medium: rgba(0, 0, 0, 0.1);
    --shadow-heavy: rgba(0, 0, 0, 0.2);
}

/* Global Styles */
body {
    background: linear-gradient(135deg, #FFF59D 0%, #FFE082 50%, #FFCC80 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    line-height: 1.6;
}

.register-container {
    position: relative;
    min-height: 100vh;
    overflow: hidden;
}

/* Background Elements */
.background-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.15;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, var(--primary-orange), var(--primary-yellow));
    top: 5%;
    left: -5%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, var(--secondary-orange), var(--secondary-yellow));
    top: 70%;
    right: -3%;
    animation-delay: 2s;
}

.shape-3 {
    width: 120px;
    height: 120px;
    background: linear-gradient(45deg, var(--accent-orange), var(--primary-yellow));
    top: 15%;
    right: 15%;
    animation-delay: 4s;
}

.shape-4 {
    width: 90px;
    height: 90px;
    background: linear-gradient(45deg, var(--secondary-yellow), var(--light-yellow));
    bottom: 30%;
    left: 10%;
    animation-delay: 1s;
}

.shape-5 {
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, var(--primary-orange), var(--light-yellow));
    top: 40%;
    left: 5%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg); 
    }
    33% { 
        transform: translateY(-30px) rotate(120deg); 
    }
    66% { 
        transform: translateY(15px) rotate(240deg); 
    }
}

/* Register Card */
.register-card {
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

.register-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow), var(--secondary-orange));
    background-size: 200% 100%;
    animation: shimmer 3s ease infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Register Icon Animation */
.register-icon {
    animation: pulse 2s ease infinite;
    box-shadow: 0 10px 30px rgba(255, 149, 0, 0.3);
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Input Focus Border */
.input-focus-border {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-orange), var(--primary-yellow));
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
}

.form-input:focus {
    background: var(--white);
    border-color: var(--primary-orange);
    box-shadow: 0 0 0 4px rgba(255, 149, 0, 0.1);
    transform: translateY(-2px);
}

.form-input:focus + .input-focus-border {
    width: 100%;
}

/* Custom Checkbox */
.checkbox-wrapper input[type="checkbox"]:checked + .checkbox-custom {
    background: var(--primary-orange);
    border-color: var(--primary-orange);
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkbox-custom::after {
    content: '\f00c';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    color: white;
    font-size: 12px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Button Animations */
.btn-register {
    box-shadow: 0 4px 15px rgba(255, 149, 0, 0.4);
}

.btn-register:hover {
    background: linear-gradient(135deg, var(--dark-orange), var(--accent-orange));
    box-shadow: 0 8px 25px rgba(255, 149, 0, 0.5);
}

.btn-register:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(255, 149, 0, 0.4);
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn-register:hover .btn-shine {
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
    background: #dee2e6;
}

/* Login Button Hover */
.btn-login:hover {
    box-shadow: 0 4px 15px rgba(255, 149, 0, 0.3);
}

/* Error Messages */
.form-input.is-invalid {
    border-color: var(--danger-color);
    background: #fff5f5;
}

/* Loading State */
.btn-register.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-register.loading .btn-content::after {
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

/* Focus Styles for Accessibility */
.btn-register:focus,
.btn-login:focus,
.terms-link:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(255, 149, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .floating-shape {
        opacity: 0.05;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    window.togglePassword = function(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = fieldId === 'password' ? 
            document.getElementById('toggleIconPassword') : 
            document.getElementById('toggleIconPasswordConfirmation');
        
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
    const registerForm = document.querySelector('.register-form');
    const registerButton = document.querySelector('.btn-register');
    
    if (registerForm && registerButton) {
        registerForm.addEventListener('submit', function() {
            registerButton.classList.add('loading');
            registerButton.disabled = true;
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

    // Password strength indicator (optional)
    const passwordInput = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    if (passwordInput && passwordConfirmation) {
        // Real-time password confirmation validation
        const validatePasswordMatch = () => {
            if (passwordConfirmation.value && passwordInput.value !== passwordConfirmation.value) {
                passwordConfirmation.style.borderColor = 'var(--danger-color)';
            } else if (passwordConfirmation.value) {
                passwordConfirmation.style.borderColor = 'var(--success-color)';
            } else {
                passwordConfirmation.style.borderColor = 'transparent';
            }
        };
        
        passwordInput.addEventListener('input', validatePasswordMatch);
        passwordConfirmation.addEventListener('input', validatePasswordMatch);
    }

    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.btn-register, .btn-login');
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