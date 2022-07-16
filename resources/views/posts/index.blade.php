@extends('layouts.app')

@section('content')
    <div class='row'>
        <div class='col-8'>
            @forelse ($posts as $post)
                <p>
                <h3>
                    @if ($post->trashed())
                        <del>
                    @endif
                    <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                        href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                    @if ($post->trashed())
                        </del>
                    @endif
                </h3>

                <x-updated :date="$post->created_at" :name="$post->user->name" :userId="$post->user->id"></x-updated>

                {{-- <x-card title="Most Active Last Month" subtitle="Users with most post written in the month"
                                    :items="collect($mostActive)->pluck('name')"></x-card> --}}

                <p>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" class='badge badge-success'
                            style="background: green">{{ $tag->name }}</a>
                    @endforeach
                </p>
                {{-- <x-card title="Most Active" subtitle="Users with most post written"
                            :items="collect($mostActive)->pluck('name')"></x-card> --}}
                {{ trans_choice('messages.comments', $post->comments_count) }}
                <div class="d-flex">
                    @auth
                        @if (!$post->trashed())
                            @can('delete', $post)
                                <form method="POST" class="fm-inline"
                                    action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete!" class="btn btn-primary" />
                                </form>
                            @endcan
                        @endif
                    @endauth
                    @auth
                        @can('update', $post)
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary"
                                style="margin-left:10px; width:70px">
                                Edit
                            </a>
                        @endcan
                    @endauth
                </div>
                </p>
            @empty
                <p>No blog posts yet!</p>
            @endforelse
        </div>
        <div class='col-4'>
            @include('posts._activity')
        </div>
    </div>
@endsection('content')
