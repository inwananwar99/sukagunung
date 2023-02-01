<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RuteController extends Controller
{
    public function index(){
        return view('admin.super.rute.rute', [
            'title' => 'Master Rute',
            'active' => 'rute',
            'rute' =>  DB::table('rute')->get()
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
                'pos' => 'required',
                'tiket' => 'required|min:5|max:20'
        ],$messages);
            $data = [
                'name_rute'=>$request['name'],
                'jumlah_pos'=>$request['pos'],
                'tiket_masuk'=>$request['tiket']
            ];
            DB::table('rute')->insert($data);
            return redirect('/admin/rute')->with('success', 'Berhasil tambah rute!');
    }

    public function edit($id){
        return view('admin.super.rute.edit_rute', [
            'title' => 'Edit Rute',
            'active' => 'rute',
            'rute' =>  DB::table('rute')->where('id','=',$id)->get()
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
                'pos' => 'required',
                'tiket' => 'required|min:5|max:20'
        ],$messages);
        $data = [
            'name_rute' => $request['name'],
            'jumlah_pos' => $request['pos'],
            'tiket_masuk' => $request['tiket']
        ];
        DB::table('rute')->where('id', $id)->update($data);
        return redirect('/admin/rute')->with('success', 'Berhasil ubah rute!');
    }

    public function delete($id){
        DB::table('rute')->where('id', '=', $id)->delete();
        return redirect('/admin/rute')->with('success', 'Berhasil hapus rute!');
    }

}
