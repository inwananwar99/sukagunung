<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class UserController extends Controller
{
    public function index(){
        return view('admin.super.users', [
            'title' => 'Master User',
            'active' => 'users',
            'users' =>  DB::table('users')->where('role','!=',session('role'))->get()
        ]);
    }

    public function add(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
        ];
        $this->validate($request,[
                'username' => 'required|alpha|min:5|max:20',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
        ],$messages);

            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'username' => $request['username'],
                'password' => $request['password'],
                'role' => $request['role'],
                'remember_token' => $request['_token'],
                'created_at' => now('Asia/Jakarta')->toDateTimeString()
            ];
            DB::table('users')->insert($data);
            return redirect('/admin/users')->with('success', 'Berhasil tambah user!');

    }

    public function edit($id){
        return view('admin.super.edit_user', [
            'title' => 'Edit User',
            'active' => 'users',
            'user' =>  DB::table('users')->where('id','=',$id)->get()
        ]);
    }

    public function update(Request $request,$id){
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
        ];
        $this->validate($request,[
                'username' => 'required|alpha|min:5|max:20',
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
        ],$messages);
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'password' => $request['password'],
            'role' => $request['role'],
            'remember_token' => $request['_token'],
            'updated_at' => now('Asia/Jakarta')->toDateTimeString()
        ];
        DB::table('users')->where('id', $id)->update($data);
        return redirect('/admin/users')->with('success', 'Berhasil ubah user!');
    }

    public function delete($id){
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect('/admin/users')->with('success', 'Berhasil hapus user!');
    }

    public function home(){
        return view('cover.index', [
            'title' => 'Beranda | Suka Gunung',
            'active' => 'users',
            "post"=> DB::table('table_info')->join('users', 'table_info.user_id', '=', 'users.id')->select('table_info.*', 'users.name')->get()
        ]);   
    }
}
