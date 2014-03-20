@extends('layouts.master')

@section('title')
	Signup
@stop


<?php
if(isset($page)) {
	$id			= $page->id;
	$title 		= $page->title;
	$slug 		= $page->slug;
	$content 	= $page->content;
	$author_id 	= $page->author_id;
} else {
	$id			= '';
	$title 		= '';
	$slug 		= '';
	$content 	= '';
	$author_id 	= '';
}
?>

@section('formstart')
{{ Form::open(array('url'=>'/page/save', 'class'=>'form-page-edit form-group')) }}
@stop

@section('formend')
{{ Form::close() }}
@stop

@section('sidebar')
    @parent
	<div class="well">
		{{ Form::label('slug', 'Slug') }}
		{{ Form::text('slug', $slug, array('placeholder' => 'slug', 'class' => 'input-block-level form-control')) }}
		<div class="well">
			{{ Form::submit('Save', array('class'=>'btn btn-large btn-primary form-control'))}}
		</div>
	</div>
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

			<p>{{ Form::text('title', $title, array('class'=>'input-block-level form-control', 'placeholder'=>'Title')) }}</p>

			<textarea name="content" id="content" cols="30" rows="10">
				{{ $content }}
			</textarea>
			<br/>
			@if(isset($page) and $page->author_id != null)
				{{ Form::hidden('author_id', $author_id) }}
			@endif
			@if(isset($page) and $page->id)
				{{ Form::hidden('id', $id) }}
			@endif
    </div>
@stop

<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
	tinymce.init({selector:'textarea'});
</script>