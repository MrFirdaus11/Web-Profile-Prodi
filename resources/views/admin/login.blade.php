<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SI UNPARI</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            overflow: hidden;
        }
        
        /* Animated Background */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }
        
        /* Floating Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: floatShape 15s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -50px;
            right: -50px;
            animation-delay: -5s;
        }
        
        .shape-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            right: 10%;
            animation-delay: -10s;
        }
        
        @keyframes floatShape {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, -20px) scale(1.05); }
        }
        
        /* Login Container */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        
        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            padding: 48px 40px;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Logo Section */
        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .logo-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
        }
        
        .logo-icon i {
            font-size: 2rem;
            color: #fff;
        }
        
        .login-logo h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .login-logo p {
            color: #64748b;
            font-size: 0.95rem;
        }
        
        /* Alert Messages */
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            transition: color 0.2s;
        }
        
        .input-wrapper input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 1rem;
            font-family: inherit;
            color: #1e293b;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        
        .input-wrapper input:focus {
            outline: none;
            border-color: #7c3aed;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
        }
        
        .input-wrapper input:focus + i,
        .input-wrapper:focus-within i {
            color: #7c3aed;
        }
        
        .input-wrapper input::placeholder {
            color: #94a3b8;
        }
        
        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: #7c3aed;
        }
        
        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(124, 58, 237, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Back Link */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 28px;
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .back-link:hover {
            color: #7c3aed;
        }
        
        /* Footer Text */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }
        
        .login-footer p {
            color: #94a3b8;
            font-size: 0.8rem;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 36px 28px;
            }
            
            .logo-icon {
                width: 64px;
                height: 64px;
            }
            
            .login-logo h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Logo Section -->
            <div class="login-logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1>SI UNPARI</h1>
                <p>Masuk ke Panel Admin</p>
            </div>
            
            <!-- Alert Messages -->
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            
            <!-- Login Form -->
            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               name="username" 
                               id="username" 
                               placeholder="Masukkan username"
                               value="{{ old('username') }}"
                               required 
                               autofocus>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               placeholder="Masukkan password"
                               required>
                        <i class="fas fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Masuk</span>
                </button>
            </form>
            
            <!-- Back Link -->
            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Website</span>
            </a>
            
            <!-- Footer -->
            <div class="login-footer">
                <p>&copy; {{ date('Y') }} Program Studi Sistem Informasi UNPARI</p>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
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
        }
    </script>
</body>
</html>
