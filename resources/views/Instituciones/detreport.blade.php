@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-10 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Reportes</h4>
                    <a href="{{ url('/licitareporte/excel/' . $ini . '/' . $fin. '/' . $uni) }}" class="btn btn-outline-success">Exportar a Excel</a>
                </div>
                    <p class="text-muted font-weight-bold">
                        {{ $ini }} hasta el {{$fin}}
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th class="text-center">N° Pedido</th>
                            <th class="text-center">Unidad de negocio</th>
                            <th class="text-center">Institucion</th>
                            <th class="text-center">Codigo CUCE</th>
                            <th class="text-center">Cod Prod</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Fecha solicitud</th>
                            <th class="text-center">Fecha entrega</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-procesos">
                        @foreach($list as $li)
                            <tr>
                            <td class="text-center">{{ $li->ins_id }}</td>
                            <td class="text-center">{{ $li->ins_uneg }}</td>
                            <td class="text-center">{{ $li->ins_nombre }}</td>
                            <td class="text-center">{{ $li->ins_cuce }}</td>
                            <td class="text-center">{{ $li->ins_cod }}</td>
                            <td class="text-center">{{ $li->ins_desc }}</td>
                            <td class="text-center">{{ $li->ins_cant }}</td>
                            <td class="text-center">{{ $li->fecha_soli }}</td>
                            <td class="text-center">{{ $li->fecha_entg }}</td>
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