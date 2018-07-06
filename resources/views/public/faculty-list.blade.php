@extends('public.main')

@section('content')
<div class="container">
	<div class="row">
	@foreach ( $faculties as $faculty )
		<div class="col-sm-12 col-md-4 rpm-faculty">
			<a href="{{ route('faculty', [$faculty->slug]) }}"><h2>{{ $faculty->title }}</h2></a>
			@foreach ( $faculty->degrees as $degree )
				<h3>{{ $degree->title }}</h3>
			@endforeach
		</div>
	@endforeach
	</div>
</div>
@endsection