<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

  // لو سجل دخول بشكل صحيح
  // مشان ياخدو عالداشبورد المناسبة

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next)
    {
        if (auth('web')->check()) {  // guard: web -> user
            return redirect(RouteServiceProvider::HOME);
        }

        if (auth('student')->check()) { // guard: student -> students
            return redirect(RouteServiceProvider::STUDENT);
        }

        if (auth('teacher')->check()) {
            return redirect(RouteServiceProvider::TEACHER);
        }

        if (auth('parent')->check()) {
            return redirect(RouteServiceProvider::PARENT);
        }

        return $next($request);
    }
}
