@extends('layouts.main')

@section('content')
	<a href="/users/create" class="btn btn-info rpm-create-new">Nuevo Usuario</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Email</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $users as $user )
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td class="rpm-row-options">
						<a class="btn btn-info" href="/users/{{ $user->id }}/edit"><span class="octicon octicon-pencil"></span></a>
						<form action="/users/{{ $user->id }}" method="post">
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