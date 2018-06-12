<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	
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
	</style>
</head>
<body>
	
	<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
	  <a class="navbar-brand" href="#">R.P.M.</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbar-content">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	        <a class="nav-link" href="#">Investigaciones</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Participantes</a>
	      </li>
	      
	      <li class="nav-item dropdown">
	      	<a class="nav-link dropdown-toggle" href="#" id="utilities-menu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Utilidades
	        </a>
	        <div class="dropdown-menu" aria-labelledby="utilities-menu">
	        	<a class="dropdown-item" href="/subjects">Temas</a>
	        	<a class="dropdown-item" href="/degrees">Licenciaturas</a>
	        	<a class="dropdown-item" href="/faculties">Facultades</a>
	        </div>
	      </li>
	      
	      <li class="nav-item">
	        <a class="nav-link" href="#">Usuarios</a>
	      </li>
	  </div>
	</nav>

	<div class="container" style="margin-top:60px">
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