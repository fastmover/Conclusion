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

		@if($page->content != null)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><a href="/page/{{ $page->slug }}">{{ $page->title }}</a></h3>
			</div>
			<div class="panel-body">
				{{ $page->content }}
			</div>
		</div>
		@endif
    </div>
@stop