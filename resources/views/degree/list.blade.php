@extends('layouts.main')

@section('content')
	<a href="{{ action('DegreeController@create') }}" class="btn btn-info rpm-create-new">Nueva Licenciatura</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Licenciatura</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $degrees as $degree )
				<tr>
					<td>{{ $degree->title }}</td>
					<td class="rpm-row-options">
						<a class="btn btn-info" href="{{ action('DegreeController@edit', ['id'=>$degree->slug]) }}"><span class="octicon octicon-pencil"></span></a>
						<form action="{{ action('DegreeController@destroy', ['id'=>$degree->slug]) }}" method="post">
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