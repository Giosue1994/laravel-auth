@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Crea il tuo Post</h1>
        <form action="{{ route('admin.posts.store') }}" method="post">
          @csrf
          @method('PUT')

          <input type="text" name="title" value="{{ old('title') }}" placeholder="Inserisci titolo">
          <br><br>
          <textarea name="content" rows="8" cols="80" placeholder="Inserisci contenuto">{{ old('content') }}</textarea>

          <br>
          <a href="{{ route('admin.posts.index') }}">Torna indietro</a>
          <br><br>

        </form>

    </div>
  </div>
@endsection
