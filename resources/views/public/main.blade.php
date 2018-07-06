<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title></title>
	<style type="text/css">
		.rpm-research .header {
			margin: 2em 0;
		}
		.rpm-research .header .thumbnail {
			background-size: cover !important;
			background-repeat: no-repeat !important;
			width: 100%;
			height: 40vh;
			z-index: 5;
		}
		.rpm-research .header h1 {
			text-align: center;
		}
		
		.rpm-participants {
			margin: 2em 0;
		}
		.rpm-participant {
			text-align: center;
		}
		.rpm-participant .thumb {
			width: 10vh;
			height: 10vh;
			background: lightgray;
			border-radius: 100%;
			margin: 1em auto;
		}
		.rpm-research-carousel img {
			width: auto;
			height: 80vh;
			margin: 0 auto;
		}
		
		.rpm-menu {
			position: fixed;
			top: 0;
			left: 0;
			height: 1em;
			width: 100%;
			z-index: 100;
		}

		.rpm-menu-toggle {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			height: 100vh;
			width: 45vw;
			z-index: 101;
		}

		.rpm-menu-toggle:before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			background-color: white;
			opacity: .9;
			height: 100%;
			width: 100%;
			z-index: 105;
		}
		.rpm-menu-toggle .toggle, .rpm-menu .content {
			position: absolute;
			top: 5em;
			left: 0;
			width: 100%;
			text-align: right;
			padding-right: 2em;
			z-index: 110;
		}
		.rpm-menu a {
			text-decoration: none;
			color: #4d4d4d;
		}
		.rpm-menu a:hover, .rpm-menu a:focus, .rpm-menu:active {
			color: #b61b1b;
		}
		.rpm-menu .toggle {
			top: 0;
			padding-top: 1em;
			padding-right: 1em;
			cursor: pointer;
		}
		.rpm-menu .toggle.rpm-menu-close:before {
			content: '\03a7';
			color: #b61b1b;
		}
		.rpm-menu-logo {
			padding: 1em 2em;
			background: white;
		}
		.rpm-menu-open {
			
		}
		.rpm-menu-open h5 {
			font-weight: bolder;
			padding-bottom: 0.5em;
			padding-left: 0.5em;
			border-bottom: 2px solid #b61b1b;
		}
		.rpm-content {
			margin-top: 5em;
		}

		.rpm-faculty h2 {
			padding-bottom: 0.25em;
			border-bottom: 2px solid #b61b1b;	
		}
	</style>
</head>
<body>
	<div class="rpm-menu">
		<div class="rpm-menu-logo">
			<a class="rpm-menu-open" href="javascript:void(0)"><h5>MENÚ</h5></a>
		</div>
		<div class="rpm-menu-toggle">
			<div class="toggle rpm-menu-close"></div>
			<div class="content">
				<a href="{{ route('home') }}"><h5>Inicio</h5></a>
				<a href="{{ route('research') }}"><h5>Investigaciones</h5></a>
				<a href="{{ route('faculty') }}"><h5>Facultades</h5></a>
				<a href="{{ route('researcher') }}"><h5>Investigadores</h5></a>
			</div>
		</div>
	</div>
	<div class="rpm-content">
		@yield('content')
	</div>
	@include('public.footer')
</body>
</html>