
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
<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#myModal">+ Tambah User</button>
  
  <!-- Add Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{route('add')}}" class="form">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="name" placeholder="Nama" class="form-control">
                <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control">
                <span class="text-danger">{{ $errors->first('username')}}</span>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control">
                <span class="text-danger">{{ $errors->first('email')}}</span>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">
                <span class="text-danger">{{ $errors->first('password')}}</span>
            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select name="role" class="form-control">
                    <option value="">-- Hak Akses --</option>
                    <option value="2">Admin</option>
                    <option value="3">Pengunjung</option>
                </select>
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
                              <th> Name </th>
                              <th> Email </th>
                              <th> Role </th>
                              <th> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1;?>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if($user->role == 2)
                                        <td>Admin Gunung</td>
                                    @else
                                        <td>Pengunjung</td>
                                @endif
                                <td>
                                    <a href="{{url('/admin/users/edit/'.$user->id.'')}}" class="btn badge badge-primary">Edit</a>
                                    <form action="{{url('/admin/users/delete/'.$user->id.'')}}" method="POST">
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