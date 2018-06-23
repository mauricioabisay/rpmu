<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-signin-client_id" content="{{ env('G_CLIENT_ID') }}">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<style type="text/css">
		.rpm-badge {
			border-radius: 25px;
		}
		.rpm-create-new {
			margin: 1em auto 2em;
		}
		.rpm-row-options {
			text-align: right;
		}
		.rpm-row-options form, .rpm-row-options .btn {
			display: inline-block;
		}
		.rpm-research-table .created {
			color: lightgreen;
		}
		.rpm-research-table .started {
			color: palegreen;
		}
		.rpm-research-table .completed {
			color: darkseagreen;
		}

		.rpm-api-list {
			background: lightgray;
			list-style: none;
		}
		.rpm-api-list li {
			cursor: pointer;
			padding: 0.25em 0em;
		}
		.rpm-api-list li:first-child {
			padding-top: 1em;
		}
		.rpm-api-list li:last-child {
			padding-bottom: 1em;
		}

		.rpm-api-cloud .rpm-badge {
			margin: 0.25em;
		}
		.rpm-api-cloud .rpm-badge span:after {
			content: '\03a7';
			margin-left: 0.5em;
			font-weight: bolder;
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
		<a class="navbar-brand" href="#">R.P.M.</a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span></button>

	    <div class="collapse navbar-collapse" id="navbar-content">
	    <ul class="navbar-nav mr-auto">
	    	<li class="nav-item">
	    		<a class="nav-link" href="/researches">Investigaciones</a>
	    	</li>
	    	<li class="nav-item">
	    		<a class="nav-link" href="/participants">Participantes</a>
	    	</li>
	    	@if ( Auth::check() )
	    		<li class="nav-item dropdown">
	    			<a class="nav-link dropdown-toggle" href="#" id="utilities-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Utilidades</a>

	    			<div class="dropdown-menu" aria-labelledby="utilities-menu">
	    				<a class="dropdown-item" href="/subjects">Temas</a>
	    				<a class="dropdown-item" href="/degrees">Licenciaturas</a>
	    				<a class="dropdown-item" href="/faculties">Facultades</a>
	    			</div>
	    		</li>
	    		<li class="nav-item">
	    			<a class="nav-link" href="/users">Usuarios</a>
	    		</li>

				<li class="nav-item">
					<a class="nav-link" href="#" onclick="signOut()">Salir</a>
					<form id="logout" action="/logout" method="post">@csrf</form>
				</li>
			@else
				<li class="nav-item">
					<a class="nav-link" href="/admin">Admin</a>
				</li>
			@endif
		</div>
	</nav>
	<div class="g-signin2" data-onsuccess="onSignIn" style="display: none;"></div>
	<div class="container" style="margin-top:60px">
		@if ( session()->has('msg.type') && session()->has('msg.text') )
			<div class="alert {{ session('msg.type') }}">
				{{ session('msg.text') }}
			</div>
		@endif
		@if ( $errors->any() )
			<div class="alert alert-danger">
				<ul>
					@foreach ( $errors->all() as $error )
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@yield('content')
	</div>
	@include('layouts.footer')
</body>
</html>