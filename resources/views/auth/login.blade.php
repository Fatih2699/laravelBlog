@extends('layouts.app')

@section('content')
  <form action="{{route('login')}}" method="POST">
    @csrf

  
    <div class='form-group'>
        <label></label>
            E-mail
        <input name="email" value='{{old('email')}}' required 
        class="form-control{{$errors->has('email') ? 'is-invalid':''}}">
        @if ($errors->has('email'))
        <span class='invalid-feedback'>
            <strong>{{$errors->first('email')}}</strong>
        </span>            
    @endif
    </div>
    <div class='form-group'>
        <label>
            Password</label>
        <input name="password" type="password" value='{{old('password')}}' required 
        class="form-control{{$errors->has('password') ? 'is-invalid':''}}">
        @if ($errors->has('password'))
        <span class='invalid-feedback'>
            <strong>{{$errors->first('password')}}</strong>
        </span>            
    @endif

    <div class ='form-groups'>

        <div class="form-check">
            <input class='form-check-input' type="checkbox" name='remember'
            value="{{ old('remember') ? 'checked' : '' }}">

            <label for="form-check-label" for='remember'>
                Remember Me
            </label>
        </div>

    </div>

    <button type="submit" class ='btn btn-primary btn-block'>
                Login!
    </button>
    </form>   
@endsection 