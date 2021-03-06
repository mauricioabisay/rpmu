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
			width: 100%;
			height: 55vh;
			z-index: 0;
			position: relative;
		}
		.rpm-research .header .thumbnail img {
			position: absolute;
			object-fit: contain !important;
			object-position: 50% 25% !important;
			top: 0;
			left: 0;
			width: 100%;
			height: auto;
			z-index: -1;
		}
		.rpm-research .header h1 {
			text-align: center;
		}
		.rpm-research .degrees .list span a {
			color: #b61b1b;
		}
		.rpm-research .degrees .list span:after {
			content: ',';
			margin: 0 0.25em 0 0;
		}
		.rpm-research .degrees .list span:last-child::after {
			content: '';
		}
		/****/
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
		.rpm-participant a {
			text-decoration: none;
		} 
		/***/
		.rpm-research-carousel img {
			width: auto;
			height: 80vh;
			margin: 0 auto;
		}
		.slick-prev.slick-arrow, .slick-next.slick-arrow {
			background-color: #b61b1b;
			border-radius: 100%;
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
			opacity: .95;
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
		/*a,*/
		.rpm-menu a,
		.rpm-faculty a {
			text-decoration: none;
			color: #4d4d4d;
		}
		/**a:hover, a:focus, a:active, **/
		.rpm-menu a:hover, .rpm-menu a:focus, .rpm-menu a:active,
		.rpm-faculty a:hover, .rpm-faculty a:focus, .rpm-faculty a:active {
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
		/**/
		.rpm-faculty {
			margin: 1em 0em;
		}
		.rpm-faculty h2 a, 
		.rpm-faculty h3 a {
			width: 100%;
		}
		.rpm-faculty h2 {
			padding-bottom: 0.25em;
			border-bottom: 2px solid #b61b1b;
			font-size: 1.2em;
		}
		.rpm-faculty h3 {
			font-size: 1em;
			border-bottom: 1px dashed black;
		}
		.rpm-faculty h3 span {
			background-color: white;
			padding-bottom: 3px;
		}
		.rpm-faculty h3 span.counter {
			float: right;
		}
		/**/
		.rpm-participant-researches .header,
		.rpm-faculty-researches .header {
			margin: 0 0 2em;
		}
		/***/
		.rpm-researches-list .rpm-research-item h3 {
			font-size: 1.2em;
			font-weight: bolder;
		}
		.rpm-researches-list .rpm-research-item h4 {
			font-size: 1em;
			font-weight: lighter;
		}

		.rpm-researches-list .rpm-research-item h4:before,
		.rpm-researches-list .rpm-research-item .abstract:before {
			display: block;
			margin: 0.5em 0;
			color: #b61b1b;
		}

		.rpm-researches-list .rpm-research-item h4:before {
			content: 'Facultad';
		}
		.rpm-researches-list .rpm-research-item img {
			width: 100%;
			height: auto;
		}
		.rpm-researches-list .rpm-research-item p {
			font-size: .9em;
		}
		.rpm-researches-list .rpm-research-item .abstract:before {
			content: 'Síntesis';
		}
		.rpm-researches-list .rpm-research-item .link {
			border-bottom: 1px solid #b61b1b;
		}
		.rpm-pagination .pagination {
			margin: 1em 0;
			justify-content: center;
		}
		.rpm-pagination .pagination li.active span {
			background-color: #b61b1b;
			border-color: #b61b1b;
		}
		/***/
		.rpm-participant-researches .header .rpm-participant h1 {
			font-size: 1.5em;
		}
		.rpm-participant-researches .header .rpm-participant h2 {
			font-size: 1.2em;
		}
		.rpm-participant-researches .header .rpm-participant h3 {
			font-size: 1.1em;
		}
		.rpm-participant-researches .researches-header h3{
			margin: 1em 0;
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