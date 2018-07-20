@extends('public.main')

@section('content')
<div class="container rpm-faculty-researches">
	<div class="row header">
		<div class="col">
			<h1 style="text-align: center;">Investigaciones Programa Académico</h1>
			<h1 style="text-align: center;">{{ $degree->title }}</h1>
		</div>
	</div>
	@include('public.list-researches')
</div>
@endsection