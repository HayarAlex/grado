@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Agregar Nuevo Producto</h4>
        <form class="form-sample" action="" method="post" enctype="multipart/from-data">
          @csrf
          <p class="card-description">
            Nuevo Producto
          </p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Nombre:</label>
                  <input id="pat" type="text" name="name" class="form-control" placeholder="Ingrese nombre" value="{{ old('name') }}"/>
                  {{-- @if($errors->has('name'))
                    <label for="" style="color: red;">{{ $errors->first('name') }}</label>
                  @endif --}}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Tipo producto:</label>
                  	<select class="form-control form-control-sm">
                      <option value="">Seleccione tipo</option>
                      @foreach($productTypes as $productType)
                        <option value="{{ $productType->product_type_id}}">{{ $productType->description }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  	<label for=""><a style="color: red">*</a>Medida:</label>
                  	<select class="form-control form-control-sm">
                      	<option value="0">Seleccione medida</option>
                      	@foreach($categories as $category)
                          <option value="{{ $category->category_id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="">Precio:</label>
                  <input id="pat" type="number" name="price" class="form-control" placeholder="Ingrese dirección" value="{{ old('price') }}" />
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Cantidad:</label>
                  <input id="pat" type="text" name="quantity" class="form-control" placeholder="Ingrese stock" value="{{ old('quantity') }}" />
                  {{-- @if($errors->has('nit'))
                    <label for="" style="color: red;">{{ $errors->first('nit') }}</label>
                  @endif --}}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div style="text-align: right;margin-top: 35px;">
		            <button type="submit" class="btn btn-primary mr-2">Agregar</button>
		            <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('product.index') }}">Cancelar</a>
  		        </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
<style>
  #pat{
    padding-top: 10px;
  }
</style>