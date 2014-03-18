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
			<li>{{ $error }}</li>
			@endforeach
		</ul>

		<div class="container">
			@if(Session::has('message'))
			<p class="alert">{{ Session::get('message') }}</p>
			@endif
		</div>

		<h1>Dashboard</h1>

		<p>Welcome to your Dashboard. You rock!</p>
    </div>
@stop