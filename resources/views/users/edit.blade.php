@extends('layouts.app')
@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', ['user' => $user->id]) }}"
        class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <img src="{{ $user->image ? $user->image->url() : ' ' }}" class="img-thumbnail avatar" />
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>{{ __('Upload a different photo') }}</h6>
                        <input class="form-control-file" type="file" name="avatar" />
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label>{{ __('Name:') }}</label>
                    <input class="form-control" value="" type="text" name="name" />
                </div>
                <div class="form-group">
                    <label>{{ __('Language:') }}</label>
                    <select class="form-control" name="locale">
                        @foreach(App\Models\User::LOCALES as $locale => $label)
                            <option value="{{ $locale }}" {{ $user->locale !== $locale ?: 'selected' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($errors->any())
                    <div class="mt-2 mb-2">
                        @foreach ($errors->all() as $error)
                            <div class='alert alert-danger' role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ __('Save changes') }}" />
                </div>
            </div>
        </div>

    </form>
@endsection
