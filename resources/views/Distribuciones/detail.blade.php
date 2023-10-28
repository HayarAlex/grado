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
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $pedidos->dis_id }}</span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small">Detalle: <span class=" font-weight-normal"></span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $pedidos->dis_nombre }}</span></p>
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
                    <h5 class="">Confirmacion de pedido</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <a class="btn btn-success font-weight-small auth-form-btn btn-sm" onclick="confirmped()" style="color:white">Confirmar</a>
                                    <a class="btn btn-danger font-weight-medium auth-form-btn btn-sm" onclick="senddet()" style="color:white">cancelar</a>
                                    <a class="btn btn-primary font-weight-medium auth-form-btn btn-sm" onclick="senddet()" style="color:white">Volver</a>
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
                <div class="card-body" style="padding-bottom:2px;">
                    <h5 class="">Agregar productos</h5>
                    <form action="" enctype="multipart/from-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for=""><a style="color: red">*</a>Seleccionar producto:</label>
                                        <select id="prod" name="prod" class="js-example-basic-single w-100">
                                            <option value="0">Seleccione un producto</option>
                                            @foreach($productos as $prod)
                                                <option value="{{ $prod->prod_cod}}">{{ $prod->prod_desc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for=""><a style="color: red">*</a>Cantidad:</label>
                                        <input id="pat" type="text" name="description" class="form-control" placeholder="Ingrese cantidad"/>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <a class="btn btn-primary font-weight-medium auth-form-btn" onclick="senddet()" style="color:white">Agregar</a>
                            </div>
                        </form>
                </div>
            </div>
        </div><br>
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
                            <td class="text-center">{{$detail->det_cod}}</td>
                            <td class="text-center">{{$detail->det_desc}}</td>
                            <td class="text-center">{{$detail->det_cant}}</td>
                            @if($detail->det_state_ate == 0)
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-warning delete-modal btn-sm "><i class="mdi mdi-bell white" ></i></a>
                            </td>
                            @else
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-success delete-modal btn-sm "><i class="mdi mdi-bell-ring white" ></i></a>
                            </td>
                            @endif
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-primary update-modal btn-sm "><i class="mdi mdi-border-color white" ></i></a>
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
    var codigo_pedido = {{ $pedidos->dis_id}};
    //console.log(codigo_uidad);
    //console.log(codigo_pedido);
    function senddet() {
        var codigo = document.getElementById("prod").value;
        var combo = document.getElementById("prod");
        var selected = combo.options[combo.selectedIndex].text;
        var num = document.getElementById("pat").value;
        var cant = parseInt(num);
        var ogfbj ={
            uneg:codigo_uidad,
            pedi:codigo_pedido,
            cod:codigo,
            des:selected,
            can:cant
        };
        axios.post('/Distribucion/savedet/', ogfbj)
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
                location.reload();
            })
            .catch(function (error){
                $.toast({
                    heading: 'Operación exitosa!',
                    text: 'Se agrego el registro correctamente.',
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'bottom-right'
                })
            });
    }
    function confirmped(){
        var obj={
            idped:codigo_pedido
        };
        axios.put('/Distribucion/confirm/', obj)
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
                console.log(response.data);
                window.location.href="/Distribucion/"+codigo_uidad;
                //location.reload();
            })
            .catch(function (error){
                $.toast({
                    heading: 'Operación exitosa!',
                    text: 'Se agrego el registro correctamente.',
                    showHideTransition: 'slide',
                    icon: 'success',
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