@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lista de Administradores</h4>
        <div style="text-align: right;">
          <a class="btn btn-primary font-weight-medium auth-form-btn" href="{{ route('user.new') }}">agregar administrador</a>
        </div><br>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th class="text-center">Ap. paterno</th>
                <th class="text-center">Ap. materno</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td class="py-1">{{ $user->name }}</td>
                <td class="text-center">{{ $user->paternal }}</td>
                <td class="text-center">{{ $user->maternal }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td class="text-center">{{ $user->phone }}</td>
                @if($user->state == 1 )
                  <td class="text-center"><label class="badge badge-success">Activo</label></td>
                @else
                  <td class="text-center"><label class="badge badge-danger">Inactivo</label></td>
                @endif
                <td style="width: 10px">
                  <a href="#" id="br" class="btn {{ $user->state?'btn-danger':'btn-success' }} delete-modal btn-sm " data-id="{{ $user->id }}" data-state="{{ $user->state }}" data-toggle="modal" data-target="#exampleModal-2"><i class="mdi {{ $user->state?'mdi-close':'mdi-check' }} white" ></i></a>
                  <a class="btn btn-primary btn-sm" id="br" href="{{ route('user.edit',Crypt::encrypt($user->id)) }}"><i class="mdi mdi-border-color white" ></i></a>
                  <a class="btn btn-dark btn-sm elim-modal" id="br" href="#" data-id="{{ $user->id }}" data-state="{{ $user->state }}" data-toggle="modal" data-target="#exampleModal-2"><i class="mdi mdi-delete white" ></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table><br>
          <div class="pagination d-flex flex-wrap justify-content-center">{{ $users->links() }}</div>
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
              <h5 class="modal-title" id="title"></h5>
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
          action = "{{ url('/user/desactivar') }}/" + $(this).data('id');
          $('#title').text('Desactivar Administrador');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-modal').text('Desactivar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');          
        }else{
          action = "{{ url('/user/activar') }}/" + $(this).data('id');
          $('#title').text('Activar Administrador');
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
          action = "{{ url('/user/eliminar') }}/" + $(this).data('id');
          $('#title').text('Eliminar Administrador');
          $('#titulo-modal').text('¿Esta seguro de eliminar este registro?');
          $('#boton-modal').text('Eliminar');
          $('#boton-modal').attr('class','btn btn-danger');
          console.log('desactivar');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
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
</style>