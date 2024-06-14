@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alle posts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <h3><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h3>
                        <div>
                            <!-- Display the image if it exists -->
                            @if ($post->image)
                                <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Post Image" style="max-width: 300px;">
                            @endif
                        </div>
                        <small>Gepost door <a href="{{ route('profile', $post->user->name) }}">{{ $post->user->name }}</a> op {{ $post->created_at->format('d/m/Y \o\m H:i') }}</small><br>

                        @auth
                        @if ($post->user_id == Auth::user()->id || Auth::user()->is_admin)
                            <a href="{{ route('posts.edit', $post->id) }}">Edit Post</a>
                        @endif

                        @if ($post->user_id != Auth::user()->id)
                            <a href="{{ route('like', $post->id) }}">Like post</a>
                        @endif
                        <br>
                        @endauth

                        Post heeft {{ $post->likes()->count() }} likes
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
