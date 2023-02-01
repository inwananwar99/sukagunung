
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
    @foreach ($gunung as $item)
        
    <form method="POST" action="{{url('admin/gunung/update/'.$item->rute_id)}}" class="form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="name" value="{{$item->name}}" placeholder="Nama" class="form-control">
            <span class="text-danger">{{ $errors->first('name')}}</span>
        </div>
        <div class="form-group">
            <label for="">Kuota Pengunjung</label>
            <input type="number" name="kuota" value="{{$item->kuota}}" placeholder="Jumlah Kuota" class="form-control">
            <span class="text-danger">{{ $errors->first('kuota')}}</span>
        </div>
        <div class="form-group">
            <label for="">Rute</label>
            <select name="rute" class="form-control">
              <option value="{{$item->rute_id}}">-- {{$item->name_rute}} --</option>
            @foreach ($rute as $rt)
              <option value="{{$rt->id}}">{{$rt->name_rute}}</option>
            @endforeach
          </select>
            <span class="text-danger">{{ $errors->first('rute')}}</span>
        </div>
            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>
        @endforeach
    @endsection