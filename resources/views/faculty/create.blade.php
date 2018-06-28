@extends('layouts.main')

@section('content')
	<form method="post" action="{{ action('FacultyController@create') }}">
		@csrf
		<fieldset>
			<legend>Nueva Facultad</legend>
			<div class="form-group">
				<label for="title">Facultad:</label>
				<input type="text" class="form-control" name="title" id="title">
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</form>
@endsection