@extends('public.main')

@section('content')
	<h1>HOME</h1>
	<div class="row">
	@foreach ( $researches as $r )
		<div class="col-sm-12 col-md-4">
			<h3>{{ $r->title }}</h3>
			<p>{{ $r->abstract }}</p>
		</div>
	@endforeach
	</div>
@endsection