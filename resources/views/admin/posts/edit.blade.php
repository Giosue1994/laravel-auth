@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Modifica il tuo Post</h1>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <input type="text" name="title" value="{{ old('title') ? old('title') : $post->title }}" placeholder="Inserisci titolo">
          <br><br>
          <label>Modifica immagine</label>
          <input type="file" name="image" accept="image/*">
          <br><br>
          <textarea name="content" rows="8" cols="80" placeholder="Inserisci contenuto">{{ old('content') ? old('title') : $post->content }}</textarea>
          <br>
          <input type="submit" value="Modifica">
          <br><br>
          <a href="{{ route('admin.posts.index') }}">Torna indietro</a>
          <br><br>

        </form>

    </div>
  </div>
@endsection
