
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
<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#myModal">+ Tambah Rute</button>
  
  <!-- Add Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Rute</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('add_rute')}}" class="form">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" placeholder="Nama" class="form-control">
                <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
            <div class="form-group">
                <label for="">Jumlah Pos</label>
                <input type="number" name="pos" placeholder="Jumlah Pos" class="form-control">
                <span class="text-danger">{{ $errors->first('jml_pos')}}</span>
            </div>
            <div class="form-group">
                <label for="">Tiket Masuk</label>
                <input type="number" name="tiket" placeholder="Harga Tiket" class="form-control">
                <span class="text-danger">{{ $errors->first('tiket')}}</span>
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
                        <table class="table">
                          <thead>
                            <tr>
                              <th>
                                No.
                              </th>
                              <th> Nama </th>
                              <th> Tiket Masuk </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;?>
                            @foreach ($rute as $rt)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $rt->name_rute }}</td>
                                <td>{{ $rt->tiket_masuk }}</td>
                                <td>
                                    <a href="{{url('/admin/rute/edit/'.$rt->id.'')}}" class="btn badge badge-primary">Edit</a>
                                    <form action="{{url('/admin/rute/delete/'.$rt->id.'')}}" method="POST">
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
@endsection