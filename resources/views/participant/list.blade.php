@extends('layouts.main')

@section('content')
	<a href="{{ action('ParticipantController@create') }}" class="btn btn-info rpm-create-new">Nuevo Participante</a>
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
					<td>{{ ($participant->user_id > 0) ? strtoupper($participant->user->role) : $participant->degree->title }}</td>
					<td class="rpm-row-options">
						@if ( $participant->user_id > 0 )
							<a class="btn btn-info" href="{{ action( 'UserController@edit', ['id' => $participant->user->id] ) }}"><span class="octicon octicon-pencil"></span></a>
							<form action="{{ action( 'UserController@destroy', ['id' => $participant->user->id]) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger"><span class="octicon octicon-trashcan"></span></button>
							</form>
						@else
							<a class="btn btn-info" href="{{ action( 'ParticipantController@edit', ['id' => $participant->id]) }}/edit"><span class="octicon octicon-pencil"></span></a>
							<form action="{{ action( 'ParticipantController@destroy', ['id' => $participant->id]) }}" method="post">
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