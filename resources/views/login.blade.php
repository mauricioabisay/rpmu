@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col login-form">
			<p>Para acceder a esta sección necesitas ser registrado por el administrador con tu cuenta de correo institucional o una cuenta Gmail personal.</p>
			<p>Da clic para continuar.</p>
			<div id="g-custom-btn" class="btn g-btn">Sign in with Gmail</div>
			<form id="login" action="/admin" method="post">
				@csrf
				<input type="hidden" name="token" id="token">
			</form>
		</div>
	</div>
@endsection