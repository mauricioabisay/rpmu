@extends('layouts.main')

@section('content')
	<a href="/participants/create" class="btn btn-info rpm-create-new">Nuevo Participante</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Licenciatura</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $participants as $participant )
				<tr>
					<td>{{ $participant->name }}</td>
					<td>{{ ($participant->user_id > 0) ? 'ADMIN' : $participant->degree->title }}</td>
					<td class="rpm-row-options">
						@if ( $participant->user_id > 0 )
							<a class="btn btn-info" href="/users/{{ $participant->user->id }}/edit"><span class="octicon octicon-pencil"></span></a>
							<form action="/users/{{ $participant->user->id }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger"><span class="octicon octicon-trashcan"></span></button>
							</form>
						@else
							<a class="btn btn-info" href="/participants/{{ $participant->id }}/edit"><span class="octicon octicon-pencil"></span></a>
							<form action="/participants/{{ $participant->id }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger"><span class="octicon octicon-trashcan"></span></button>
							</form>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection