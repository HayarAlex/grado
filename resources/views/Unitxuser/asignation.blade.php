@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-4 grid-margin">
      <div class="card">
          <div class="card-body" style="padding-bottom:2px;">
              <h5 class="">Asignacion de unidades de negocio</h5>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Id: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $usuarios->id }}</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Nombre: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $usuarios->name }} {{ $usuarios->paternal }} {{ $usuarios->maternal }}</span></p>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
    <div class="col-lg-5 grid-margin">
        
        <div>
            <div class="card">
                <div class="card-body" style="padding-bottom:2px;">
                    <h5 class="">Agregar unidades de negocio</h5>
                    <form action="" enctype="multipart/from-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for=""><a style="color: red">*</a>Seleccionar unidad:</label>
                                        <select id="prod" name="prod" class="js-example-basic-single w-100">
                                            <option value="0">Seleccione unidad</option>
                                            @foreach($unidades as $uni)
                                                <option value="{{ $uni->uneg_id}}">{{ $uni->uneg_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <br>
                                            <a style="margin-top:15px" class="btn btn-success btn-sm font-weight-medium auth-form-btn" onclick="sendprod()" style="color:white"><i class="mdi mdi-plus" style="color:white"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div><br>
        <div>
            <div class="card">
                <div class="card-body" style="padding-bottom:2px;">
                <h5 class="">Unidades asignadas</h5>
                <p class="card-description">
                    Lista de unidades
                </p>
                <div class="table-responsive">
                    <table class="table">
                    <thead>
                        <tr>
                        <th class="text-center"><p class="text-muted font-weight-bold text-small">Id</p></th>
                        <th class="text-center"><p class="text-muted font-weight-bold text-small">Unidad de negocio</p></th>
                        <th class="text-center"><p class="text-muted font-weight-bold text-small">Acciones</p></th>
                        </tr>
                    </thead>
                    <tbody id="tabla-procesos">
                    @foreach($asignations as $asi)
                        <tr>
                        <td class="text-center">{{ $asi->usu_id }}</td>
                        <td class="text-center">{{ $asi->usu_name }}</td>
                        <td class="text-center">
                            <center><a style="color:#403969" href="javascript:void(0);"  onclick="eliRegistro('{{ $asi->usu_id }}')"><i class="mdi mdi-close-circle"></i></a></center>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table><br>
                    <div class="pagination d-flex flex-wrap justify-content-center">{{ $asignations->links() }}</div>
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
    $(document).ready(function(){
      $('#btn-create').on('click', function(){
        storealm();
      });
      $('#btn-asignation').on('click', function(){
        storealm();
      });
    });
    function eliRegistro(id) {
        axios.delete(`/Config/asignacion/elimiuneg/${id}`)
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
    function sendprod() {
        var codigo_linea = {{ $usuarios->id}};
        var codigo = document.getElementById("prod").value;
        var combo = document.getElementById("prod");
        var selected = combo.options[combo.selectedIndex].text;
        var obj ={
            usuario:codigo_linea,
            cod:codigo,
            des:selected
        };
        //console.log(obj);
        axios.post('/Config/asignacion/save', obj)
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
                setTimeout(function() {
                    location.reload();
                }, 3000);
            })
            .catch(function (error){
                $.toast({
                    heading: 'Alerta!',
                    text: 'Algo salio mal en el registro.',
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