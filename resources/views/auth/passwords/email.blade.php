@extends('layouts.app')

@section('content')
<div class="logo">
    <a href="{{ url('login') }}">
    <img src="../../assets/admin/layout/img/logo-big.png" alt="Madwall Logo">
    </a>
</div>
<div class="content">
    <div class="panel-heading">Reset Password</div>
    <div class="panel-body">
        @include('flash::message')
       
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="text" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-actions">
                <a href="{{ URL('/login' ) }}" class="btn btn-primary">Login</a>
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
