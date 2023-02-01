<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostCo extends Controller
{
    public function index(){
        return view('info gunung',[
            "title"=>"Info | Suka Gunung",
            "post"=> DB::table('table_info')->join('users', 'table_info.user_id', '=', 'users.id')->select('table_info.*', 'users.name')->get()
        ]);
    }

    public function show($id){
        return view('detail_info',[
            "title"=>"Detail Info | Suka Gunung",
            "post"=>DB::table('table_info')->join('users', 'table_info.user_id', '=', 'users.id')->select('table_info.*', 'users.*')->where('table_info.id',$id)->get()
    ]);
    
    }

}
