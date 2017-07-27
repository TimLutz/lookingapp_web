@extends('layouts.app')

@section('content')
<div class="logo">
    <a href="{{ url('login') }}">
        {{ Html::image('public/logos/admin-logo.png', 'alt', array( 'width' => 150 ) ) }}
    </a>
</div>
<div class="content">
    <form class="form-horizontal login-form" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h3 class="form-title">Sign In</h3>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">   
            <input id="email" type="text" placeholder="Email*" class="form-control form-control-solid placeholder-no-fix" name="email" autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" placeholder="Password*" class="form-control form-control-solid placeholder-no-fix" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Sign In </button>
                <!-- <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/> Remember Me
                </label> -->
           <!--  <a href="{{ route('password.request') }}" id="forget-password" class="forget-password">Forgot Password?</a>

        </div>
        </form>    
</div>
@endsection
