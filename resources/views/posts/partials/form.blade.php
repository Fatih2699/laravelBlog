<div class='form-group'>
    <label for="title">Title</label>
    <input id ='title' type="text" name='title' class="form-control" value="{{old('title',optional($post ?? null)->title)}}">
</div>

@error ('title')
    <div class='alert alert-danger'>
        {{ $message }}
    </div>
@enderror

<div class='form-group'>
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id='content'>
        {{old('content',optional($post ?? null)->content)}}
    </textarea>
</div>

<div class="form-group">
    <label for="title">Thumbnail</label>
    <br>
    <input id ='title' type="file" name='thumbnail' class="form-control-file">
</div>

@if($errors->any())
    <div class="mt-2 mb-2">
            @foreach($errors->all() as $error)
            <div class='alert alert-danger' role="alert">
                {{$error}}
            </div>
            @endforeach
    </div>
    @endif 