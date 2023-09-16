@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Actualizar Datos Entrenador</h4>
        <form class="form-sample" action="{{ route('coach.update',Crypt::encrypt($coach->id)) }}" method="POST">
          @csrf
          @method('PUT')
          <p class="card-description">
            Datos Entrenador
          </p>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Nombres:</label>
                  <input id="pat" type="text" name="name" class="form-control" placeholder="Ingrese nombre" value="{{ $coach->name }}"/>
                  @if($errors->has('name'))
                    <label for="" style="color: red;">{{ $errors->first('name') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Apellido Paterno:</label>
                  <input id="pat" type="text" name="paternal" class="form-control" placeholder="Ingrese paterno" value="{{ $coach->paternal }}" />
                  @if($errors->has('paternal'))
                    <label for="" style="color: red;">{{ $errors->first('paternal') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Apellido Materno:</label>
                  <input id="pat" type="text" name="maternal" class="form-control" placeholder="Ingrese materno" value="{{ $coach->maternal }}"/>
                  @if($errors->has('maternal'))
                    <label for="" style="color: red;">{{ $errors->first('maternal') }}</label>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""></a>Dirección:</label>
                  <input id="pat" type="text" name="address" class="form-control" placeholder="Ingrese dirección" value="{{ $coach->address }}" />
                  @if($errors->has('address'))
                    <label for="" style="color: red;">{{ $errors->first('address') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>Email:</label>
                  <input id="pat" type="email" name="email" class="form-control" placeholder="Ingrese email" value="{{ $coach->email }}"/>
                  @if($errors->has('email'))
                    <label for="" style="color: red;">{{ $errors->first('email') }}</label>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="">Telefono:</label>
                  <input id="pat" type="text" name="phone" class="form-control" placeholder="Ingrese telefono" value="{{ $coach->phone }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4" >
              <div class="form-group row" >
                <label class="col-sm-3 col-form-label" style="margin-top: 20px">Genero:</label>
                @if($coach->gender == 1)
                    <div class="col-sm-4" style="margin-top: 25px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="gender" value="1" checked>
                          Hombre
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-5" style="margin-top: 25px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="gender"  value="2">
                          Mujer
                        </label>
                      </div>
                    </div>
                @else
                    <div class="col-sm-4" style="margin-top: 25px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="gender" value="1" >
                          Hombre
                        </label>
                      </div>
                    </div>
                    <div class="col-sm-5" style="margin-top: 25px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="gender"  value="2" checked>
                          Mujer
                        </label>
                      </div>
                    </div>
                @endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for=""><a style="color: red">*</a>CI:</label>
                  <input id="pat" type="email" name="email" class="form-control" placeholder="Ingrese email" value="{{ $coach->ci }}" disabled/>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div style="text-align:right;margin-top: 35px">
                <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                <a class="btn btn-light font-weight-medium auth-form-btn" href="{{ route('coach.index') }}">Cancelar</a>
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