@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-4">
            <img src="{{ $user->image ? $user->image->url() : ' ' }}" class="img-thumbnail avatar" />
        </div>
        <div class="col-8">
            <h3>{{ $user->name }}</h3>
            <p> Currently viewed by {{ $counter }} other users</p>
            <x-comment-list :comments="$user->commentsOn"></x-comment-list>
        </div>
        <div class='md-2 mt-2'>
            @auth
                <form action="{{ route('users.comments.store', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    <div class="fomr-group">
                        <textarea type="text" name='content' ,class='form-control'></textarea>
                    </div>
                    <button type="suubmit" class="btn btn-primary btn-block"> Add comment</button>
                </form>
                @if ($errors->any())
                    <div class="mt-2 mb-2">
                        @foreach ($errors->all() as $error)
                            <div class='alert alert-danger' role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}">
                    Sign-in to post Comments
                </a>
            @endauth
        </div>
    </div>
@endsection
