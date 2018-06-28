@extends('layouts.main')

@section('content')
	<form action="{{ action('DegreeController@update', ['id'=>$degree->slug]) }}" method="post">
		@csrf
		@method('PUT')

		<fieldset>
			<legend>Editar Licenciatura</legend>
			<div class="form-group">
				<label for="title">Licenciatura:</label>
				<input type="text" class="form-control" name="title" id="title" value="{{ $degree->title }}">
			</div>
			<div class="form-group">
				<label for="faculty_slug">Facultad:</label>
				<select name="faculty_slug" id="faculty_slug" class="form-control">
					@foreach ( $faculties as $faculty )
						<option value="{{ $faculty->slug }}" {{ $faculty->slug === $degree->faculty_slug ? 'selected="selected"' : '' }}>
							{{ $faculty->title }}
						</option>
					@endforeach
				</select>
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Actualizar">
	</form>
@endsection