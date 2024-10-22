@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-7 grid-margin">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Seguimiento de etapas de produccion</h4>
	      <p class="card-description">
	        Lista de seguimiento y supervision
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center">ID</th>
	              <th class="text-center">Lote</th>
                  <th class="text-center">Etapa</th>
	              <th class="text-center">Descripcion</th>
	              <th class="text-center">Acciones</th>
	            </tr>
	          </thead>
            <tbody>
            @foreach($ordenes as $order)
	            <tr>
	              <td class="text-center">{{ $order->flw_id }}</td>
	              <td class="text-center">{{ $order->flw_order }}</td>
                <td class="text-center">{{ $order->flw_step }}</td>
				<td class="text-center">{{ $order->flw_stepdesc }}</td>
	            <td class="text-center"><center><a class="text-center" style="color:#403969" href="{{ url('/Seguimiento-produccion/'.$order->flw_id) }}"><i class="mdi mdi-arrow-right-bold-circle"></i></a></center></td>
	            </tr>
            @endforeach
            </tbody>
	        </table><br>
			<div class="pagination d-flex flex-wrap justify-content-center">{{ $ordenes->links() }}</div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-lg-10 grid-margin stretch-card">
		<div class="card">
		<div class="card-body">
			<h4 class="card-title">Avance por lote</h4>
			<canvas id="followChart"></canvas>
		</div>
		</div>
	</div>
	<div>
		<canvas id="myChart" width="400" height="200"></canvas>
	</div>
</div>

@endsection
@section('script')
<script src="../../../../js/off-canvas.js"></script>
<script src="../../../../js/hoverable-collapse.js"></script>
<script src="../../../../js/template.js"></script>
<script src="../../../../js/settings.js"></script>
<script src="../../../../js/todolist.js"></script>
<script src="../../../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
<script src="../../../../vendors/select2/select2.min.js"></script>
<script src="../../../../js/file-upload.js"></script>
<script src="../../../../js/typeahead.js"></script>
<script src="../../../../js/select2.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('followChart').getContext('2d');

    // Obtén las fechas directamente
    const originalDates = {!! $dates !!}; // Fechas originales

    // Formatear las fechas para que solo contengan el día
    const labels = originalDates.map(date => date.split('T')[0]); // Si las fechas están en formato ISO

    const datasets = [];
    const chartData = {!! $chartData !!}; // Pasos para cada lote

    // Alinear los datos con las fechas
    for (const lote in chartData) {
        if (chartData.hasOwnProperty(lote) && Array.isArray(chartData[lote])) {
            // Crear un arreglo de pasos inicializado en 0 para cada fecha
            const steps = labels.map(label => {
                const entry = chartData[lote].find(entry => entry.date === label);
                return entry ? entry.step : 0; // Usar 0 si no hay datos para esa fecha
            });

            // Generar colores aleatorios para cada lote
            const borderColor = `#${Math.floor(Math.random() * 16777215).toString(16)}`;

            datasets.push({
                label: `Lote ${lote}`,
                data: steps,
                borderColor: borderColor, // Color del borde
                fill: false,
            });
        }
    }

    const followChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Paso'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Fecha'
                    }
                }
            }
        }
    });
});


</script>
@endsection

<style>
    #br{
        border: none;
    }
    .white{
        color: white;
    }
    #pat{
    	padding-top: 10px;
    }
</style>