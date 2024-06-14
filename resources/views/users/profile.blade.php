@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profiel van {{ $user->name }}</h1>
    
    @auth
        @if(Auth::id() == $user->id)
            <form id="updateProfileForm" action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $user->birthday }}">
                </div>

                <div class="form-group">
                    <label for="about">About:</label>
                    <textarea name="about" id="about" class="form-control">{{ $user->about }}</textarea>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>

            <!-- Display current avatar -->
            @if ($user->avatar)
                <div class="mt-3">
                    <h3>Current Avatar:</h3>
                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" style="max-width: 200px;">
                </div>
            @endif

            <!-- Form to upload new avatar -->
            <form action="{{ route('profile.upload_avatar', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="avatar">Choose New Avatar:</label>
                    <input type="file" name="avatar" id="avatar" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Upload Avatar</button>
            </form>
        
        @else
            <div class="card-body">
                <!-- Display current avatar -->
                @if ($user->avatar)
                    <div class="mt-3">
                        <h3>Avatar:</h3>
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" style="max-width: 200px;">
                    </div>
                @endif

                <h2>Gemaakte Posts</h2>
                @foreach ($user->posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a><br>
                @endforeach
                <!-- All the posts created by this user -->
                <hr>
                <h2>Gelikete Posts</h2>
                @foreach ($user->likes as $like)
                    <a href="{{ route('posts.show', $like->post_id) }}">{{ $like->post->title }}</a><br>
                @endforeach
                <!-- All the posts liked by this user -->
                <hr>
                <h2>Birthday</h2>
                <div>
                    <label>Birthday:</label>
                    <span>{{ $user->birthday }}</span>
                </div>
                <!-- The birthday of this user -->
                <hr>
                <div class="profile-section">
                    <h2>About me</h2>
                    <p>{{ $user->about }}</p>
                    <!-- The "about me" section of this user -->
                </div>
            </div>
        @endif
    @endauth
    
    <!-- Promote to admin link -->
    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ route('promote.admin', ['id' => $user->id]) }}">Promote to Admin</a>
        @endif
    @endauth

</div>
@endsection
