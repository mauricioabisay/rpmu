<div class="row rpm-researches-list">
@foreach ( $researches as $r )
	<div class="col-sm-12 col-md-4 rpm-research-item">
		<h3>{{ $r->title }}</h3>
		@if ( Storage::exists('researches/'.$r->id.'/image.jpg') )
			<img src="{{ Storage::disk('local')->url('researches/'.$r->id.'/image.jpg')  }}">
		@endif
		<p>{{ $r->abstract }}</p>
		<p class="link"><a href="{{ route('research', [$r->slug]) }}">Ver más</a></p>
	</div>
@endforeach
</div>