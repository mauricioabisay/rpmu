@extends('layouts.main')

@section('content')
	<form method="post" action="{{action('DegreeController@store')}}">
		@csrf
		<fieldset>
			<legend>Nueva Licenciatura</legend>
			<div class="form-group">
				<label for="title">Licenciatura:</label>
				<input type="text" class="form-control" name="title" id="title">
			</div>
			<div class="form-group">
				<label for="faculty_slug">Facultad:</label>
				<select name="faculty_slug" id="faculty_slug" class="form-control">
					@foreach ( $faculties as $faculty )
						<option value="{{ $faculty->slug }}">{{ $faculty->title }}</option>
					@endforeach
				</select>
			</div>
		</fieldset>
		<input type="submit" class="btn btn-primary" value="Guardar">
	</form>
@endsection