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

	{{ Form::open(array('url'=>'reset', 'class'=>'form-forgot')) }}
	<h2 class="form-signin-heading">Password Reset</h2>

	<p>{{ Form::label('email', 'Username or E-Mail') }}</p>
	<p>{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Username or E-Mail')) }}</p>

	{{ Form::submit('Reset', array('class'=>'btn btn-large btn-primary btn-block'))}}

	{{ Form::close() }}
</div>
@stop