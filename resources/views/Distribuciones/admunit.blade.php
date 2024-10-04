@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-6 grid-margin">
      <h5>Administracion</h5>
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">Unidades de Negocio</h4>
              <div class="table-responsive">
                  <table id="order-listing" class="table table-striped">
                      <thead>
                          <tr>
                              <th class="text-left">Codigo</th>
                              <th class="text-left">Nombre</th>
                              <th class="text-center">Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($unidades as $unid)
                          <tr>
                            <td class="text-left">{{ $unid->uneg_id }}</td>
                            <td class="text-left">{{ $unid->uneg_name }}</td>
                            <td class="text-center"><center><a class="text-center" style="color:#403969" href="{{ url('/AdminDistribucion/'.$unid->uneg_id) }}"><i class="mdi mdi-arrow-right-bold-circle"></i></a></center></td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table><br>
                  <div class="pagination d-flex flex-wrap justify-content-center">{{ $unidades->links() }}</div>
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