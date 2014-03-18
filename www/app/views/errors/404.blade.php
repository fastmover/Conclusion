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


	<h1>404 Not Found.</h1>

</div>
@stop