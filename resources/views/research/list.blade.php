@extends('layouts.main')
@section('content')
	<a href="/researches/create" class="btn btn-info rpm-create-new">Nueva Investigación</a>
	<table class="table table-striped rpm-research-table">
		<thead>
			<tr>
				<th>Título</th>
				<th>Estado</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $researches as $research )
				<tr>
					<td>{{ $research->title }}</td>
					<td>{{ $research->status }}</td>
					<td class="rpm-row-options">
						<a class="btn btn-info" href="/researches/{{ $research->id }}/edit">
							<span class="octicon octicon-pencil"></span>
						</a>
						<form action="/researches/{{ $research->id }}/delete" method="post">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger">
								<span class="octicon octicon-trashcan"></span>
							</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection