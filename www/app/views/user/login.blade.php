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
		<ul>
			@foreach($errors->all() as $error)
			<li class="alert alert-danger">{{ $error }}</li>
			@endforeach
		</ul>

		<div class="container">
			@if(Session::has('message'))
			<p class="alert alert-warning">{{ Session::get('message') }}</p>
			@endif
		</div>

		{{ Form::open(array('url'=>'login', 'class'=>'form-signin')) }}
			<h2 class="form-signin-heading">Please Login</h2>

			<p>{{ Form::label('email', 'Username or E-Mail') }}</p>
			<p>{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Username or E-Mail')) }}</p>
			<p>{{ Form::label('password', 'Password') }}</p>
			<p>{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}</p>

			{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}

			{{ HTML::link('/reset', 'Forgot Password', array()) }}

		{{ Form::close() }}
    </div>
@stop