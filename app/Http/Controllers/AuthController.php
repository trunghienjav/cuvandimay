<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        try {
            $user = User::query()
                ->where('email', $request->get('email'))
                ->where('password', $request->get('password'))
                ->firstOrFail(); //bắn về exception nếu không tìm thấy thèn lào

                session()->put('id', $user->id); //dùng put thay vì push thì put nó sẽ ghi đè lên nếu trong ss đã có sẵn giá trị
                session()->put('name', $user->name);
                session()->put('level', $user->level);
                session()->put('avatar', $user->avatar);

                return redirect()->route('course.index');
        } catch (\Throwable $e) {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
