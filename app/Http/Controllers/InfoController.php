<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InfoController extends Controller
{
    public function index(){
        return view('admin.gunung.info.info',[
            'title'=>'Info | Suka Gunung',
            'info'=> DB::table('table_info')->where('user_id',session('user_id'))->get()
        ]);
    }

    public function add_info(Request $request){
        if (!empty($request->gambar)){
            $file =$request->file('gambar');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('img/info/'), $filename);
            $messages = [
                'required' => ':attribute wajib diisi!!!',
                'min' => ':attribute harus diisi minimal :min karakter ya!!!',
                'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
            ];
            $this->validate($request,[
                    'judul' => 'required|min:5|max:20',
                    'isi' => 'required',
            ],$messages);
            $data = [
                'judul' => $request['judul'],
                'isi' => $request['isi'],
                'user_id' => session('user_id'),
                'created_at' => now('Asia/Jakarta')->toDateTimeString(),
                'gambar'=>'/img/info/'.$filename
            ];
            DB::table('table_info')->insert($data);
        }else{
            $messages = [
                'required' => ':attribute harus diupload!!!'
            ];
            $this->validate($request,[
                'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ],$messages);
        }
        return redirect('/admin/info/gunung')->with('success', 'Berhasil tambah info!');
    }

    public function edit_info($id){
        return view('admin.gunung.info.edit_info',[
            'title'=>'Info | Suka Gunung',
            'info'=> DB::table('table_info')->where('id',$id)->get()
        ]);
    }

    public function update_info(Request $request, $id){
        if (!empty($request->gambar)){
            $file =$request->file('gambar');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('img/info/'), $filename);
            $data = [
                'gambar'=>'/img/info/'.$filename,
                'user_id' => session('user_id'),
                'updated_at' => now('Asia/Jakarta')->toDateTimeString()
            ];
        }else{
            $messages = [
                'required' => ':attribute wajib diisi!!!',
                'min' => ':attribute harus diisi minimal :min karakter ya!!!',
                'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
            ];
            $this->validate($request,[
                    'judul' => 'required|min:5|max:20',
                    'isi' => 'required',
            ],$messages);
            $data = [
                'judul' => $request['judul'],
                'isi' => $request['isi'],
                'user_id' => session('user_id'),
                'updated_at' => now('Asia/Jakarta')->toDateTimeString()
            ];
        }
        DB::table('table_info')->where('id',$id)->update($data);
        return redirect('/admin/info/gunung')->with('success', 'Berhasil edit info!');
    }

    public function delete_info($id){
        DB::table('table_info')->where('id',$id)->delete();
        return redirect('/admin/info/gunung')->with('success', 'Berhasil hapus info!');
    }
}
