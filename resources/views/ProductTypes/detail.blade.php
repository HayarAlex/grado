@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-4 grid-margin">
      <div class="card">
          <div class="card-body" style="padding-bottom:2px;">
              <h5 class="">Detalle Linea de produccion</h5>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Codigo: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $tipos->product_type_id }}</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Forma farmaceutica: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $tipos->description }}</span></p>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
      <br>
      <div class="card">
	    <div class="card-body" style="padding-bottom:2px;">
	      <h5 class="">Lista de procesos</h5>
	      <p class="card-description">
	        Procesos
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center"><p class="text-muted font-weight-bold text-small">Orden</p></th>
	              <th class="text-center"><p class="text-muted font-weight-bold text-small">Alm Origen</p></th>
	              <th class="text-center"><p class="text-muted font-weight-bold text-small">Alm Destino</p></th>
	              <th class="text-center"><p class="text-muted font-weight-bold text-small">Acciones</p></th>
	            </tr>
	          </thead>
	          <tbody id="tabla-procesos">
              @foreach($procesos as $pro)
	            <tr>
	              <td class="text-center">{{ $pro->tipd_orden }}</td>
	              <td class="text-center">{{ $pro->tipd_almorigen }}</td>
                  <td class="text-center">{{ $pro->tipd_almdestino }}</td>
	              <td class="text-center">
                    <center><a style="color:#403969" href="javascript:void(0);"  onclick="eliminarRegistro('{{ $pro->tipd_id }}')"><i class="mdi mdi-close-circle"></i></a></center>
	              </td>
	            </tr>
	            @endforeach
	          </tbody>
	        </table><br>
	        <div class="pagination d-flex flex-wrap justify-content-center">{{ $procesos->links() }}</div>
	      </div>
	    </div>
	  </div>
  </div>
    <div class="col-lg-5 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h5 class="card-title">Agregar Plantilla</h5><br>
	      		<form>
	      			
		      		<div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Orden del proceso:</label>
                                <input id="orden" type="number" name="orden" class="form-control" placeholder="Orden de Tarea"/>
				              </div>
				            </div>
			            </div>
		      		</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Actividad:</label>
                                <select id="acti" name="acti" class="sel1 js-example-basic-single w-100">
                                    <option value="0">Seleccione una actividad</option>
                                    @foreach($actividades as $acti)
                                        <option value="{{ $acti->team_id}}">{{ $acti->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Tarea:</label>
                                <select id="tar" name="tar" class="sel3 js-example-basic-single w-100">
                                  <option value="0">Selecione una tarea</option>
                                    @foreach($tareas as $tarea)
                                        <option value="{{ $tarea->promotion_id}}">{{ $tarea->description }}</option>
                                    @endforeach
                              </select>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Almacen origen:</label>
                                <select id="almo" name="almo" class="sel4 js-example-basic-single w-100">
                                    <option value="0">Seleccione un almacen</option>
                                    @foreach($almacenes as $alm)
                                        <option value="{{ $alm->alm_id}}">{{ $alm->alm_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <div class="col-sm-12">
                                <label for=""><a style="color: red">*</a>Almacen destino:</label>
                                <select id="almd" name="almd" class="sel5 js-example-basic-single w-100">
                                    <option value="0">Seleccione un almacen</option>
                                    @foreach($almacenes as $alm)
                                        <option value="{{ $alm->alm_id}}">{{ $alm->alm_nombre }}</option>
                                    @endforeach
                                </select>
                              </select>
                            </div>
                            </div>
                        </div>
                    </div>
		      		<div style="text-align: right;">
		              <button id="btn-create" type="button" class="btn btn-primary mr-2" >Generar</button>
		              <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('productType.index') }}">Cancelar</a>
		            </div>
	      		</form>
	    	</div>
	  	</div>
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
    $(document).ready(function(){
      //var valor = {{ $tipos->product_type_id }};
      $('#btn-create').on('click', function(){
        storealm();
      });
    });
    function eliminarRegistro(id) {
        axios.delete(`/Tipo-de-producto/elimiprocs/${id}`)
            .then(function(response) {
                $.toast({
                    heading: 'Operación exitosa!',
                    text: response.data.message,
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                });
                setTimeout(function() {
                    location.reload();
                }, 3000);
            })
            .catch(function(error) {
                console.error('Error al eliminar el registro:', error);
                $.toast({
                    heading: 'Error',
                    text: 'No se pudo eliminar el registro.',
                    showHideTransition: 'fade',
                    icon: 'error',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                });
            });
    }
    function storealm() {
        var linea = {{ $tipos->product_type_id }};
        var norde = document.getElementById('orden').value;
        var act = document.getElementById('acti').value;
        var tare = document.getElementById('tar').value;
        var aori = document.getElementById('almo').value;
        var ades = document.getElementById('almd').value;
        var sel = document.getElementById('acti');
        var dac = sel.options[sel.selectedIndex].text;
        var selt = document.getElementById('tar');
        var dta = selt.options[selt.selectedIndex].text;
        var selo = document.getElementById('almo');
        var dor = selo.options[selo.selectedIndex].text;
        var seld = document.getElementById('almd');
        var dde = seld.options[seld.selectedIndex].text;
        var obj ={
            linea:linea,
            orden:norde,
            activi:act,
            dacti:dac,
            tarea:tare,
            dtare:dta,
            almo:aori,
            dalmo:dor,
            almd:ades,
            dalmd:dde
        };
        //console.log(obj);
        axios.post('/Tipo-de-producto/add-etapa',obj)
            .then(function (response){
                //console.log(response.data);
                $.toast({
                        heading: 'Operación exitosa!',
                        text: 'Se agrego el registro correctamente.',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'bottom-right'
                    })
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
            })
            .catch(function (error){
                $.toast({
                    heading: 'Alerta!',
                    text: 'Algo salio mal.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })

            });
    }
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