@extends('layouts.app')

@section('content')
    <div class='row'>
        <div class='col-8'>
            @if ($posts->image)
                <div
                    style="background-image: url('{{ $posts->image->url() }}');
                                                     min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
                    <h1 style="padding-top: 600px; text-shadow: 1px 2px #000">
                    @else
                        <h1>
            @endif
            {{ $posts->title }}
            @if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) < 50)
                @component('components.badge', ['show' => 'false'])
                    Brand new Post!
                @endcomponent
            @endif
            @if ($posts->image)
                </h1>
        </div>
    @else
        </h1>
        @endif
        <p>{{ $posts->content }}</p>
        <p>Added {{ $posts->created_at->diffForHumans() }}</p>
        @if ((new Carbon\Carbon())->diffInMinutes($posts->created_at) < 20)
            @component('components.badge', ['type' => 'primary'])
                Brand new Post!
            @endcomponent
        @endif
        <p>
            @foreach ($posts->tags as $tag)
                <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" class='badge badge-success'
                    style="background: green">{{ $tag->name }}</a>
            @endforeach
        </p>
        <p>{{ trans_choice('messages.people.reading', $counter) }}</p>
        <h4>Comments</h4>
        <div class='md-2 mt-2'>
            @auth
                <form action="{{ route('posts.comments.store', ['post' => $posts->id]) }}" method="POST">
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
        <x-comment-list :comments="$posts->comments"></x-comment-list>
    </div>
    <div class='col-4'>
        @include('posts._activity')
    </div>
@endsection
