
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
<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#myModal">+ Tambah Gunung</button>
  
  <!-- Add Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Gunung</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('add_gunung')}}" class="form">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" placeholder="Nama" class="form-control">
                <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
            <div class="form-group">
                <label for="">Kuota Pengunjung</label>
                <input type="number" name="kuota" placeholder="Jumlah Kuota" class="form-control">
                <span class="text-danger">{{ $errors->first('kuota')}}</span>
            </div>
            <div class="form-group">
                <label for="">Rute</label>
                <select name="rute" class="form-control">
                  <option value="">-- Pilihan Rute --</option>
                @foreach ($rute as $item)
                  <option value="{{$item->id}}">{{$item->name_rute}}</option>
                @endforeach

              </select>
                <span class="text-danger">{{ $errors->first('rute')}}</span>
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
                              <th> Rute </th>
                              <th> Kuota Pengunjung </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;?>
                            @foreach ($gunung as $gn)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $gn->name }}</td>
                                <td>{{ $gn->name_rute }}</td>
                                <td>{{ $gn->kuota }}</td>
                                <td>
                                    <a href="{{url('/admin/gunung/edit/'.$gn->rute_id.'')}}" class="btn badge badge-primary">Edit</a>
                                    <form action="{{url('/admin/gunung/delete/'.$gn->rute_id.'')}}" method="POST">
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