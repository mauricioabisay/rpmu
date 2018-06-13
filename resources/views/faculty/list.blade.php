@extends('layouts.main')

@section('content')
	<a href="/faculties/create" class="btn btn-info rpm-create-new">Nueva Facultad</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Facultad</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $faculties as $faculty )
				<tr>
					<td>{{ $faculty->title }}</td>
					<td class="rpm-row-options">
						<a class="btn btn-info" href="/faculties/{{ $faculty->slug }}/edit"><span class="octicon octicon-pencil"></span></a>
						<form action="/faculties/{{ $faculty->slug }}" method="post">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger"><span class="octicon octicon-trashcan"></span></button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection