@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-7 grid-margin">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Linea de produccion</h4>
	      <p class="card-description">
	        Formas Farmaceuticas
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center">ID</th>
	              <th class="text-center">Lote</th>
                <th class="text-center">Producto</th>
	              <th class="text-center">Estado</th>
	              <th class="text-center">Acciones</th>
	            </tr>
	          </thead>
            <tbody>
            @foreach($ordenes as $order)
	            <tr>
	              <td class="text-center">{{ $order->ord_id }}</td>
	              <td class="text-center">{{ $order->ord_lot }}</td>
                <td class="text-center">{{ $order->ord_prod }}</td>
	              	@if($order->ord_state == 1 )
	                  <td class="text-center"><label class="badge badge-success">Activo</label></td>
	                @else
	                  <td class="text-center"><label class="badge badge-danger">Inactivo</label></td>
	                @endif
	              <td style="width: 10px">
	              	 
	              </td>
	            </tr>
            @endforeach
            </tbody>
	        </table><br>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-lg-5 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h4 class="card-title">Nueva Orden de Produccion</h4><br>
	      		<form>
	      			
		      		<div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
                        <label for=""><a style="color: red">*</a>Seleccionar producto:</label>
                        <select id="prod" name="prod" class="sel1 js-example-basic-single w-100">
                            <option value="0">Seleccione un producto</option>
                            @foreach($productos as $prod)
                                <option value="{{ $prod->prod_cod}}">{{ $prod->prod_desc }}</option>
                            @endforeach
                        </select>
				                
				              </div>
				            </div>
			            </div>
                        
		      		</div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group row">
                            <div class="col-sm-12">
                              <label for=""><a style="color: red">*</a>Mes:</label>
                              <select id="mes" name="mes" class="sel2 js-example-basic-single w-100">
                                  <option value="0">Seleccione un mes</option>
                                  <option value="1">Enero</option>
                                  <option value="2">Febrero</option>
                                  <option value="3">Marzo</option>
                                  <option value="4">Abril</option>
                                  <option value="5">Mayo</option>
                                  <option value="6">Junio</option>
                                  <option value="7">Julio</option>
                                  <option value="8">Agosto</option>
                                  <option value="9">Septiembre</option>
                                  <option value="10">Octubre</option>
                                  <option value="11">Noviembre</option>
                                  <option value="12">Diciembre</option>
                              </select>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Gestion:</label>
                                <select id="ges" name="ges" class="sel3 js-example-basic-single w-100">
                                  <option value="0">Gestion</option>
                                  <option value="U">2022</option>
                                  <option value="V">2023</option>
                                  <option value="W">2024</option>
                              </select>
                            </div>
                            </div>
                        </div>
                    </div>
		      		<div style="text-align: right;">
		              <button id="btn-create" type="submit" class="btn btn-primary mr-2" >Generar</button>
		              <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('productType.index') }}">Cancelar</a>
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
    $(document).ready(function(){
      var valor = 1;
      axios.get('prom/'+valor)
        .then(function (response){
          console.log(response.data);
        })
        .then(function(){

        });
      $('#btn-create').on('click', function(){
        guardar();
      });
    });
    function guardar(){
      var codprod = document.getElementById('prod').value;
      var sel = document.getElementById('prod');
      var descri = sel.options[sel.selectedIndex].text;
      var mes = document.getElementById('mes').value;
      var gestion = document.getElementById('ges').value;
      var obj = {
        cod:codprod,
        des:descri,
        mesi:mes,
        ges:gestion
      };
      console.log(obj);
      axios.post('generate-lote',obj)
        .then(function (response){
          
        })
        .catch(function (error){

        });
    }
    
    $('.state-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('/Tipo-de-producto/desactivar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Desactivar Tipo producto');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-modal').text('Desactivar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');          
        }else{
          action = "{{ url('/Tipo-de-producto/activar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Activar Tipo producto');
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
          action = "{{ url('/Tipo-de-producto/eliminar') }}/" + $(this).data('id');
          $('#tituloP-modal').text('Eliminar Tipo producto');
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
          action = "{{ url('/Tipo-de-producto/Actualizar') }}/" + $(this).data('id');
          $('#tituloE-modal').text('Actualizar Tipo producto');
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