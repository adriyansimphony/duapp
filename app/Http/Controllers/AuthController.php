<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);

        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password])) {

            if(isset($nik['remember'])&&!empty($password['remember'])){
                setcookie("email",$nik['email'],time()+3600);
                setcookie("password",$password['password'],time()+3600);
                
            }else{
                setcookie("email","");
                setcookie("password","");
            }
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Nik / Password Salah']);
        }
    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {

            if(isset($email['remember'])&&!empty($password['remember'])){
                setcookie("email",$email['email'],time()+3600);
                setcookie("password",$password['password'],time()+3600);
                
            }else{
                setcookie("email","");
                setcookie("password","");
            }
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'Email atau Password Salah']);
        }
    }
}