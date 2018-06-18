@extends('layouts.main')
@section('content')
	
	<form action="/researches" method="post">
		@csrf
		<fieldset>
			<legend>Información General</legend>
			<div class="form-group">
				<label for="title">Título:</label>
				<input type="text" class="form-control" id="title" name="title">
			</div>
			
			<div class="form-group">
				<label for="subject">Tema:</label>
				
				<input 
					type="text" 
					class="form-control rpm-api-search-slug-cloud" 
					rpm-api="{{ url('api/subjects') }}" 
					rpm-api-list="subject-list"
					rpm-api-input="subject"
					rpm-api-cloud="subject-cloud">

				<ul id="subject-list" class="rpm-api-list"></ul>
			</div>

			<div id="subject-cloud" class="form-group rpm-api-cloud"></div>

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