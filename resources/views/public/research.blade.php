@extends('public.main')

@section('content')
	<h1>{{ $research->title }}</h1>
	<h2>{{ $research->subject }}</h2>
	<h2>Resumen</h2>
	<p>{{ $research->abstract }}</p>
	<h2>Contenido</h2>
	<p>{{ $research->description }}</p>
	<h2>Comentarios</h2>
	<p>{{ $research->extra_info }}</p>
@endsection