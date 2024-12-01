<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Debugging untuk memastikan role yang diterima
        // dd($role, Auth::user()->role); // Ini akan menampilkan role yang diterima dan role pengguna yang sedang login

        if (Auth::check()) {
            // Jika role pengguna tidak sesuai dengan yang diharapkan, arahkan ke halaman yang sesuai
            if ($role == 'admin' && Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard'); // Jika bukan admin, redirect ke dashboard
            }

            if ($role == 'user' && Auth::user()->role !== 'user') {
                return redirect()->route('admin.dashboard'); // Jika bukan user, redirect ke admin dashboard
            }
        }

        return $next($request); // Jika role sesuai, lanjutkan permintaan
    }
}
