<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AutoLogout
{
    public function handle($request, Closure $next)
    {
        // Cek apakah user sedang login
        if (Auth::check()) {
            $timeout = 900; // 15 menit (dalam detik)

            $lastActivity = Session::get('lastActivityTime');
            if ($lastActivity && (time() - $lastActivity) > $timeout) {
                Auth::logout();
                Session::flush();
                return redirect('/login')->withErrors(['message' => 'Sesi Anda telah berakhir. Silakan login kembali.']);
            }

            // Perbarui waktu aktivitas terakhir
            Session::put('lastActivityTime', time());
        }

        return $next($request);
    }
}
