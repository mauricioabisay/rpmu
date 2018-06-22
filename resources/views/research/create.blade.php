@extends('layouts.main')
@section('content')
	
<form action="/researches" method="post">
	@csrf
	
	<ul class="nav nav-tabs" id="rpm-research-tab" role="tablist">
		<li class="nav-item">
			<a href="#general-info" class="nav-link active" id="general-info-tab" data-toggle="tab">Información General</a>
		</li>
		<li class="nav-item">
			<a href="#requirements" class="nav-link" id="requirements-tab" data-toggle="tab">Requisitos</a>
		</li>
		<li class="nav-item">
			<a href="#goals" class="nav-link" id="goals-tab" data-toggle="tab">Metas</a>
		</li>
		<li class="nav-item">
			<a href="#participants" class="nav-link" id="participants-tab" data-toggle="tab">Participantes</a>
		</li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane fade show active" id="general-info" role="tabpanel">
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
						placeholder="Buscar tema..."  
						class="form-control rpm-api-search-slug-cloud" 
						rpm-api="{{ url('api/subjects') }}" 
						rpm-api-list="subject-list"
						rpm-api-result-id="slug"
						rpm-api-result-human="title"
						rpm-api-input="subject"
						rpm-api-cloud="subject-cloud">

					<ul id="subject-list" class="rpm-api-list"></ul>
				</div>

				<div id="subject-cloud" class="form-group rpm-api-cloud"></div>

				<div class="form-group">
					<label for="abstract">Síntesis:</label>
					<textarea name="abstract" id="abstract" cols="30" rows="3" class="form-control" placeholder="Descripción breve del proyecto"></textarea>
				</div>
			</fieldset>
		</div>
		<div class="tab-pane fade" id="requirements">
			<fieldset>
				<legend>Requisitos y Equipamiento</legend>
				<div class="form-inline rpm-dynamic-list-item">
					<input type="hidden" class="delete" name="requirement_delete[]" value="-1">
					<input type="hidden" class="id" name="requirement_id[]" value="-1">
					<div class="form-group col-md-4">
						<input type="text" class="form-control" name="requirement_title[]" placeholder="Título">
					</div>
					<div class="form-group col-md-6">
						<textarea name="requirement_description[]" class="form-control" cols="30" rows="3" placeholder="Descripción"></textarea>
					</div>
					<div class="form-group col-md-1">
						<input class="btn btn-primary plus" type="button" value="+">
					</div>
				</div>
			</fieldset>
		</div>
		<div class="tab-pane fade" id="goals">
			<fieldset>
				<legend>Metas</legend>
				<div class="form-inline rpm-dynamic-list-item" rpm-dynamic-list-prefix="goal">
					<input class="delete" type="hidden" name="goal_delete[]" value="-1">
					<input class="id" type="hidden" name="goal_id[]" value="-1">
					<div class="form-group col-md-4">
						<input type="text" class="form-control" name="goal_title[]" placeholder="Título">
					</div>
					<div class="form-group col-md-6">
						<textarea name="goal_description[]" class="form-control" cols="30" rows="3" placeholder="Descripción"></textarea>
					</div>
					<div class="form-group col-md-1">
						<input class="btn btn-primary plus" type="button" value="+">
					</div>
				</div>
			</fieldset>
		</div>
		<div class="tab-pane fade" id="participants">
			<fieldset>
				<legend>Investigadores</legend>
				<div class="form-group">
					<input 
						type="text" 
						placeholder="ID/Nombre"  
						class="form-control rpm-api-search-slug-cloud" 
						rpm-api="{{ url('api/participants') }}" 
						rpm-api-list="researchers-list"
						rpm-api-result-id="id" 
						rpm-api-result-human="name"
						rpm-api-input="researchers"
						rpm-api-cloud="researchers-cloud">

					<ul id="researchers-list" class="rpm-api-list"></ul>
				</div>
				
				<div id="researchers-cloud" class="form-group rpm-api-cloud"></div>
			</fieldset>
			<fieldset>
				<legend>Estudiantes</legend>
				<div class="form-group">
					<input 
						type="text" 
						placeholder="ID/Nombre"  
						class="form-control rpm-api-search-slug-cloud" 
						rpm-api="{{ url('api/participants') }}" 
						rpm-api-list="participants-list"
						rpm-api-result-id="id" 
						rpm-api-result-human="name"
						rpm-api-input="participants"
						rpm-api-cloud="participants-cloud">

					<ul id="participants-list" class="rpm-api-list"></ul>
				</div>
				
				<div id="participants-cloud" class="form-group rpm-api-cloud"></div>
			</fieldset>
		</div>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" value="Guardar">
	</div>
</form>

@endsection