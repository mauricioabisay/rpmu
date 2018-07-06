@extends('public.main')

@section('content')
<div class="container">
	<div class="row">
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
	<div class="row">
	@foreach ( $researcher->researches as $r )
		<div class="col-sm-12 col-md-4">
			<h3>{{ $r->title }}</h3>
			<p>{{ $r->abstract }}</p>
			<p><a href="{{ route('research', [$r->slug]) }}">Ver más</a></p>
		</div>
	@endforeach
	</div>
</div>
@endsection