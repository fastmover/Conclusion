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


		<textarea name="content" id="content" cols="30" rows="10">
			{{ $page->content or '' }}
		</textarea>
    </div>
@stop

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
	tinymce.init({selector:'textarea'});
</script>