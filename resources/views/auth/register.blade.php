@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="register-container">
    <!-- Background Elements -->
    <div class="background-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
        <div class="floating-shape shape-4"></div>
        <div class="floating-shape shape-5"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <!-- Register Card -->
                <div class="register-card">
                    <!-- Card Header -->
                    <div class="register-header">
                        <div class="register-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2 class="register-title">Buat Akun Baru</h2>
                        <p class="register-subtitle">Bergabunglah dengan kami untuk mengakses layanan beasiswa</p>
                    </div>

                    <!-- Card Body -->
                    <div class="register-body">
                        <form method="POST" action="{{ route('register') }}" class="register-form">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i> Nama Lengkap
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           class="form-input @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama lengkap Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                </div>
                                @error('name')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" 
                                           class="form-input @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Masukkan email Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                </div>
                                @error('email')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           class="form-input @error('password') is-invalid @enderror" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="toggleIconPassword"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Confirmation Field -->
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock"></i> Konfirmasi Password
                                </label>
                                <div class="input-wrapper">
                                    <input type="password" 
                                           class="form-input" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           placeholder="Masukkan ulang password Anda"
                                           required>
                                    <div class="input-focus-border"></div>
                                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="toggleIconPasswordConfirmation"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="form-group">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="terms" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-label">
                                        Saya menyetujui <a href="#" class="terms-link">Syarat dan Ketentuan</a> yang berlaku
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-register">
                                <span class="btn-content">
                                    <i class="fas fa-user-plus"></i>
                                    Daftar Sekarang
                                </span>
                                <div class="btn-shine"></div>
                            </button>
                        </form>
                        
                        <!-- Divider -->
                        <div class="divider">
                            <span class="divider-text">atau</span>
                        </div>
                        
                        <!-- Login Link -->
                        <div class="login-link">
                            <p>Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="btn-login">
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
/* Color Variables */
:root {
    --mint-primary: #00c9a7;
    --mint-secondary: #00bcd4;
    --mint-dark: #00a693;
    --mint-light: #4dd0e1;
    --mint-blue: #0891b2;
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
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
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
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-blue));
    top: 5%;
    left: -5%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, var(--mint-secondary), var(--mint-light));
    top: 70%;
    right: -3%;
    animation-delay: 2s;
}

.shape-3 {
    width: 120px;
    height: 120px;
    background: linear-gradient(45deg, var(--mint-blue), var(--mint-primary));
    top: 15%;
    right: 15%;
    animation-delay: 4s;
}

.shape-4 {
    width: 90px;
    height: 90px;
    background: linear-gradient(45deg, var(--mint-light), var(--mint-secondary));
    bottom: 30%;
    left: 10%;
    animation-delay: 1s;
}

.shape-5 {
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, var(--mint-primary), var(--mint-light));
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
    background: var(--white);
    border-radius: 24px;
    box-shadow: 0 20px 60px var(--shadow-medium);
    overflow: hidden;
    position: relative;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
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
    background: linear-gradient(90deg, var(--mint-primary), var(--mint-blue), var(--mint-secondary));
    background-size: 200% 100%;
    animation: shimmer 3s ease infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Card Header */
.register-header {
    padding: 2.5rem 2.5rem 1.5rem;
    text-align: center;
    position: relative;
}

.register-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, var(--mint-primary), var(--mint-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--white);
    box-shadow: 0 10px 30px rgba(0, 201, 167, 0.3);
    animation: pulse 2s ease infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.register-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.register-subtitle {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.5;
}

/* Card Body */
.register-body {
    padding: 0 2.5rem 2.5rem;
}

/* Form Groups */
.form-group {
    margin-bottom: 1.25rem;
}

.form-label {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
}

.form-label i {
    color: var(--mint-primary);
    margin-right: 0.5rem;
}

/* Input Wrapper */
.input-wrapper {
    position: relative;
}

.form-input {
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 1rem;
    color: var(--text-primary);
    background: var(--bg-light);
    border: 2px solid transparent;
    border-radius: 12px;
    transition: all 0.3s ease;
    outline: none;
}

.form-input:focus {
    background: var(--white);
    border-color: var(--mint-primary);
    box-shadow: 0 0 0 4px rgba(0, 201, 167, 0.1);
    transform: translateY(-2px);
}

.form-input::placeholder {
    color: #adb5bd;
    font-size: 0.95rem;
}

.input-focus-border {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--mint-primary), var(--mint-blue));
    transition: all 0.3s ease;
    transform: translateX(-50%);
    border-radius: 2px;
}

.form-input:focus + .input-focus-border {
    width: 100%;
}

/* Password Toggle */
.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.password-toggle:hover {
    color: var(--mint-primary);
    background: rgba(0, 201, 167, 0.1);
}

/* Custom Checkbox */
.checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    cursor: pointer;
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.checkbox-wrapper input[type="checkbox"] {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #dee2e6;
    border-radius: 4px;
    margin-right: 0.75rem;
    margin-top: 2px;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkbox-custom {
    background: var(--mint-primary);
    border-color: var(--mint-primary);
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

.checkbox-label {
    user-select: none;
    flex: 1;
}

.terms-link {
    color: var(--mint-primary);
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    color: var(--mint-dark);
    text-decoration: underline;
}

/* Register Button */
.btn-register {
    width: 100%;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, var(--mint-primary), var(--mint-blue));
    color: var(--white);
    border: none;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 201, 167, 0.4);
}

.btn-register:hover {
    background: linear-gradient(135deg, var(--mint-dark), #0671a6);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 201, 167, 0.5);
}

.btn-register:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(0, 201, 167, 0.4);
}

.btn-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
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
.divider {
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #dee2e6;
}

.divider-text {
    background: var(--white);
    padding: 0 1rem;
    color: var(--text-secondary);
    font-size: 0.9rem;
    position: relative;
    z-index: 1;
}

/* Login Link */
.login-link {
    text-align: center;
}

.login-link p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.btn-login {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: transparent;
    color: var(--mint-primary);
    border: 2px solid var(--mint-primary);
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background: var(--mint-primary);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 201, 167, 0.3);
}

/* Error Messages */
.error-message {
    color: var(--danger-color);
    font-size: 0.85rem;
    margin-top: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: #fff5f5;
    border: 1px solid #fed7d7;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-input.is-invalid {
    border-color: var(--danger-color);
    background: #fff5f5;
}

/* Register Footer */
.register-footer {
    text-align: center;
    margin-top: 2rem;
    color: var(--text-secondary);
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .register-header {
        padding: 2rem 1.5rem 1rem;
    }
    
    .register-body {
        padding: 0 1.5rem 2rem;
    }
    
    .register-title {
        font-size: 1.625rem;
    }
    
    .register-icon {
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
    
    .register-card {
        border-radius: 16px;
    }
    
    .register-header {
        padding: 1.5rem 1rem 1rem;
    }
    
    .register-body {
        padding: 0 1rem 1.5rem;
    }
    
    .btn-register {
        padding: 0.875rem 1.5rem;
        font-size: 1rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
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
    box-shadow: 0 0 0 4px rgba(0, 201, 167, 0.2);
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