@extends('layouts.main')

@section('content')
	<form method="post" action="/subjects">
		@csrf
		<fieldset>
			<legend>Nuevo Tema</legend>
			<div class="form-group">
				<label for="title">Tema:</label>
				<input type="text" class="form-control" name="title" id="title">
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</form>
@endsection