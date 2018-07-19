<div class="row rpm-researches-list">
@foreach ( $researches as $r )
	<div class="col-sm-12 col-md-4 rpm-research-item">
		<h3>{{ $r->title }}</h3>
		@if ( isset($r->faculty) && strlen($r->faculty) > 0 )
			<h4>{{ $r->faculty }}</h4>
		@endif
		@if ( Storage::exists('researches/'.$r->id.'/image.jpg') )
			<a href="{{ route('research', [$r->slug]) }}">
				<img src="{{ Storage::disk('local')->url('researches/'.$r->id.'/image.jpg')  }}">
			</a>
		@endif
		<p class="abstract">{{ $r->abstract }}</p>
		<p class="link"><a href="{{ route('research', [$r->slug]) }}">Ver más</a></p>
	</div>
@endforeach
</div>