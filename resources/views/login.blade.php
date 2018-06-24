@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col">
			<div id="g-custom-btn" class="btn btn-primary">Gmail Sigin</div>
			<form id="login" action="/admin" method="post">
				@csrf
				<input type="hidden" name="token" id="token">
			</form>
		</div>
	</div>
@endsection