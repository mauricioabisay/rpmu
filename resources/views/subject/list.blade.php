@extends('layouts.main')

@section('content')
	<a href="{{ action( 'SubjectController@create' ) }}" class="btn btn-info rpm-create-new">Nuevo Tema</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Tema</th>
				<th class="rpm-row-options">Opc.</th>
			</tr>
		</thead>
		<tbody>
			@foreach ( $subjects as $subject )
				<tr>
					<td>{{ $subject->title }}</td>
					<td class="rpm-row-options">
						<a class="btn btn-info" href="{{ action( 'SubjectController@edit', ['id' => $subject->slug]) }}"><span class="octicon octicon-pencil"></span></a>
						<form action="{{ action( 'SubjectController@destroy', ['id' => $subject->slug]) }}" method="post">
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