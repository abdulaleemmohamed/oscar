<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - نظام الموارد البشرية</title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(to bottom right, #004e92, #000428);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.08);
            padding: 40px 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(8px);
        }

        .login-box h1 {
            font-size: 32px;
            text-align: center;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-box p {
            text-align: center;
            font-size: 15px;
            margin-bottom: 25px;
            color: #eee;
        }

        .form-control {
            border-radius: 30px;
            padding-right: 45px;
        }

        .input-group-text {
            border-radius: 30px 0 0 30px;
            background: #007baf;
            color: white;
        }

        .btn-primary {
            border-radius: 30px;
            background-color: #007baf;
            border: none;
            font-weight: bold;
            padding: 10px;
        }

        .text-danger_login {
            color: #ffdddd;
            font-weight: 600;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .toggle-password {
            cursor: pointer;
            color: #fff;
        }

        .toast-container {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 9999;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h1>HR System</h1>
    <p>مرحبًا بك في نظام الموارد البشرية</p>

    {{-- إشعارات --}}
    <div class="toast-container">
        @if(session('error'))
            <div class="toast show bg-danger text-white" role="alert">
                <div class="toast-body">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="toast show bg-success text-white" role="alert">
                <div class="toast-body">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif
    </div>

    {{-- تنبيه التجميد --}}
    @if(session('lockout_time'))
        <div class="alert alert-warning text-center" id="lockout-alert">
            <strong>محاولات كثيرة خاطئة!</strong><br>
            يرجى الانتظار <span id="timer">{{ session('lockout_time') }}</span> ثانية قبل المحاولة مرة أخرى.
        </div>
    @endif

    <form action="{{ route('login.admin') }}" method="post" id="login-form">
        @csrf

        {{-- اسم المستخدم --}}
        <div class="input-group mb-2">
            <input type="text" name="username" class="form-control" placeholder="اسم المستخدم" value="{{ old('username') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        @error('username')
        <span class="text-danger_login"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
        @enderror

        {{-- كلمة المرور --}}
        <div class="input-group mb-2">
            <input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
            <div class="input-group-append">
                <div class="input-group-text toggle-password" id="togglePassword">
                    <span class="fas fa-eye"></span>
                </div>
            </div>
        </div>
        @error('password')
        <span class="text-danger_login"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>
        @enderror

        <button type="submit" class="btn btn-primary btn-block" id="login-button">تسجيل الدخول</button>
    </form>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // toggle password
    document.getElementById('togglePassword').addEventListener('click', function () {
        const password = document.getElementById('password');
        const icon = this.querySelector('span');
        if (password.type === "password") {
            password.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // مؤقت التجميد
    @if(session('lockout_time'))
    document.addEventListener('DOMContentLoaded', function () {
        let timeLeft = {{ session('lockout_time') }};
        const timerElement = document.getElementById('timer');
        const alertBox = document.getElementById('lockout-alert');
        const loginButton = document.getElementById('login-button');

        loginButton.disabled = true;
        loginButton.textContent = "يرجى الانتظار...";

        const interval = setInterval(() => {
            timeLeft--;
            if (timeLeft <= 0) {
                clearInterval(interval);
                alertBox.innerHTML = "انتهى التجميد، يمكنك المحاولة الآن.";
                loginButton.disabled = false;
                loginButton.textContent = "تسجيل الدخول";
            } else {
                timerElement.textContent = timeLeft;
            }
        }, 1000);
    });
    @endif
    $(function () {
        $('.toast').toast('show');
    });
</script>
</body>
</html>
