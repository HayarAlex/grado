@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-4 grid-margin">
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
        </div><br>
      <div class="card">
          <div class="card-body" style="padding-bottom:2px;">
              <h5 class="">Nuevo registro</h5>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for=""><a style="color: red">*</a>Institucion:</label>
			                <input id="inst" type="text" name="inst" class="form-control" placeholder="Ingrese nombre"/>
                        </div>
                        <div class="col-sm-12">
                            <label for=""><a style="color: red">*</a>Codigo Cuce:</label>
			                <input id="cuce" type="text" name="cuce" class="form-control" placeholder="Ingrese nombre"/>
                        </div>
                        <div class="col-sm-12">
                            <label for=""><a style="color: red">*</a>Fecha de entrega:</label>
			                <input id="fent" type="date" name="fent" class="form-control" placeholder="Ingrese nombre"/>
                        </div>
                        <div class="col-sm-12">
                            <label for=""><a style="color: red">*</a>Observacion:</label>
			                <input id="obs" type="text" name="obs" class="form-control" placeholder="Ingrese nombre"/>
                        </div>
                        <div class="col-sm-12">
                            <a class="btn btn-primary font-weight-medium auth-form-btn" onclick="send()" style="color:white">Nuevo Pedido</a>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-8 grid-margin">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">Lista de Licitaciones</h4>
              <div class="table-responsive">
                  <table id="order-listing" class="table table-striped">
                      <thead>
                          <tr>
                              <th class="text-center">Nº Licitacion</th>
                              <th class="text-center">Descripcion</th>
                              <th class="text-center">Fecha Solicitud</th>
                              <th class="text-center">Estado Envio</th>
                              <th class="text-center">Estado Respuesta</th>
                              <th class="text-center">Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($pedidos as $ped)
                          <tr>
                            <td class="text-center">{{$ped->ins_id}}</td>
                            <td class="text-center">{{$ped->ins_nombre}}</td>
                            <td class="text-center">{{$ped->fecha_entg}}</td>
                            @if($ped->ins_state_env == 0)
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-warning delete-modal btn-sm "><i class="mdi mdi-send white" ></i></a>
                            </td>
                            @else
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-success delete-modal btn-sm "><i class="mdi mdi-send white" ></i></a>
                            </td>
                            @endif
                            @if($ped->ins_state_ate == 0)
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-warning delete-modal btn-sm "><i class="mdi mdi-bell white" ></i></a>
                            </td>
                            @else
                            <td class="text-center">
                                <a href="#" id="br" style="display: inline-block;" class="btn btn-success delete-modal btn-sm "><i class="mdi mdi-bell-ring white" ></i></a>
                            </td>
                            @endif
                            <td style="width: 10px">
                                <center><a class="text-center" style="color:#403969" href="{{ url('/Institucional/Detalle/'.$ped->ins_id) }}"><i class="mdi mdi-arrow-right-bold-circle"></i></a></center>
                            </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table><br>
                  <div class="pagination d-flex flex-wrap justify-content-center">{{ $pedidos->links() }}</div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
@section('script')

<script>
    var codigo_uidad = {{ $unidades->uneg_id}};
    //console.log(codigo_uidad);
    function send() {
        var unidad = 2;
        var value = $("#inst").val();
        var cu = $("#cuce").val();
        var fe = $("#fent").val();
        var ob = $("#obs").val();
        var obj ={
            un:codigo_uidad,
            ins:value,
            cuc:cu,
            fech:fe,
            obse:ob
        };
        //console.log(obj);
        axios.post('/Institucional/save/',obj)
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
                windows.reload();
                //console.log(response.data);
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