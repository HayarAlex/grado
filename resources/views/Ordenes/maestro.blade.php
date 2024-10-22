@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-9 grid-margin">
	  <div class="card">
	    <div class="card-body">
	      <h4 class="card-title">Registro maestro de produccion</h4>
	      <p class="card-description">
	        Lista de produccion
	      </p>
	      <div class="table-responsive">
	        <table class="table">
	          <thead>
	            <tr>
	              <th class="text-center">ID</th>
	              <th class="text-center">Lote</th>
                  <th class="text-center">Codigo</th>
	              <th class="text-center">Producto</th>
                  <th class="text-center">Cantidad</th>
	              <th class="text-center">Fecha produccion</th>
	            </tr>
	          </thead>
            <tbody>
            @foreach($ordenes as $order)
	            <tr>
	                <td class="text-center">{{ $order->ma_id }}</td>
	                <td class="text-center">{{ $order->ma_lote }}</td>
                    <td class="text-center">{{ $order->ord_codp }}</td>
				    <td class="text-center">{{ $order->ord_prod }}</td>
                    <td class="text-center">{{ $order->ma_cantidad }}</td>
	                <td class="text-center">{{ $order->ma_fecha }}</td>
	            </tr>
            @endforeach
            </tbody>
	        </table><br>
			<div class="pagination d-flex flex-wrap justify-content-center">{{ $ordenes->links() }}</div>
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