@extends('layouts.main')

@section('content')
	<form action="{{ action('FacultyController@update', ['id' => $subject->slug]) }}" method="post">
		@csrf
		@method('PUT')

		<fieldset>
			<legend>Editar Facultad</legend>
			<div class="form-group">
				<label for="title">Facultad:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ $subject->title }}">
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Actualizar">
	</form>
@endsection