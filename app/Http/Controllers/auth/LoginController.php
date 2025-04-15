<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->flush(); // Menghapus semua session
    $request->session()->regenerateToken(); // Mencegah session fixasi

    return redirect('/login')->with('status', 'Anda berhasil logout.');
}
}
