@extends('layouts.main')

@section('content')
	<form action="{{ action('SubjectController@update', ['id' => $subject->slug]) }}" method="post">
		@csrf
		@method('PUT')

		<fieldset>
			<legend>Editar Tema</legend>
			<div class="form-group">
				<label for="title">Tema:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ $subject->title }}">
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Actualizar">
	</form>
@endsection