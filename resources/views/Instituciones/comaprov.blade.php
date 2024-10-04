@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
    <div class="col-lg-4 grid-margin">
        <div>
            <div class="card">
                <div class="card-body" style="padding-bottom:2px;">
                    <h5 class="">Detalle Unidad de negocio</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">Codigo: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $unidades->uneg_id }}</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">Unidad de Negocio: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $unidades->uneg_name }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div>
            <div class="card">
                <div class="card-body" style="padding-bottom:2px;">
                    <h5 class="">Detalle Pedido</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">N° de pedido: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $pedidos->ins_id }}</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">Detalle: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $pedidos->ins_nombre }}</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">Fecha Solicitud: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $pedidos->fecha_soli }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div>
            <div class="card">
                <div class="card-body" style="padding-bottom:2px;">
                    <h5 class="">Confirmacion atencion de pedido</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a class="btn btn-success font-weight-small auth-form-btn btn-sm" onclick="confirmaten()" style="color:white">Aprobar</a>
                                    <a class="btn btn-success font-weight-small auth-form-btn btn-sm" onclick="confirmrecha()" style="color:white">Rechazar</a>
                                    <a class="btn btn-primary font-weight-medium auth-form-btn btn-sm" onclick="volver()" style="color:white">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 grid-margin">
        <div>
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Lista de Productos</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Descripción</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($listprods as $detail)
                        <tr>
                            <td class="text-center">{{$detail->ins_cod}}</td>
                            <td class="text-center">{{$detail->ins_desc}}</td>
                            <td class="text-center">{{$detail->ins_cant}}</td>
                            @switch(true)
                                @case($detail->ins_state_ate == 0)
                                    <td class="text-center">
                                        <div class="badge badge-outline-primary">En curso</div>
                                    </td>
                                    @break

                                @case($detail->ins_state_ate == 1)
                                    <td class="text-center">
                                        <div class="badge badge-outline-success">Aprovado</div>
                                    </td>
                                    @break
                                @case($detail->ins_state_ate == 2)
                                    <td class="text-center">
                                        <div class="badge badge-outline-danger">Rechazado</div>
                                    </td>
                                    @break
                            @endswitch
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm update-modal" id="br" href="#" data-id="{{ $detail->detins_id }}" data-state="{{ $detail->ins_state_ate }}" data-name="{{ $detail->ins_cod }}" data-description="{{ $detail->ins_desc }}" data-cantidad="{{ $detail->ins_cant }}" data-idpedido="{{ $detail->ins_ped }}" data-toggle="modal" data-target="#exampleModal-3" ><i class="mdi mdi-border-color white" ></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table><br>
                    <div class="pagination d-flex flex-wrap justify-content-center">{{ $listprods->links() }}</div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
	      			<div class="col-md-6">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>N° Pedido:</label>
			                <input id="modal-numped" type="numeric" name="numped" class="form-control" placeholder="Ingrese nombre" disabled/>
			              </div>
			            </div>
		            </div>
                    <div class="col-md-6">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>Codigo de producto:</label>
			                <input id="modal-nameC" type="text" name="codigo" class="form-control" placeholder="Ingrese nombre" disabled/>
			              </div>
			            </div>
		            </div>
	      		</div>
	      		<div class="row">
	      			<div class="col-md-12">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>Descripción:</label>
			                <input id="modal-descriptionC" type="text" name="description" class="form-control" placeholder="Ingrese descripción" disabled/>
			              </div>
			            </div>
		            </div>
	      		</div>
                <div class="row">
	      			<div class="col-md-12">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>Cantidad:</label>
			                <input id="modal-cantidad" type="text" name="cantidad" class="form-control" placeholder="Ingrese descripción"/>
			              </div>
			            </div>
		            </div>
	      		</div>
                  <div class="row">
	      			<div class="col-md-12">
			            <div class="form-group row">
			              <div class="col-sm-12">
			                <label for=""><a style="color: red">*</a>Estado:</label>
			                <select id="modal-estado" name="estado" class="form-control">
                                <option value="0">En curso</option>
                                <option value="1">Aprobado</option>
                                <option value="2">Rechazado</option>
                            </select>
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
    var codigo_uidad = {{ $unidades->uneg_id}};
    var codigo_pedido = {{ $pedidos->ins_id}};
    //console.log(codigo_uidad);
    //console.log(codigo_pedido);
    
    function confirmaten(){
        var obj={
            idped:codigo_pedido
        };
        axios.put('/ComInsti/confirm/', obj)
            .then(function (response) {
                //console.log('ok');
                $.toast({
                    heading: 'Operación exitosa!',
                    text: 'Se agrego el registro correctamente.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })
                //console.log(response.data);
                window.location.href="/ComInsti/"+codigo_uidad;
                //location.reload();
            })
            .catch(function (error){
                $.toast({
                    heading: 'Alerta!',
                    text: 'Algo salio mal en la confirmacion.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })
            });
    }
    function confirmrecha(){
        var obj={
            idped:codigo_pedido
        };
        axios.put('/ComInsti/confirmre/', obj)
            .then(function (response) {
                //console.log('ok');
                $.toast({
                    heading: 'Operación exitosa!',
                    text: 'Se agrego el registro correctamente.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })
                //console.log(response.data);
                window.location.href="/ComInsti/"+codigo_uidad;
                //location.reload();
            })
            .catch(function (error){
                $.toast({
                    heading: 'Alerta!',
                    text: 'Algo salio mal en la confirmacion.',
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })
            });
    }
    function volver() {
        window.location.href="/AdminInsti/"+codigo_uidad;
    }
    $('.update-modal').click(function() {
        var estado = $(this).data('state'); 
        let action;
        if(estado == 1 ||estado == 0||estado == 2){
            action = "{{ url('/AdminInsti/Actualizar') }}/" + $(this).data('id')+"/"+$(this).data('idpedido');
            $('#tituloE-modal').text('Actualizar Producto');
            $('#modal-numped').val($(this).data('idpedido'));
            $('#modal-nameC').val($(this).data('name'));
            $('#modal-descriptionC').val($(this).data('description'));
            $('#modal-cantidad').val($(this).data('cantidad'));
            $('#modal-estado').val($(this).data('state'));
            $('#boton-modalE').text('Actualizar');
            $('#boton-modalE').attr('class','btn btn-primary');
            //console.log('desactivar');
        }
        $("#form-update").attr("action", action);
        $('#modal-delete').modal('show');
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