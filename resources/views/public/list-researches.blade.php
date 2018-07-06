<div class="row">
@foreach ( $researches as $r )
	<div class="col-sm-12 col-md-4">
		<h3>{{ $r->title }}</h3>
		<p>{{ $r->abstract }}</p>
		<p><a href="{{ route('research', [$r->slug]) }}">Ver más</a></p>
	</div>
@endforeach
</div>