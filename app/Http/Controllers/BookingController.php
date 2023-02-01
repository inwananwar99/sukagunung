<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BookingController extends Controller
{
    public function index(){
        return view('user.booking',[
            'title'=>'Booking | Suka Gunung',
            'gunung' =>  DB::table('gunung')->join('rute', 'gunung.rute_id', '=', 'rute.id')
            ->select('gunung.*', 'rute.*')->get(),
            'booking' => DB::table('booking')->join('rute', 'booking.rute_id', '=', 'rute.id')->join('gunung', 'booking.gunung_id', '=', 'gunung.id')->where('status', 1)->where('user_id',session('user_id'))->select('booking.*','gunung.name','gunung.kuota','gunung.rute_id', 'rute.name_rute','rute.jumlah_pos','rute.tiket_masuk')->limit(1)->get(),
            'payment' => DB::table('payment')->join('booking', 'payment.booking_id', '=', 'booking.id')
            ->select('payment.*', 'booking.nama','booking.jumlah')->get(),
            'history' => DB::table('booking')->join('gunung', 'booking.gunung_id', '=', 'gunung.id')
            ->join('rute', 'booking.rute_id', '=', 'rute.id')->join('payment', 'booking.id', '=', 'payment.booking_id')->where('booking.updated_at','!=', NULL)
            ->select('gunung.*', 'rute.*', 'booking.*','payment.bukti_transfer')->get()
        ]);
    }

    public function create_booking(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi!!!',
            'min' => ':attribute harus diisi minimal :min karakter ya!!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya!!!'
        ];
        $this->validate($request,[
                'name' => 'required',
                'jumlah' => 'required',
                'gunung_id' => 'required',
                'rute_id' => 'required'
        ],$messages);
        //validasi booking
        $gunung = DB::table('gunung')->join('rute', 'gunung.rute_id', '=', 'rute.id')->select('gunung.*', 'rute.*')->get();
        foreach ($gunung as $item) {
            if($request['jumlah'] > $item->kuota){
                return redirect('/users/booking')->with('status', 'Gagal booking! Kuota Pengunjung Tidak Mencukupi');
            }else if($request['jumlah'] < $item->kuota || $request['jumlah'] == $item->kuota){
                $data = [
                    'nama' => $request['name'],
                    'user_id' => session('user_id'),
                    'jumlah' => $request['jumlah'],
                    'status' => true,
                    'gunung_id' => $request['gunung_id'],
                    'rute_id' => $request['rute_id'],
                    'created_at' => now('Asia/Jakarta')->toDateTimeString()
                ];
                DB::table('booking')->insert($data);
                return redirect('/users/booking')->with('success', 'Berhasil booking!');
            }
        }
    }

    public function cancel_booking(Request $request){
        DB::table('booking')->where('user_id', session('user_id'))->update(['status' => 0]);
        return redirect('/users/booking')->with('success', 'Berhasil cancel booking!');
    }

    public function payment(Request $request){
        if (!empty($request->bukti_transfer)) {
            $file =$request->file('bukti_transfer');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('img/'), $filename);
            $data = [
                'nama' => $request['nama'],
                'status' => $request['status'],
                'user_id' => $request['user_id'],
                'booking_id' => $request['booking_id'],
                'bukti_transfer'=>'/img/'.$filename,
                'created_at' => now('Asia/Jakarta')->toDateTimeString()
            ];
            $payment = DB::table('payment')->get();
            $gunung = DB::table('booking')->join('gunung', 'booking.gunung_id', '=', 'gunung.id')->select('booking.*','gunung.kuota')->get();
            foreach ($payment as $item) {
                if($item->booking_id == $request['booking_id']){
                    return redirect('/users/booking')->with('status', 'Tagihan Sudah Terbayar!');
                }else{
                    DB::table('payment')->insert($data);
                    DB::table('payment')->where('booking_id', $request['booking_id'])->update([
                        'updated_at' => now('Asia/Jakarta')->toDateTimeString()
                    ]);
                    DB::table('booking')->where('id', $request['booking_id'])->update([
                        'status' => 0,
                        'updated_at' => now('Asia/Jakarta')->toDateTimeString()
                    ]);
                    foreach ($gunung as $item1) {
                        DB::table('gunung')->where('rute_id', $item1->rute_id)->update([
                            'kuota' => $item1->kuota - $item1->jumlah
                        ]);
                    }
                    return redirect('/users/booking')->with('success', 'Berhasil konfirmasi pembayaran!');
                }
            }
        }else{
            $messages = [
                'required' => ':attribute harus diupload!!!'
            ];
            $this->validate($request,[
                'bukti_transfer' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ],$messages);
        }
    }

    public function booking(){
        return view('admin.gunung.booking.booking',[
            'title' => 'Booking',
            'active' => 'booking',
            'booking' =>  DB::table('booking')->join('gunung', 'booking.gunung_id', '=', 'gunung.id')->join('rute', 'booking.rute_id', '=', 'rute.id')->select('gunung.*', 'booking.*','rute.name_rute','rute.tiket_masuk')->get(),
            'payment' => DB::table('payment')->join('booking', 'payment.booking_id', '=', 'booking.id')
            ->select('payment.*', 'booking.nama','booking.jumlah')->get()
        ]);
    }

    public function pay(){
        return view('admin.gunung.payment.payment',[
            'title' => 'Payment',
            'active' => 'payment',
            'payment' => DB::table('payment')->join('booking', 'payment.booking_id', '=', 'booking.id')
            ->select('payment.*', 'booking.nama','booking.jumlah')->get()
        ]);
    }

    public function validate_pay($id){
        DB::table('payment')->where('booking_id', $id)->update([
            'updated_at' => now('Asia/Jakarta')->toDateTimeString()
        ]);
        return redirect('/admin/payment')->with('success', 'Berhasil validasi pembayaran!');
    }




}
