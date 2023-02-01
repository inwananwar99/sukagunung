

@extends('layouts.main')

@section('container')

  @foreach ($post as $item)

  <article class="mb-5">
  
    <h2>
        {{ $item->judul }}
    </h2>
    <img src="{{asset($item->gambar)}}" alt="">
  <h5>{{ $item->name }}</h5>
  <p>{{ $item->isi }}</p>
  
    </article>
  @endforeach
@endsection
      
      
