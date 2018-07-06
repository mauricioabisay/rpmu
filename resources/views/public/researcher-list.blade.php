@extends('public.main')

@section('content')
<div class="container">
	<div class="row">
	@foreach ( $participants as $participant )
		<div class="col-4 rpm-participant">
			<div class="thumb"></div>
			<a href="{{ route('researcher', [$participant->slug]) }}"><h5>{{ $participant->name }}</h5></a>
			@if ( $participant->user )
				<h6>{{ $participant->user->faculty->title }}</h6>
			@endif
		</div>
	@endforeach
	</div>
</div>
@endsection