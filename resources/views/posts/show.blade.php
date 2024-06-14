@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post -> title }}</div>

                <div class="card-body">

                       <small>Gepost door <a href="{{ route('profile', $post -> user -> name) }}">{{$post->user->name}}</a> op {{$post->created_at->format('d/m/Y \o\m H:i' )}}</small><br>
                        <br>
                       {{$post -> message }}
                       <br><br>
                       @auth
                       @if($post -> user_id == Auth::user() ->id)
                            <a href="{{ route('posts.edit', $post -> id)}}">Edit Post</a>
                        @else
                            <a href="{{route('like', $post -> id)}}">Like post</a>
                        @endif
                        <br>
                        @endauth
                            Post heeft {{ $post -> likes() -> count()}} likes 
                        
                        @auth
                        @if(Auth::user()->is_admin || Auth::user()->id == $post->user_id)
                        <br><br>
                        <form method="post" action ="{{ route('posts.destroy', $post -> id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="DELETE POST" style="color : red;" onclick="return confirm('are you sure you want to delete this post?');">
                        </form>
                        @endif
                        @endauth
                       <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
