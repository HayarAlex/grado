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
                <h1 class="mr-3" id="prodtt"></h1>
              </div><br>
              <div class="text-center mb-3">
                <p class="text-muted font-weight-bold text-small">Numero de productos <span class=" font-weight-normal">(Cantidad de productos)</span></p>
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
        <h4 class="card-title">Pedidos Adicionales</h4>
      </div>
      <div id="adicional" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 pedtotal"></h1>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold  text-small">Total Pedidos Adicionales <span class=" font-weight-normal"></span></p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 pedtotal"></h1>
              <h2 class="text-success" id="peda"></h2><i class="mdi mdi-checkbox-marked text-success"></i>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold text-small">Total Pedidos Adicionales <span class=" font-weight-normal">(Pedidos atendidos)</span></p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="d-flex flex-wrap align-items-baseline">
              <h1 class="mr-3 pedtotal"></h1>
              <h2 class="text-warning" id="pedp"></h2><i class="mdi mdi-alert text-warning"></i>
            </div><br>
            <div class="mb-3">
              <p class="text-muted font-weight-bold text-small">Total Pedidos Adicionales <span class=" font-weight-normal">(Pedidos pendientes)</span></p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#adicional" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#adicional" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
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
        <h4 class="card-title">Cantidad productos vendidos</h4>
        <canvas id="lineCharta"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Ranking de ventas por sucursal</h4>
        <canvas id="barCharta"></canvas>
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
          //console.log(response.data);
          $('.institutototal').text(response.data.total_ins);
          $('#insa').text(response.data.atendidos);
          $('#insp').text(response.data.pendientes);
          $('.pedtotal').text(response.data.total_pedidosad);
          $('#peda').text(response.data.atendidosd);
          $('#pedp').text(response.data.pendientesd);
        })
        .then(function(){

        });
      axios.get('produ/'+valor)
        .then(function (response){
          $('#prodtt').text(response.data[0].produ);
        })
        .then(function(){

        });
      $('#btn-create').on('click', function(){
        guardar();
      });
      $.ajax({
        url: '/venmes',
        method: 'GET',
        success: function(response) {
          var labels = response.map(function(item) {
            return item.mes;
          });
          var totalVentas = response.map(function(item) {
            return item.total_ventas; 
          });

          var data = {
              labels: labels, 
              datasets: [{
                  label: 'Total de Ventas',
                  data: totalVentas, 
                  borderColor: 'rgba(75, 192, 192, 1)',
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  fill: true,
                  tension: 0.1
              }]
          };

          var config = {
              type: 'line',
              data: data,
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          };
          var lineChart = new Chart(
              document.getElementById('lineCharta'),
              config
          );
        }
      });

      var sucursalesMap = {
        4: "Santa Cruz",
        2: "La Paz",
        3: "Cochabamba",
        1: "Oficina central",
        8: "Potosí"
      };
      var colorsMap = {
        4: 'rgba(255, 99, 132, 0.6)',
        2: 'rgba(54, 162, 235, 0.6)', 
        3: 'rgba(255, 206, 86, 0.6)', 
        1: 'rgba(75, 192, 192, 0.6)', 
        8: 'rgba(153, 102, 255, 0.6)'
      };

      var borderColorMap = {
        4: 'rgba(255, 99, 132, 1)', 
        2: 'rgba(54, 162, 235, 1)',  
        3: 'rgba(255, 206, 86, 1)', 
        1: 'rgba(75, 192, 192, 1)',  
        8: 'rgba(153, 102, 255, 1)'
      };
      $.ajax({
        url: '/rank', 
        method: 'GET',
        success: function(response) {
          var labels = response.map(function(item) {
            return sucursalesMap[item.sucursal] || 'Sucursal desconocida'; 
          });
          var totalVentas = response.map(function(item) {
            return item.total_ventas; 
          });
          var backgroundColors = response.map(function(item) {
            return colorsMap[item.sucursal] || 'rgba(0, 0, 0, 0.1)'; 
          });
          var borderColors = response.map(function(item) {
            return borderColorMap[item.sucursal] || 'rgba(0, 0, 0, 1)'; 
          });

          var data = {
              labels: labels, 
              datasets: [{
                  label: 'Total de Ventas',
                  data: totalVentas, 
                  backgroundColor: backgroundColors,
                  borderColor: borderColors,
                  borderWidth: 1
              }]
          };

          var config = {
              type: 'bar',
              data: data,
              options: {
                  scales: {
                      y: {
                          beginAtZero: true 
                      }
                  }
              }
          };

          var barChart = new Chart(
              document.getElementById('barCharta'),
              config
          );
        }
      });
    });
    
</script>
@endsection