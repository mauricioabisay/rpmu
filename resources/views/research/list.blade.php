@extends('layouts.main')
@section('content')
	<a href="{{ action('ResearchController@create') }}" class="btn btn-info rpm-create-new">Nueva Investigación</a>
	<table class="table table-striped rpm-research-table">
		<thead>
			<tr>
				<th>Título</th>
				<th>Líder</th>
				<th>Estado</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $researches as $research )
				<tr>
					<td>{{ $research->title }}</td>
					<td>{{ $research->leader()->first()->name }} ({{ $research->leader()->first()->user->email }})</td>
					<td>{{ $research->status }}</td>
					<td class="rpm-row-options">
						@can('update', $research)
							<a class="btn btn-info" href="{{ action('ResearchController@edit', ['id' => $research->id]) }}">
								<span class="octicon octicon-pencil"></span>
							</a>
						@endcan
						@can('delete', $research)
							<form action="{{ action('ResearchController@destroy', ['id' => $research->id]) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger">
									<span class="octicon octicon-trashcan"></span>
								</button>
							</form>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection