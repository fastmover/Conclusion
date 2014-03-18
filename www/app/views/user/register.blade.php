@extends('layouts.master')

@section('title')
	Signup
@stop

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <div class="container-fluid">


		@if(Session::has('message'))
		<div class="alert alert-warning">{{ Session::get('message') }}</div>
		@endif

		@if(count($errors->all()) > 0)
		<ul class="alert alert-danger well well-lg">
			@foreach($errors->all() as $error)
			<li class="">{{ $error }}</li>
			@endforeach
		</ul>
		@endif

        {{ Form::open(array('url' => 'register', 'class' => "navbar-form")) }}
            <!-- check for login errors flash var -->
            @if (Session::has('login_errors'))
                {{ Alert::error("Username or password incorrect.") }}
            @endif
            <!-- username field -->
            <p>{{ Form::label('username', 'Username') }}</p>
            <p>{{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Username')) }}</p>
            <!-- password field -->
            <p>{{ Form::label('password', 'Password') }}</p>
            <p>{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}</p>
            <!-- password confirmation field -->
            <p>{{ Form::label('password_confirmation', 'Repeat Password') }}</p>
            <p>{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}</p>
            <!-- emaile field -->
            <p>{{ Form::label('email', 'E-Mail') }}</p>
            <p>{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'E-Mail')) }}</p>
            <!-- submit button -->
			{{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
        {{ Form::close() }}
    </div>
@stop