@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Crea il tuo Post</h1>
        
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="post">
          @csrf
          @method('POST')

          <input type="text" name="title" value="{{ old('title') }}" placeholder="Inserisci titolo">
          <br><br>
          <textarea name="content" rows="8" cols="80" placeholder="Inserisci contenuto">{{ old('content') }}</textarea>
          <br>
          <input type="submit" value="Salva">
          <br><br>
          <a href="{{ route('admin.posts.index') }}">Torna indietro</a>
          <br><br>

        </form>

    </div>
  </div>
@endsection
