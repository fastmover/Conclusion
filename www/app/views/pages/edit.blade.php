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
		<?php
			$title = isset($page) and $page->title or '';
		?>
		{{ Form::open(array('url'=>'/page/save', 'class'=>'form-page-edit form-group')) }}
			<p>{{ Form::text('title', $title, array('class'=>'input-block-level form-control', 'placeholder'=>'Title')) }}</p>

			<textarea name="content" id="content" cols="30" rows="10">
				{{ $page->content or '' }}
			</textarea>
			<br/>
			@if(isset($page) and $page->author_id != null)
				{{ Form::hidden('author_id', $page->author_id) }}
			@endif
			@if(isset($page) and $page->id)
				{{ Form::hidden('id', $page->id) }}
			@endif
			{{ Form::submit('Save', array('class'=>'btn btn-large btn-primary'))}}

		{{ Form::close() }}
    </div>
@stop

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
	tinymce.init({selector:'textarea'});
</script>