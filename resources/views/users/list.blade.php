@extends('layouts.main')

@section('content')
	@can('create', App\User::class)
		<a href="{{ action( 'UserController@create' ) }}" class="btn btn-info rpm-create-new">Nuevo Usuario</a>
	@endcan
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
					<td>{{ ($user->participant) ? $user->participant->name : '' }}</td>
					<td>{{ $user->email }}</td>
					<td class="rpm-row-options">
						@can('update', $user)
							<a class="btn btn-info" href="{{ action( 'UserController@edit',['id' => $user->id] ) }}"><span class="octicon octicon-pencil"></span></a>
						@endcan
						@can('delete', $user)
							<form action="{{ action( 'UserController@destroy',['id' => $user->id] ) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger"><span class="octicon octicon-trashcan"></span></button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection