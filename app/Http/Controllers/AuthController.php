<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function login() {

      if(!empty(Auth::check())){
            return redirect('dashboard');
      }
      return view('auth.login');
}

public function AuthLogin(Request $request)
{
    $user = User::where('email', $request->email)->first();

    // ❌ لو الإيميل مش موجود
    if (!$user) {
        return back()
            ->with('error', 'Invalid email or password')
            ->withInput($request->only('email'));
    }

    // 🚫 لو الحساب disabled
    if ($user->status == 2) {
        return back()
            ->with('error', 'Your account is disabled, contact admin')
            ->withInput($request->only('email'));
    }

    // ❌ لو الباسورد غلط
    if (!Hash::check($request->password, $user->password)) {
        return back()
            ->with('error', 'Invalid email or password')
            ->withInput($request->only('email'));
    }

    // ✅ تسجيل دخول
    Auth::login($user);

    return redirect('dashboard');
}

public function logout(){
      Auth::logout();
      return redirect(url(''));
}

}
