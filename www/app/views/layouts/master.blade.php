<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>
			@section('title')
				Default
			@show
		</title>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	</head>
	<body>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Brand</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					@if(Auth::check() and User::isAdmin())
					<ul class="nav navbar-nav">
						<li><a href="/admin">Admin</a></li>
						@if(!Auth::check())
						<li>{{ HTML::link('register', 'Register', array('class' => 'list-group-item')) }}</li>
						<li>{{ HTML::link('login', 'Login', array('class' => 'list-group-item')) }}</li>
						@endif
						@if(Auth::user()->role == "admin")
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/pages">All Pages</a></li>
								<li><a href="/page/add">Add Page</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
						@endif
					</ul>
					@endif
					@if(Auth::check())
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="glpyhicon glyphicon-user"></span>
								{{ Auth::getUser()->username }} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Dashboard</a></li>
								<li class="divider"></li>
								<li><a href="/logout">Logout</a></li>
							</ul>
						</li>
					</ul>
					@endif
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">Search</button>
					</form>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		@section('formstart')
		@show
		<div class="col-md-9">
			@yield('content')
		</div>
		<div class="col-md-3">
			@section('sidebar')

			@show
		</div>
		@section('formend')
		@show
	</div>
	</body>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
</html>