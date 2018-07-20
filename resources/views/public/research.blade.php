@extends('public.main')

@section('content')
<div class="rpm-research">
	<div class="header">
		<h1>{{ $research->title }}</h1>
		@if ( Storage::exists('researches/'.$research->id.'/image.jpg') )
		<div class="thumbnail jarallax" data-jarallax data-speed="0.2">
			<img class="jarallax-img" src="{{ Storage::disk('local')->url('researches/'.$research->id.'/image.jpg')  }}">
		</div>
		@endif
	</div>
<div class="container">
	
	<div class="row faculty">
		<div class="col">
			<h2>Facultad:</h2>
			<h3>{{ $research->faculty_title($research->id) }}</h3>
		</div>
	</div>

	<div class="row degrees">
		<div class="col">
			<h2>Carreas:</h2>
			<p class="list">
			@foreach( $research->degrees_titles($research->id) as $degree )
				<span><a href="{{ route('degree', [$degree->slug]) }}">{{ $degree->title }}</a></span>
			@endforeach
			</p>
		</div>
	</div>

	<div class="row subjects">
		<div class="col">
			<h2>Temas:</h2>
			<h3>
				@foreach ( $subjects as $s )
					<span>{{ $s->title }}</span>
				@endforeach
			</h3>
		</div>
	</div>

	<div class="row abstract">
		<div class="col">
			<h2>Síntesis:</h2>
			<p>{{ $research->abstract }}</p>
		</div>
	</div>
	
	<div class="rpm-leader rpm-participants">
		<div class="row">
			<div class="col">
				<h4>Director</h4>
			</div>
		</div>
		<div class="row">
		@foreach ( $research->leader as $participant )
			<div class="col-4 rpm-participant">
				<div class="thumb"></div>
				<h5>{{ $participant->name }}</h5>
				@if ( $participant->user )
					<h6>{{ $participant->user->faculty->title }}</h6>
				@endif
			</div>
		@endforeach
		</div>
	</div>
	
	@if ( $research->researchers()->exists() )
	<div class="rpm-researchers rpm-participants">
		<div class="row">
			<div class="col">
				<h4>Investigadores</h4>
			</div>
		</div>
		<div class="row"> 
		@foreach ( $research->researchers as $participant )
			<div class="col-4 rpm-participant">
				<div class="thumb"></div>
				<h5>{{ $participant->name }}</h5>
				@if ( $participant->degree_slug )
					<h6>{{ $participant->degree->title }}</h6>
				@endif
				@if ( $participant->user )
					<h6>{{ $participant->user->faculty->title }}</h6>
				@endif
			</div>
		@endforeach
		</div>
	</div>
	@endif
	
	@if ( $research->students()->exists() )
	<div class="rpm-participants rpm-students">
		<div class="row">
			<div class="col">
				<h4>Estudiantes</h4>
			</div>
		</div>
		<div class="row"> 
		@foreach ( $research->students as $participant )
			<div class="col-4 rpm-participant">
				<div class="thumb"></div>
				<h5>{{ $participant->name }}</h5>
				<h6>{{ $participant->degree->title }}</h6>
			</div>
		@endforeach
		</div>
	</div>
	@endif
	
	@if ( $research->description )
	<div class="row">
		<div class="col">
			<h2>Contenido</h2>
			<p>{{ $research->description }}</p>
		</div>
	</div>
	@endif
	
	<div class="rpm-research-carousel">
		@foreach(Storage::files('researches/'.$research->id.'/gallery') as $file)
			<div>
				<img src="{{ Storage::disk('local')->url($file)  }}">
			</div>
		@endforeach
	</div>

	@if ( $research->citations->count() > 0 )
	<div class="row">
		<div class="col">
			<h2>Referencias</h2>
			<ul>
				@foreach ( $research->citations as $citation )
					<li>{{ $citation->description }} <a href="{{ $citation->link }}">{{ $citation->link }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif
	
	@if ( $research->extra_info )
	<div class="row">
		<div class="col">
			<h2>Comentarios</h2>
			<p>{{ $research->extra_info }}</p>
		</div>
	</div>
	@endif
</div>
</div>
<script src="https://unpkg.com/jarallax@1.10/dist/jarallax.min.js"></script>
<script type="text/javascript">
	window.onload = function() {
		jQuery('.rpm-research-carousel').slick({dots: true});
	};
</script>
@endsection