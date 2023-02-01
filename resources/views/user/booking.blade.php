@extends('layouts.main')

@section('container')

  <h1>Booking</h1>
  @if (session('status'))
    <div class="alert alert-danger">
      {{ session('status') }}
    </div>
    @elseif (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <div class="row">
    
    <div class="col-md-4">
      <button class="btn btn-info mb-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Status Booking
      </button>
      <form method="POST" action="{{route('create_booking')}}">
        @csrf
        {!! csrf_field() !!}
        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-bottom" value="{!!old('name')!!}" id="name" placeholder="Name">
          <label for="name">Nama</label>
          <span class="text-danger">{{ $errors->first('name')}}</span>
        </div>
        <div class="form-floating mt-3">
          <input type="number" name="jumlah" class="form-control" id="jumlah" value="{!!old('jumlah')!!}" placeholder="Jumlah Pengunjung">
          <label for="username">Jumlah Pengunjung</label>
          <span class="text-danger">{{ $errors->first('jumlah')}}</span>
        </div>
        <div class="form-floating mt-3">
          <select name="gunung_id" id="gunung" class="form-control">
            <option value="">-- Pilih Gunung --</option>
            @foreach ($gunung as $item)
            <option value="{{$item->id}}">{{$item->name}} via {{$item->name_rute}}</option>
            @endforeach
          </select>
          <label for="">Gunung</label>
          <span class="text-danger">{{ $errors->first('gunung_id')}}</span>
        </div>
        <div class="form-floating mt-3 mb-3">
          <select name="rute_id" class="form-control">
            <option value="">-- Pilih Rute --</option>
            @foreach ($gunung as $item)
            <option value="{{$item->rute_id}}">{{$item->name_rute}}</option>
            @endforeach
          </select>
          <label for="password">Rute</label>
          <span class="text-danger">{{ $errors->first('rute_id')}}</span>
        </div>
        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Booking</button>
        </form>
    </div>
    <div class="col-md-8">
      <h5>History Pembayaran</h5>
      <table class="table table-responsive" id="myTable">
        <thead>
          <tr>
            <th>
              No.
            </th>
            <th> Rute </th>
            <th> Tiket Masuk </th>
            <th> Action </th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;?>
          @foreach ($history as $item)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$item->name}} via {{$item->name_rute}}</td>
              <td>@currency($item->jumlah * $item->tiket_masuk)</td>
              <td>
                <a href="" class="btn btn-info badge badge-info" data-bs-toggle="modal" data-bs-target="#historyModal{{$item->id}}">Detail</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            @foreach ($booking as $item)
              @if ($item->status === 0)
              <label for=""><b>Belum ada booking!</b></label>
                @else
                  <label for=""><b>Nama</b></label>
                  <p>{{$item->nama}}</p><br>
                  <label for=""><b>Jumlah Pengunjung</b></label>
                  <p>{{$item->jumlah}}</p><br>
                  <label for=""><b>Rute</b></label>
                  <p>{{$item->name}} via {{$item->name_rute}}</p><br>
                  <label for=""><b>Biaya</b></label>
                  <p>@currency($item->jumlah * $item->tiket_masuk)</p>
                  <label for=""><b>Status</b></label>
                @if ($item->status == 1)
                      <p>Menunggu Konfirmasi</p>
                @endif
            @endif
        @endforeach
          </div>
          <div class="col-md-6">
            @foreach ($booking as $item1)
            <label for=""><b>Upload Bukti Transfer</b></label>
              <form action="{{url('/users/payment/booking')}}" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="mb-3">
                      <input type="hidden" name="nama" value="{{$item1->nama}}">
                      <input type="hidden" name="status" value="1">
                      <input type="hidden" name="user_id" value="{{session('user_id')}}">
                      <input type="hidden" name="booking_id" value="{{$item1->id}}">
                      <label for="formFile" class="form-label">Bukti Transfer</label>
                      <input class="form-control" type="file" name="bukti_transfer" id="formFile" onchange="preview()">
              <span class="text-danger">{{ $errors->first('bukti_transfer')}}</span>
                      <button onclick="clearImage()" class="btn btn-warning mt-3">Hapus</button>
                    </div>
                    <img id="frame" src="" class="img-fluid" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                  <a href="/users/cancel/booking" class="btn btn-danger">Batalkan</a>
                  <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                </form>
          @endforeach
              </div>
    </div>
  </div>
</div>
    </div>
  </div>

@foreach ($history as $item1)
    <!-- History Modal -->
<div class="modal fade" id="historyModal{{$item1->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">History Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-6">
           <div class="row">
              <div class="col-md-8">
                <label for=""><b>Nama</b></label>
                <p>{{$item1->nama}}</p>
                <label for=""><b>Jumlah Pengunjung</b></label>
                <p>{{$item1->jumlah}}</p>
                <label for=""><b>Rute</b></label>
                <p>{{$item1->name}} via {{$item1->name_rute}}</p>
                <label for=""><b>Biaya</b></label>
                <p>@currency($item1->jumlah * $item1->tiket_masuk)</p>
                <label for=""><b>Status</b></label>
                @if ($item1->status == 0)
                      <p>Lunas</p>
                @endif
              </div>
              <div class="col-md-4">
                <label for=""><b>Bukti Transfer</b></label>
                <img id="frame" src="{{ asset($item1->bukti_transfer) }}" class="img-fluid" />
              </div>

           </div>
        </div>
    </div>
    </div>
  </div>
</div>
@endforeach
@endsection
      
      
