@extends('layouts.master')

@section('title')
	Signup
@stop

@section('sidebar')
    @parent
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

		@if( $pages != null)
			@foreach($pages as $page)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><a href="/page/{{ $page->slug }}">{{ $page->title }}</a></h3>
					</div>
					<div class="panel-body">
						{{ $page->content }}
					</div>
				</div>
			@endforeach
		@endif
    </div>
@stop




