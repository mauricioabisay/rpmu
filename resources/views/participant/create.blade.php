@extends('layouts.main')

@section('content')
	<form method="post" action="/participants">
		@csrf
		<fieldset>
			<legend>Nuevo Participante</legend>
			
			<div class="form-group">
				<label for="id">ID/Matricula:</label>
				<input type="text" class="form-control" id name="id">
			</div>

			<div class="form-group">
				<label for="name">Nombre:</label>
				<input type="text" class="form-control" name="name" id="name">
			</div>
			
			<div class="form-group">
				<label for="bio">Bio:</label>
				<textarea name="bio" id="bio" cols="30" rows="10" class="form-control"></textarea>
			</div>
			
			<div class="form-group">
				<label for="link">Link:</label>
				<input type="text" class="form-control" id="link" name="link">
			</div>

			<div class="form-group">
				<label for="faculty_slug">Licenciatura:</label>
				<select name="degree_slug" id="degree_slug" class="form-control">
					@foreach ( $degrees as $degree )
						<option value="{{ $degree->slug }}">{{ $degree->title }}</option>
					@endforeach
				</select>
			</div>

		</fieldset>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</form>
@endsection