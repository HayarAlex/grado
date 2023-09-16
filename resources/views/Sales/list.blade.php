@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-12 grid-margin">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title">Historial de Ventas</h4>
              <div style="text-align: right;">
                  <a class="btn btn-primary font-weight-medium auth-form-btn" href="{{ route('product.new') }}">Nueva venta</a>
              </div><br>
              {{-- <div class="col-md-4" style="float: right;margin-right: -15px;">
                <form action="{{ route('customer.index') }}" method="GET">
                  <div class="form-group" >
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Ingrese nombre" aria-label="Recipient's username" name="search">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">Buscar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div> --}}
              <div class="table-responsive">
                  <table id="order-listing" class="table table-striped">
                      <thead>
                          <tr>
                              <th class="text-center">Nº Factura</th>
                              <th class="text-center">Cliente</th>
                              <th class="text-center">Fecha</th>
                              <th class="text-center">Vendedor</th>
                              <th class="text-center">Total Bs.</th>
                              <th class="text-center">Acción</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td class="text-center">157112476</td>
                            <td class="text-center">Tatiana Marquez</td>
                            <td class="text-center">19-08-2020</td>
                            <td class="text-center">Hayar Aliaga</td>
                            <td class="text-center">480.00</td>
                            <td style="width: 10px">
                              <a href="#" id="br" class="btn btn-warning delete-modal btn-sm " data-toggle="modal" data-target="#exampleModal-2"><i class="mdi mdi-file-pdf white" ></i></a>
                              <a class="btn btn-primary btn-sm" id="br" href="#" ><i class="mdi mdi-border-color white" ></i></a>
                              <a class="btn btn-dark btn-sm elim-modal" id="br" href="#"  data-toggle="modal" data-target="#exampleModal-2"><i class="mdi mdi-delete white" ></i></a>
                            </td>
                          </tr>
                      </tbody>
                  </table><br>
                  {{-- <div class="pagination d-flex flex-wrap justify-content-center">{{ $customers->links() }}</div> --}}
              </div>
          </div>
      </div>
  </div>
</div>
{{-- modal --}}
<div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="post" id="form-delete">
            @csrf
            @method('put')
            <div class="modal-header">
              <h5 class="modal-title">Confirmación de Acción</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p id="titulo-modal"></p>
            </div>
            <div class="modal-footer">
              <button type="submit" id="boton-modal"></button>
              <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
            </div>
        </form>
      </div>
    </div>
</div>
{{-- end modal --}}
@endsection
@section('script')
<script>
    $('.delete-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('/customer/desactivar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-modal').text('Desactivar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');          
        }else{
          action = "{{ url('/customer/activar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de activar este registro?');
          console.log('activar');
          $('#boton-modal').text('Activar');
          $('#boton-modal').attr('class','btn btn-success');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
    });
    $('.elim-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1 ||estado == 0){
          action = "{{ url('/customer/eliminar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de eliminar este registro?');
          $('#boton-modal').text('Eliminar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
    });
    // alert('hola');
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