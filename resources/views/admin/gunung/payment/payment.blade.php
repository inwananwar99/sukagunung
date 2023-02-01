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
        <table class="table table-responsive" id="myTable">
            <thead>
              <tr>
                <th>
                  No.
                </th>
                <th> Nama </th>
                <th> Status</th>
                <th> Jumlah Pengunjung</th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;?>
              @foreach ($payment as $item)
              <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $item->nama }}</td>
                  @if ($item->updated_at !== NULL)
                    <td>Lunas</td>
                    @else
                    <td>Menunggu Validasi</td>
                  @endif
                  <td>{{$item->jumlah}}</td>
                  @if ($item->updated_at !== NULL)
                  <td><a class="btn badge badge-success">Sudah Validasi</a>
                    @else
                    <td><a href="{{url('/admin/validate/payment/'.$item->booking_id)}}" class="btn badge badge-primary">Validasi</a></td>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection
