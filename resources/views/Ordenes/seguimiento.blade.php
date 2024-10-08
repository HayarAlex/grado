@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-7 grid-margin">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Seguimiento de etapas de produccion</h4>
	      <p class="card-description">
	        Lista de seguimiento y supervision
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center">ID</th>
	              <th class="text-center">Lote</th>
                  <th class="text-center">Etapa</th>
	              <th class="text-center">Descripcion</th>
	              <th class="text-center">Acciones</th>
	            </tr>
	          </thead>
            <tbody>
            @foreach($ordenes as $order)
	            <tr>
	              <td class="text-center">{{ $order->flw_id }}</td>
	              <td class="text-center">{{ $order->flw_order }}</td>
                <td class="text-center">{{ $order->flw_step }}</td>
				<td class="text-center">{{ $order->flw_stepdesc }}</td>
	            <td class="text-center"><center><a class="text-center" style="color:#403969" href="{{ url('/Seguimiento-produccion/'.$order->flw_id) }}"><i class="mdi mdi-arrow-right-bold-circle"></i></a></center></td>
	            </tr>
            @endforeach
            </tbody>
	        </table><br>
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
      var valor = 1;
      axios.get('prom/'+valor)
        .then(function (response){
          console.log(response.data);
        })
        .then(function(){

        });
      $('#btn-create').on('click', function(){
        guardar();
      });
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