<div class="container">
    <div class="row">
        <div class='card' style='width: 100%;'>
            <div class="card-body">
                <h5 class="card-title"> Most Commented</h5>
                <h6 class='card-subtitle mb-2 text-muted'>
                    What people are currently talking about
                </h6>
               
                 <ul class='list-group list-group-flush'>
                       @foreach ($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                {{ $post->title }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="row mt-4">
            <x-card title="Most Active" subtitle="Users with most post written"
                :items="collect($mostActive)->pluck('name')"></x-card>
            <div class="row mt-4">
                <x-card title="Most Active Last Month" subtitle="Users with most post written in the month"
                    :items="collect($mostActive)->pluck('name')"></x-card>
            </div>
        </div>
    </div>
</div>
