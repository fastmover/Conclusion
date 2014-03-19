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
		<h1>Hello {{ Auth::user()->username; }}</h1>

		<p>Welcome to the Admin Dashboard. You rock!</p>
    </div>
@stop