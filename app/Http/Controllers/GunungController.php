<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GunungController extends Controller
{
    public function index(){
        return view('admin.super.gunung.gunung', [
            'title' => 'Master Gunung',
            'active' => 'gunung',
            'rute' =>  DB::table('rute')->get(),
            'gunung' =>  DB::table('gunung')->join('rute', 'gunung.rute_id', '=', 'rute.id')->select('gunung.*', 'rute.*')->get()
        ]);
    }

    public function add(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
        ];
        $this->validate($request,[
                'name' => 'required|min:5|max:20',
                'kuota' => 'required',
                'rute' => 'required'
        ],$messages);
            $data = [
                'name'=>$request['name'],
                'kuota'=>$request['kuota'],
                'rute_id'=>$request['rute']
            ];
            DB::table('gunung')->insert($data);
            return redirect('/admin/gunung')->with('success', 'Berhasil tambah gunung!');
    }

    public function edit($id){
        return view('admin.super.gunung.edit_gunung', [
            'title' => 'Edit Gunung',
            'active' => 'gunung',
            'rute' =>  DB::table('rute')->get(),
            'gunung' =>  DB::table('gunung')->join('rute', 'gunung.rute_id', '=', 'rute.id')->select('gunung.*', 'rute.*')->where('gunung.rute_id', $id)->get()
        ]);
    }

    public function update(Request $request,$id){
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
        ];
        $this->validate($request,[
                'name' => 'required|min:5|max:20',
                'kuota' => 'required',
                'rute' => 'required'
        ],$messages);
            $data = [
                'name'=>$request['name'],
                'kuota'=>$request['kuota'],
                'rute_id'=>$request['rute']
            ];
        DB::table('gunung')->where('rute_id', $id)->update($data);
        return redirect('/admin/gunung')->with('success', 'Berhasil ubah gunung!');
    }

    public function delete($id){
        DB::table('gunung')->where('rute_id', '=', $id)->delete();
        return redirect('/admin/gunung')->with('success', 'Berhasil hapus gunung!');
    }

    public function home(){
        return view('admin.gunung.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard'  
        ]);
    }
}
