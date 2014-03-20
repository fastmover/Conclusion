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
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
								<li class="divider"></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
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
		<div class="col-md-3">
			@section('sidebar')
			<div class="list-group">
				<a href="/" class="list-group-item active">Home	</a>
				@if(User::isAdmin())
				{{ HTML::link('admin/pages', 'Pages', array('class' => 'list-group-item')) }}
				@endif
				@if(!Auth::check())
				{{ HTML::link('register', 'Register', array('class' => 'list-group-item')) }}
				{{ HTML::link('login', 'Login', array('class' => 'list-group-item')) }}
				@else
				{{ HTML::link('logout', 'logout', array('class' => 'list-group-item')) }}
				@endif
				<a href="/register" class="list-group-item">Register</a>
				<a href="/login" class="list-group-item">Login</a>
				<a href="#" class="list-group-item">Morbi leo risus</a>
				<a href="#" class="list-group-item">Porta ac consectetur ac</a>
				<a href="#" class="list-group-item">Vestibulum at eros</a>
			</div>
			@show
		</div>
		<div class="col-md-9">
			@yield('content')
		</div>
	</div>
	</body>
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
</html>