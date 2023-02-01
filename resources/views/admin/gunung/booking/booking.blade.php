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
                <th> Gunung </th>
                <th> Status</th>
                <th> Jumlah Pengunjung</th>
                <th> Biaya</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;?>
              @foreach ($booking as $item)
              <tr>
                  <td>{{ $no++}}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->name }} via {{$item->name_rute}}</td>
                  @if ($item->updated_at !== NULL)
                    <td>Berhasil Konfirmasi</td>
                    @else
                    <td>Dibatalkan</td>
                  @endif
                  <td>{{$item->jumlah}}</td>
                  <td>
                    @currency($item->jumlah * $item->tiket_masuk)
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
@endsection
