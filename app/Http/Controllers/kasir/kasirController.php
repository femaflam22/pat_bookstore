<?php

namespace App\Http\Controllers\kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class kasirController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'username'=> 'required|exists:users,username|max:15|min:8',
            'password'=> 'required|min:8|max:15',
            'akses' => 'required'
        ],[
            'username.exists'=>"This username doesn't exists"
        ]);

        $users = $request->only('username','password','akses');
        if($request->akses === 'Kasir'){
            if (Auth::guard('web')->attempt($users)) {
                return redirect()->route('kasir.home');
            } else {
                return redirect()->route('kasir.login')->with('fail', "Gagal login, periksa dan coba lagi!");
            }
        }else{
            return redirect()->route('kasir.login')->with('fail', "Gagal, pastikan datamu benar dan kamu bagian kasir!");
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'password'=>'required|min:8|max:15|confirmed',
        ]);

        $currentPassword = auth::user()->password;
        $old_password = $request->old_password;
        if(Hash::check($old_password, $currentPassword)){
            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        }else{
            return redirect()->back()->with('fail', 'Gagal mengubah password, periksa dan coba lagi!');
        }
    }
}
