@extends('layouts.app')
@section('content')
@include('layouts.notify')
<div class="row">
	<div class="col-lg-5 grid-margin">
	  	<div class="card">
	    	<div class="card-body">
	      		<h4 class="card-title">Reportes</h4><br>
	      		<form>
	      			
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
        sss();
      });
    });
    function sss(){
      var fini = document.getElementById('ini').value;
      var ffin = document.getElementById('end').value;
      var obj = {
        fi:fini,
        fe:ffin
      };
	  window.location.href = '/reporte/' + fini + '/' + ffin;
      
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