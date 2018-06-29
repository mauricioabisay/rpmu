@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col">
		<p>Bienvenido Director de Departamento{{ Auth::user()->name }}</p>
	</div>
</div>
@endsection