@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <h4 class="card-title">Productos</h4>
        </div>
        <div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="text-center">
                <h1 class="mr-3">24</h1>
              </div><br>
              <div class="text-center mb-3">
                <p class="text-muted font-weight-bold text-small">Numero de ventas <span class=" font-weight-normal">(Mangera negra de 4mm)</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="text-center">
          <h4 class="card-title">Total Clientes</h4>
        </div>
        <div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="text-center">
                <h1 class="mr-3">72</h1>
              </div><br>
              <div class="text-center mb-3">
                <p class="text-muted font-weight-bold text-small">Total Clientes <span class=" font-weight-normal">(Historial)</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-6 col-xl-4 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
      <div class="d-flex flex-wrap justify-content-between">
        <h4 class="card-title">Pedidos Institucionales</h4>
      </div>
      <div id="purchases" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 institutototal"></h1>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold  text-small">Total Licitaciones <span class=" font-weight-normal"></span></p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 institutototal"></h1>
              <h2 class="text-success" id="insa"></h2><i class="mdi mdi-checkbox-marked text-success"></i>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold text-small">Total Licitaciones <span class=" font-weight-normal">(Licitaciones atendidas)</span></p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 institutototal"></h1>
              <h2 class="text-warning" id="insp"></h2><i class="mdi mdi-alert text-warning"></i>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold text-small">Total Licitaciones <span class=" font-weight-normal">(Licitaciones pendientes)</span></p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#purchases" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#purchases" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Line chart</h4>
        <canvas id="lineChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Bar chart</h4>
        <canvas id="barChart"></canvas>
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
      var valor = 1;
      axios.get('cantprod/'+valor)
        .then(function (response){
          console.log(response.data);
          $('.institutototal').text(response.data.total_ins);
          $('#insa').text(response.data.pendientes);
          $('#insp').text(response.data.atendidos);
        })
        .then(function(){

        });
      $('#btn-create').on('click', function(){
        guardar();
      });
    });
</script>
@endsection