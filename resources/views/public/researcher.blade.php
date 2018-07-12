@extends('public.main')

@section('content')
<div class="container rpm-participant-researches">
	<div class="row header">
		<div class="col rpm-participant">
			<div class="thumb"></div>
			<h1>{{ $researcher->name }}</h1>
			@if ( $researcher->degree_slug )
				<h3>{{ $researcher->degree->title }}</h3>
			@endif
			@if ( $researcher->user )
				<h2>{{ $researcher->user->faculty->title }}</h2>
			@endif
		</div>
	</div>
	<div class="row desc">
		<p>{{ $researcher->bio }}</p>
		<p>Link: <a href="{{ $researcher->link }}">{{ $researcher->link }}</a></p>
	</div>
	<div class="row researches-header">
		<h3>Proyectos</h3>
	</div>
	<?php $researches = $researcher->researches;?>
	@include('public.list-researches')
</div>
@endsection