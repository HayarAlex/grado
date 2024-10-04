@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-6 grid-margin">
      <div class="card">
          <div class="card-body">
                <h4 class="card-title">Asignacion de unidades de negocio</h4>
                <p class="card-description">
                    Lista de usuarios
                </p>
              <div class="table-responsive">
                  <table id="order-listing" class="table table-striped">
                      <thead>
                          <tr>
                              <th class="text-left">Id</th>
                              <th class="text-left">Nombre</th>
                              <th class="text-left">Email</th>
                              <th class="text-center">Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($usuarios as $user)
                          <tr>
                            <td class="text-left">{{ $user->id }}</td>
                            <td class="text-left">{{ $user->name }} {{ $user->paternal }}</td>
                            <td class="text-left">{{ $user->email }}</td>
                            <td class="text-center"><center><a class="text-center" style="color:#403969" href="{{ url('/Config/'.$user->id) }}"><i class="mdi mdi-arrow-right-bold-circle"></i></a></center></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table><br>
                  <div class="pagination d-flex flex-wrap justify-content-center">{{ $usuarios->links() }}</div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
@section('script')
<script>
    
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