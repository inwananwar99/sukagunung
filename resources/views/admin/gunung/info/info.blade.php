@extends('admin.main')

    @section('container')
    <div class="container-fluid">
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
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#myModal">+ Tambah Info</button>
  
  <!-- Add Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Info</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('add_info')}}" class="form" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
                <span class="text-danger">{{ $errors->first('judul')}}</span>
            </div>
            <div class="form-group">
                <label for="">Isi</label>
                <textarea name="isi" class="form-control"></textarea>
                <span class="text-danger">{{ $errors->first('isi')}}</span>
            </div>
            <div class="form-group">
              <label for="">Gambar</label>
              <input type="file" name="gambar" class="form-control">
              <span class="text-danger">{{ $errors->first('gambar')}}</span>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
  
      </div>
    </div>
  </div>
        <table class="table table-responsive" id="myTable">
            <thead>
              <tr>
                <th>
                  No.
                </th>
                <th> Judul </th>
                <th> Tanggal Buat </th>
                <th>Terakhir Update</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;?>
              @foreach ($info as $item)
              <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $item->judul }}</td>
                  <td>{{ $item->created_at }}</td>
                  @if ($item->updated_at == NULL)
                    <td>Belum ada update</td>  
                  @else
                    <td>{{ $item->updated_at }}</td>
                  @endif
                  <td>
                  <a href="{{url('/admin/info/edit/'.$item->id.'')}}" class="btn badge badge-primary">Edit</a>
                  <form action="{{url('/admin/info/delete/'.$item->id.'')}}" method="POST">
                    @method('DELETE')
                    @csrf
                   <button type="submit" class="btn badge badge-danger mt-3">
                         Hapus
                   </button>
            </form>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
@endsection
