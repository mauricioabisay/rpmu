@extends('public.main')

@section('content')
<div class="container">
	@include('public.list-researches')
	<div class="row rpm-pagination">
		<div class="col">
			{{ $researches->links() }}
		</div>
	</div>
</div>
@endsection