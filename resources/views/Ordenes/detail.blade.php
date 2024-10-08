@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-4 grid-margin">
      <div class="card">
          <div class="card-body" style="padding-bottom:2px;">
              <h5 class="">Detalle Etapa de produccion</h5>
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Id Etapa: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $follows->flw_id }}</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Lote: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $follows->flw_order }}</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Paso: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $follows->flw_step }}</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small">Tarea: <span class=" font-weight-normal"></span></p>
                        </div>
                        <div class="col-sm-6">
                            <p class="text-muted font-weight-bold text-small"><span class=" font-weight-normal">{{ $follows->flw_stepdesc }}</span></p>
                        </div>  
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
    <div class="col-lg-3 grid-margin">
      <div class="card">
          <div class="card-body" style="padding-bottom:2px;">
              <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div style="text-align: right;">
                            <form action="{{ url('/Seguimiento-produccion/fin/'.$follows->flw_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-lg btn-success mr-2">
                                    <i class="mdi mdi-flask-empty-outline" style="color:yellow"></i> Concluir Tarea
                                </button>
                            </form>
                        </div>
                    </div>
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