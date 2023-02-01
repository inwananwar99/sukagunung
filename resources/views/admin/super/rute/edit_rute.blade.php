
    @extends('admin.main')

    @section('container')
        <div class="table-responsive" style="margin-top: 100px">
                        <!-- Button to Open the Modal -->
        @if (session('status'))
           <div class="alert alert-danger">
                {{ session('status') }}
            </div>
            @elseif(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    @foreach ($rute as $item)
        
    <form method="POST" action="{{url('admin/rute/update/'.$item->id)}}" class="form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="name" value="{{$item->name_rute}}" placeholder="Nama" class="form-control">
            <span class="text-danger">{{ $errors->first('name')}}</span>
        </div>
        <div class="form-group">
            <label for="">Jumlah Pos</label>
            <input type="number" name="pos" value="{{$item->jumlah_pos}}" placeholder="Jumlah Pos" class="form-control">
            <span class="text-danger">{{ $errors->first('pos')}}</span>
        </div>
        <div class="form-group">
            <label for="">Harga Tiket</label>
            <input type="number" name="tiket" value="{{$item->tiket_masuk}}" placeholder="Harga Tiket" class="form-control">
            <span class="text-danger">{{ $errors->first('tiket')}}</span>
        </div>
            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>
        @endforeach
    @endsection