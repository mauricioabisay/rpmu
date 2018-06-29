@extends('layouts.main')

@section('content')
	<form action="{{ action( 'ParticipantController@update', ['id' => $participant->id]) }}" method="post">
		@csrf
		@method('PUT')

		<fieldset>
			<legend>Editar Participante</legend>
			
			<div class="form-group">
				<label for="id">ID/Matricula:</label>
				<input type="text" class="form-control" id="id" name="id" value="{{ $participant->id }}">
			</div>

			<div class="form-group">
				<label for="name">Nombre:</label>
				<input type="text" class="form-control" name="name" id="name"  value="{{ $participant->name }}">
			</div>
			
			<div class="form-group">
				<label for="bio">Bio:</label>
				<textarea name="bio" id="bio" cols="30" rows="10" class="form-control">{{ $participant->bio }}</textarea>
			</div>
			
			<div class="form-group">
				<label for="link">Link:</label>
				<input type="text" class="form-control" id="link" name="link" value="{{ $participant->link }}">
			</div>

			<div class="form-group">
				<label for="degree_slug">Licenciatura:</label>
				<select name="degree_slug" id="degree_slug" class="form-control">
					@foreach ( $degrees as $degree )
						<option value="{{ $degree->slug }}" {{ $degree->slug === $participant->degree_slug ? 'selected="selected"' : '' }}>
							{{ $degree->title }}
						</option>
					@endforeach
				</select>
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Actualizar">
	</form>
@endsection