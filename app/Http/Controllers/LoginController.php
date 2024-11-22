<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function view() {
        if (Auth::check()) {
            return view('index');
        } else {
            return view('login');
        }
    }

    public function logIn(LoginRequest $request) {
        $credentials = $request->only([
            'email',
            'password',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => __('auth.errorDataLogin'),
        ])->onlyInput('email');

    }

    public function logOut(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response([
            'url' => route('logOut')
        ], 301);
    }

}
