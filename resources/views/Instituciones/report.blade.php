@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-5 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h4 class="card-title">Reportes Licitaciones</h4><br>
	      		<form>
				  <div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
							  	<label for=""><a style="color: red">*</a>Unidad de negocio:</label>
				                <select id="uneg" name="uneg" class="form-control">
                                    <option value="">Seleccionar U. negocio</option>
                                    @foreach($unidades as $uni)
                                        <option value="{{ $uni->uneg_id}}">{{ $uni->uneg_name }}</option>
                                    @endforeach
                                </select>
				                @if($errors->has('uneg'))
				                  <label for="" style="color: red;">{{ $errors->first('uneg') }}</label>
				                @endif
				              </div>
				            </div>
			            </div>
		      		</div>
	      			<div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
				                <label for=""><a style="color: red">*</a>Fecha inicio:</label>
				                <input id="ini" type="date" name="ini" class="form-control" placeholder="Ingrese nombre" />
				              </div>
				            </div>
			            </div>
		      		</div>
		      		<div class="row">
		      			<div class="col-md-12">
				            <div class="form-group row">
				              <div class="col-sm-12">
				                <label for=""><a style="color: red">*</a>Fecha fin:</label>
				                <input id="end" type="date" name="end" class="form-control" placeholder="Ingrese descripción"/>
				              </div>
				            </div>
			            </div>
		      		</div>
		      		<div style="text-align: right;">
		              <button id="btn-generate" type="button" class="btn btn-primary mr-2" >Generar</button>
		              <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('report.index') }}">Cancelar</a>
		            </div>
	      		</form>
	    	</div>
	  	</div>
	</div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
      
      $('#btn-generate').on('click', function(){
        sssa();
      });
    });
    function sssa(){
      var fini = document.getElementById('ini').value;
      var ffin = document.getElementById('end').value;
	  var uni = document.getElementById('uneg').value;
      let obj = {
			fini: fini, 
			ffin: ffin, 
			uni: uni
		};
		let queryParams = new URLSearchParams(obj).toString();
		window.location.href = '/lireporte?' + queryParams;
      
    }
    
    
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