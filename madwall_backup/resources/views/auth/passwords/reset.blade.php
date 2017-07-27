@extends('layouts.app')

@section('content')
<div class="logo">
    <a href="index.html">
    <img src="../../assets/admin/layout/img/logo-big.png" alt="Madwall Logo">
    </a>
</div>
<div class="content">
        <div class="panel-heading">Reset Password</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="text" class="form-control" placeholder="E-Mail" name="email" value="{{ $email or old('email') }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                     <input id="password" type="password" placeholder="Password" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                   
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                    </div>
                </div>
            </form>
        </div>
</div>
@endsection
