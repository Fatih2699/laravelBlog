@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-tags :tags="$comment->tags"></x-tags>
    <p class="text-muted">
        added {{ $comment->created_at->diffForHumans() }} by {{ $comment->user->name }} {{$comment->user->id}}
    </p>
@empty
    <p>No comments yet!</p>
@endforelse
