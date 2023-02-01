<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function index(){
        return view('login.index', [
            'title' => 'login',
            'active' => 'login'  
        ]);
    }
    
    public function login(Request $request){
        $user = DB::table('users')->where('username',$request['username'])->first();
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!',
        ];
        $this->validate($request,[
                'username' => 'required|alpha|min:5|max:20',
                'password' => 'required',
        ],$messages);

        if($user !== NULL){
            if($user->username === $request['username'] && $user->password == $request['password']){
                //set session
                Session::put('role', $user->role);
                Session::put('name', $user->name);
                Session::put('user_id', $user->id);
                if($user->role == 1){
                    return redirect('home')->with('status', 'Berhasil login!');
                }else if($user->role == 2){
                    return redirect('/admin/mt')->with('status', 'Berhasil login!');
                }else{
                    return redirect('/users/home')->with('status', 'Berhasil login!');
                }
            }else{
                return redirect('login')->with('status', 'Username atau Password anda salah!');
            }
        }else{
            return redirect('login')->with('status', 'Username anda tidak terdaftar!');
        }
        
    }

    public function dashboard(){
        return view('admin.super.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard'  
        ]);
    }

    public function logout(){
        Session::flush();
        return redirect('login')->with('success', 'Berhasil logout!');
    }
}
