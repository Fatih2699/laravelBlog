<div class='md-2 mt-2'>
@auth

<form action="{{route('posts.comments.store',['post'=>$posts->id])}}" method="POST">
@csrf

<div class="fomr-group">
    <textarea type="text" name='content',class='form-control'></textarea>
</div>


<button type="suubmit" class="btn btn-primary btn-block"> Add comment</button>
</form>

@if($errors->any())
<div class="mt-2 mb-2">
        @foreach($errors->all() as $error)
        <div class='alert alert-danger' role="alert">
            {{$error}}
        </div>
        @endforeach 
</div>
@endif

@else
<a href="{{route('login')}}">
    Sign-in to post Comments
</a>
@endauth
</div>