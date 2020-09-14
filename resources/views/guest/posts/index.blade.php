@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h1>Lista Posts</h1>

        <ul>
          @foreach ($posts as $post)
            <li>
              <h4><b><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></b></h4>
            </li>
          @endforeach
        </ul>

        <h5>Clicca su un post per visualizzarne il contenuto</h5>

      </div>
    </div>
  </div>
@endsection
