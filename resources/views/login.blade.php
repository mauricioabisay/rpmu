@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col">
			<div class="g-signin2" data-onsuccess="onSignIn"></div>
			<form id="login" action="/admin" method="post">
				@csrf
				<input type="hidden" name="email" id="email">
				<input type="hidden" name="password" id="password">
			</form>
		</div>
	</div>
@endsection