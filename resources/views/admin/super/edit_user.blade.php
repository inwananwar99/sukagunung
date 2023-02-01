
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
    @foreach ($user as $item)
        
    <form method="POST" action="{{url('admin/users/update/'.$item->id)}}" class="form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="name" value="{{$item->name}}" placeholder="Nama" class="form-control">
            <span class="text-danger">{{ $errors->first('name')}}</span>
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" value="{{$item->username}}" placeholder="Username" class="form-control">
            <span class="text-danger">{{ $errors->first('username')}}</span>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" value="{{$item->email}}" placeholder="Email" class="form-control">
            <span class="text-danger">{{ $errors->first('email')}}</span>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" value="{{$item->password}}" placeholder="Password" class="form-control">
            <span class="text-danger">{{ $errors->first('password')}}</span>
            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select name="role" class="form-control">
                    @if ($item->role == 2)
                        <option value="2">-- Admin --</option>
                        @else
                        <option value="3">-- Pengunjung --</option>
                    @endif
                    <option value="2">Admin</option>
                    <option value="3">Pengunjung</option>
                </select>
            </div>
            <button class="btn btn-primary">Simpan</button>

        </form>
        @endforeach
    @endsection