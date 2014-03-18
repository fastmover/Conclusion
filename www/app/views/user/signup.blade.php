@extends('layouts.master')

@section('title')
	Signup
@stop

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="signup">
        {{ Form::open(array('url' => 'user/signup')) }}
            <!-- check for login errors flash var -->
            @if (Session::has('login_errors'))
                {{ Alert::error("Username or password incorrect.") }}
            @endif
            <!-- username field -->
            <p>{{ Form::label('username', 'Username') }}</p>
            <p>{{ Form::text('username') }}</p>
            <!-- password field -->
            <p>{{ Form::label('password', 'Password') }}</p>
            <p>{{ Form::password('password') }}</p>
            <!-- emaile field -->
            <p>{{ Form::label('email', 'E-Mail') }}</p>
            <p>{{ Form::text('email') }}</p>
            <!-- submit button -->
            <p>{{ Form::submit('Login', array('class' => 'btn-large')) }}</p>
        {{ Form::close() }}
    </div>
@stop