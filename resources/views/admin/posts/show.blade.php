@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>{{ $post->title }}</h1>

        <h4>{{ $post->user->name }} - <i><u>{{ $post->user->email }}</u></i></h4>
        <h6>Pubblicato il: {{ $post->created_at->format('d/m/Y') }}</h6>
        <br>
        @if (!empty($post->image))
          <div>
            @if (File::exists('storage' . '/' . $post->image))
              <img src="{{ asset('storage') . '/' . $post->image }}" alt="immagine">
            @else
              <img src="{{ $post->image }}" alt="immagine">          
            @endif

          </div>
        @endif
        <br>
        <p>{{ $post->content }}</p>
        <br>
        <a href="{{ route('admin.posts.index') }}">Torna indietro</a>
      </div>

    </div>
  </div>
@endsection
