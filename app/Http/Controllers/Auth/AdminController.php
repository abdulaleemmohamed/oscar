<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminloginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Log;

class AdminController extends Controller
{
    public function create()
    {
        return view('Dashboard.Admin.login');
    }

    public function store(AdminloginRequest $request)
    {
        // بناء المفتاح
        $throttleKey = Str::lower($request->username) . '|' . $request->ip();
        $maxAttempts = 5;
        $decaySeconds = 60; // وقت الحظر بالثواني

        $currentAttempts = RateLimiter::attempts($throttleKey);


// ✅ لو تجاوز الحد
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);


            session()->flash('lockout_time', $seconds);
            throw ValidationException::withMessages([
                'username' => "تم تعطيل المحاولة مؤقتًا. حاول مرة أخرى بعد {$seconds} ثانية.",
            ]);
        }

// ✅ محاولة تسجيل الدخول
        if (auth('admin')->attempt($request->only('username', 'password'))) {
            RateLimiter::clear($throttleKey);

            return redirect()->intended(RouteServiceProvider::ADMIN)->with('success', '🎉تم تسجيل الدخول بنجاح ');
        }

// ❌ فشل تسجيل الدخول → تسجيل محاولة
        RateLimiter::hit($throttleKey, $decaySeconds);


        return back()->withErrors([
            'username' => 'البيانات المدخلة غير صحيحة.',
            'password' => 'كلمة المرور غير صحيحة.',
        ])->withInput();        $newAttempts = RateLimiter::attempts($throttleKey);


    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login/admin');
    }
}
