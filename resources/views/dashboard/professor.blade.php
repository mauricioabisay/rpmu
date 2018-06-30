@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col">
		<p>Bienvenido Profesor {{ Auth::user()->name }}</p>
	</div>
</div>

<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Avance de mis Investigaciones</h5>
                <canvas id="rpm-researches-by-status"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Objetivos de Investigaciones</h5>
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
                    backgroundColor: ['#aaa', '#afa', '#faa'],
                    data: [2,1,0]
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
                labels: ['Investigacion 1', 'Investigacion 2', 'Investigacion 3', 'Investigacion 4'],
                datasets: [
                    {
                        label: 'Pendientes',
                        data: [5,3,2,4],
                        backgroundColor: '#aaa'
                    },
                    {
                        label: 'Cumplidos',
                        data: [1,7,1,10],
                        backgroundColor: '#afa'
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