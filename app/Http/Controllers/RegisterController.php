<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(){
    return view('register.index', [
                'title' => 'Register',
                'active' => 'register'
    ]);
   }

    public function register(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'nullable|email|unique:users,email'
        ]);
        if($validator->fails()){
            return redirect('register')->with('status', 'Email Sudah Terdaftar!');
        }else{
            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
                'username' => $input['username'],
                'password' => $input['password'],
                'remember_token' => $input['_token'],
                'role' => 3,
                'created_at' => now('Asia/Jakarta')->toDateTimeString()
            ];
            DB::table('users')->insert($data);
            return redirect('login')->with('success', 'Berhasil daftar! Silahkan login');
        }
    }

}
