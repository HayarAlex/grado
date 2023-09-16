@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-7 grid-margin">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Lista Deportes</h4>
	      <p class="card-description">
	        Deportes
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center">ID</th>
	              <th class="text-center">Descripción</th>
	              <th class="text-center">Estado</th>
	              <th class="text-center">Acciones</th>
	            </tr>
	          </thead>
	          <tbody>
	          	@foreach($sports as $sport)
	            <tr>
	              <td class="text-center">{{ $sport->sport_id }}</td>
	              <td class="text-center">{{ $sport->description }}</td>
	              	@if($sport->state == 1 )
	                  <td class="text-center"><label class="badge badge-success">Activo</label></td>
	                @else
	                  <td class="text-center"><label class="badge badge-danger">Inactivo</label></td>
	                @endif
	              <td style="width: 10px">
	              	 <a href="#" id="br" class="btn {{ $sport->state?'btn-danger':'btn-success' }} state-modal btn-sm " data-id="{{ $sport->sport_id }}" data-state="{{ $sport->state }}" data-toggle="modal" data-target="#exampleModal-2"><i class="mdi {{ $sport->state?'mdi-close':'mdi-check' }} white" ></i></a>
                      <a class="btn btn-primary btn-sm update-modal" id="br" href="#" data-id="{{ $sport->sport_id }}" data-state="{{ $sport->state }}" data-description="{{ $sport->description }}" data-toggle="modal" data-target="#exampleModal-3" ><i class="mdi mdi-border-color white" ></i></a>
                      <a class="btn btn-dark btn-sm delete-modal" id="br" href="#" data-id="{{ $sport->sport_id }}" data-state="{{ $sport->state }}" data-toggle="modal" data-target="#exampleModal-2"><i class="mdi mdi-delete white" ></i></a>
	              </td>
	            </tr>
	            {{-- modal acciones de camvio de estado y eliminacion --}}
				<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
				    <div class="modal-dialog" role="document">
				      <div class="modal-content">
				        <form action="" method="post" id="form-delete">
				            @csrf
				            @method('put')
				            <div class="modal-header">
				              <h5 class="modal-title" id="tituloP-modal"></h5>
				              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button>
				            </div>
				            <div class="modal-body">
				              <p id="titulo-modal"></p>
				            </div>
				            <div class="modal-footer">
				            	@if($sport->state == 1 )
				              	<button type="submit" id="boton-modal" class="not-desactivate"></button>
				              	@else
				              	<button type="submit" id="boton-modal" class="not-activate"></button>
				              	@endif
				              	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
				            </div>
				        </form>
				      </div>
				    </div>
				</div>
				{{-- end modal --}}
	            @endforeach
	          </tbody>
	        </table><br>
	        <div class="pagination d-flex flex-wrap justify-content-center">{{ $sports->links() }}</div>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-lg-5 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h4 class="card-title">Nuevo Deporte</h4><br>
	      		<form action="{{ route('sport.store')}}" method="post" enctype="multipart/from-data">
	      			@csrf
		      		<div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
				                <label for=""><a style="color: red">*</a>Descripción:</label>
				                <input id="pat" type="text" name="description" class="form-control" placeholder="Ingrese descripción"/>
				                @if($errors->has('description'))
				                  <label for="" style="color: red;">{{ $errors->first('description') }}</label>
				                @endif
				              </div>
				            </div>
			            </div>
		      		</div>
		      		<div style="text-align: right;">
		              <button type="submit" class="btn btn-primary mr-2" >Agregar</button>
		              <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('sport.index') }}">Cancelar</a>
		            </div>
	      		</form>
	    	</div>
	  	</div>
	</div>
</div>

{{-- modal editar --}}
<div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="POST" id="form-update">
            @csrf
            @method('put')
            <div class="modal-header">
              <h5 class="modal-title" id="tituloE-modal"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
	      		<div class="row">
	      			<div class="col-md-12">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>Descripción:</label>
			                <input id="modal-descriptionC" type="text" name="description" class="form-control" placeholder="Ingrese descripción"/>
			              </div>
			            </div>
		            </div>
	      		</div>
            </div>
            <div class="modal-footer">
              <button type="submit" id="boton-modalE"></button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
    </div>
</div>
{{-- end modal --}}
@endsection
@section('script')
<script>
    $('.state-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('/Deportes/desactivar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Desactivar deporte');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-modal').text('Desactivar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');          
        }else{
          action = "{{ url('/Deportes/activar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Activar deporte');
          $('#titulo-modal').text('¿Esta seguro de activar este registro?');
          console.log('activar');
          $('#boton-modal').text('Activar');
          $('#boton-modal').attr('class','btn btn-success');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
    });
    $('.delete-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1 ||estado == 0){
          action = "{{ url('/Deportes/eliminar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Eliminar deporte');
          $('#titulo-modal').text('¿Esta seguro de eliminar este registro?');
          $('#boton-modal').text('Eliminar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
    });
    $('.update-modal').click(function() {
        var estado = $(this).data('state'); 
        let action;
        if(estado == 1 ||estado == 0){
          action = "{{ url('/Deportes/Actualizar') }}/" + $(this).data('id');
          $('#tituloE-modal').text('Actualizar deporte');
          $('#modal-descriptionC').val($(this).data('description'));
          $('#boton-modalE').text('Actualizar');
          $('#boton-modalE').attr('class','btn btn-primary');
          console.log('desactivar');
        }
        $("#form-update").attr("action", action);
        $('#modal-delete').modal('show');
    });
    
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