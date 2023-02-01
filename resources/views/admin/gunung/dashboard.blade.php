
    @extends('admin.main')

    @section('container')
      <div style="margin-top: 100px">
        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif
      </div>
    @endsection