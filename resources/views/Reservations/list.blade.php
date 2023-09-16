@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Reservas/Horario Cancha A</h4>
        <h4 class="card-title">Canchas Disponibles</h4>
        <div style="text-align: right;">
          <a class="btn btn-primary font-weight-medium auth-form-btn" href="{{ route('responsible.new') }}">agregar reserva</a>
        </div><br>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="text-center">Lunes</th>
                <th class="text-center">Martes</th>
                <th class="text-center">Miercoles</th>
                <th class="text-center">Jueves</th>
                <th class="text-center">Viernes</th>
                <th class="text-center">Sabado</th>
                <th class="text-center">Domingo</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- end modal --}}
@endsection
@section('script')

@endsection
<style>
    #br{
        border: none;
    }
    .white{
        color: white;
    }
</style>