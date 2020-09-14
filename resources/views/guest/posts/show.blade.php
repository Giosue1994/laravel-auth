@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>{{ $post->title }}</h1>

        <h6>Pubblicato il: {{ $post->created_at->format('d/m/Y') }}</h6>
        <br>
        <div>
          <img src="{{ $post->image }}" alt="immagine">
        </div>
        <br>
        <h4><a href="{{ url('/register') }}">Registrati</a> per vedere il nome dell'utente ed il contenuto del post</h4>
        <br>
        <a href="{{ route('admin.posts.index') }}">Torna indietro</a>
      </div>

    </div>
  </div>
@endsection
