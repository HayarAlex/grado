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
        <div class="text-center">
          <h4 class="card-title">Ventas del Dia</h4>
        </div>
        <div id="sales" class="carousel slide dashboard-widget-carousel position-static pt-2" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="text-center">
                <h1 class="mr-3">52</h1>
              </div><br>
              <div class="text-center mb-3">
                <p class="text-muted font-weight-bold text-small">Ventas del Dia <span class=" font-weight-normal">(20/07/2020)</span></p>
              </div>
            </div>
          </div>
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