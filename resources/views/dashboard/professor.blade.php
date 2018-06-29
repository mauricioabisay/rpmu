@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col">
		<p>Bienvenido Profesor {{ Auth::user()->name }}</p>
	</div>
</div>
@endsection