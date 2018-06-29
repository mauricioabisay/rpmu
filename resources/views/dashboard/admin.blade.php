@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col">
		<p>Bienvenido Administrador {{ Auth::user()->name }}</p>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Avance de Investigaciones</h5>
				<canvas id="rpm-researches-by-status"></canvas>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-lg-6">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Investigaciones por facultades</h5>
				<canvas id="rpm-researches-by-faculty"></canvas>
			</div>
		</div>
	</div>	
</div>

<script type="text/javascript">
	new Chart(
		document.getElementById('rpm-researches-by-status').getContext('2d'),
		{
			type: 'pie',
			data: {
				labels: ['Creadas', 'En desarrollo', 'Terminadas'],
				datasets: [{
					label: 'Dataset',
					backgroundColor: ['#ddd', '#dfd', '#fdd'],
					data: [5,7,4]
				}]
			},
			options: {
				legend: {
					position: 'right'
				}
			}
		}
	);
	new Chart(
		document.getElementById('rpm-researches-by-faculty').getContext('2d'),
		{
			type: 'bar',
			data: {
				labels: ['Ing.Sw', 'Ing.Sist.', 'Ing.Datos', 'Ing.Civil'],
				datasets: [
					{
						label: 'Creadas',
						data: [5,3,4,2],
						backgroundColor: '#ddd'
					},
					{
						label: 'En desarrollo',
						data: [1,0,1,0],
						backgroundColor: '#dfd'
					},
					{
						label: 'Terminadas',
						data: [3,2,2,1],
						backgroundColor: '#fdd'
					}
				]
			},
			options: {
				legend: {
					position: 'right'
				},
				scales: {
					xAxes: [{stacked: true}],
					yAxes: [{stacked: true}]
				},
				responsive: true,
			}
		}
	);
</script>

@endsection