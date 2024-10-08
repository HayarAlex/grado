@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-10 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h4 class="card-title">Reportes</h4>
                    <p class="text-muted font-weight-bold">
                        {{ $ini }} hasta el {{$fin}}
                    </p>
                    <a href="{{ url('/reporte/pdf/' . $ini . '/' . $fin) }}" class="btn btn-danger">Exportar a PDF</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th class="text-center">Lote</th>
                            <th class="text-center">Paso en curso</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Fecha inicio</th>
                            <th class="text-center">Fecha fin</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-procesos">
                        @foreach($list as $li)
                            <tr>
                            <td class="text-center">{{ $li->flw_order }}</td>
                            <td class="text-center">{{ $li->paso_en_curso }}</td>
                            <td class="text-center">{{ $li->estado }}</td>
                            <td class="text-center">{{ $li->fecha_creacion }}</td>
                            <td class="text-center">{{ $li->fecha_actualizacion }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table><br>
                        <div class="pagination d-flex flex-wrap justify-content-center"></div>
                    </div>
	    	</div>
	  	</div>
	</div>
</div>
@endsection
@section('script')
<script>
    
    
    
    // alert('hola');
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