@extends('layouts.main')
@section('content')
	
	<form method="post">
		<fieldset>
			<legend>Información General</legend>
			<div class="form-group">
				<label for="title">Título:</label>
				<input type="text" class="form-control" id="title" name="title">
			</div>

			<div class="form-group">
				<label for="subject">Tema:</label>
				<input type="text" class="form-control" id="subject" name="subject">
			</div>

			<div class="form-group">
				<button class="btn btn-primary rpm-badge" type="button">Tema 1</button>
				<button class="btn btn-primary rpm-badge" type="button">Tema 2</button>
				<button class="btn btn-primary rpm-badge" type="button">Tema 3</button>
				<button class="btn btn-primary rpm-badge" type="button">Tema 4</button>
				<button class="btn btn-primary rpm-badge" type="button">Tema 5</button>
			</div>
			
			<div class="form-group">
				<label for="abstract">Síntesis:</label>
				<textarea name="abstract" id="abstract" cols="30" rows="3" class="form-control"></textarea>
			</div>
		</fieldset>

		<div class="form-group">
			<input class="btn btn-primary" type="submit" value="Guardar">
		</div>
	</form>

@endsection