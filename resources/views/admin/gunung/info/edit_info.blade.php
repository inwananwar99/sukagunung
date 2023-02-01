
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
    @foreach ($info as $item)
      <form method="POST" action="{{url('/admin/info/update/'.$item->id)}}" class="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" name="judul" placeholder="Judul" class="form-control" value="{{$item->judul}}">
            <span class="text-danger">{{ $errors->first('judul')}}</span>
        </div>
        <div class="form-group">
            <label for="">Isi</label>
            <textarea name="isi" class="form-control">{{$item->isi}}</textarea>
            <span class="text-danger">{{ $errors->first('isi')}}</span>
        </div>
        <div class="form-group">
          <label for="">Gambar</label>
          <input type="file" name="gambar" class="form-control">
          <span class="text-danger">{{ $errors->first('gambar')}}</span>
          <img id="frame" src="{{ asset($item->gambar) }}" class="img-fluid" />
      </div>
        <div class="form-group" style="margin-bottom: 100px">
          <button class="btn btn-primary" type="submit">Simpan</button>
          <a href="/admin/info/gunung" class="btn btn-danger">Batal</a>
        </div>
        @endforeach
    @endsection