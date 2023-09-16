@extends('layouts.page')
@section('page')
@include('layouts.notify')
<div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
  <div class="row flex-grow">
    <div class="col-lg-6 d-flex align-items-center justify-content-center">
      <div class="auth-form-transparent text-left p-3">
        <div class="brand-logo">
          <img src="../../../../images/logo-dark.svg" alt="logo">
        </div>
        <h4>Bienvenido!</h4>
        <form class="pt-3" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail">Usuario:</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="mdi mdi-account-outline text-primary"></i>
                </span>
              </div>
              <input type="email" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Ingrese usuario" name="email" value="{{ old('email') }}">
            </div>
            @if($errors->has('email'))
              <label for="" style="color: red;">{{ $errors->first('email') }}</label>
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputPassword">Contraseña:</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="mdi mdi-lock-outline text-primary"></i>
                </span>
              </div>
              <input type="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Ingrese contraseña" name="password">              
            </div>
            @if($errors->has('password'))
              <label for="" style="color: red;">{{ $errors->first('password') }}</label>
            @endif 
          </div>
          <div class="my-2 d-flex justify-content-between align-items-center">
            <div >
            </div>
            <a href="#" class="auth-link text-black">Olvidate tu contraseña?</a>
          </div>
          <div class="my-3">
            {{-- <a type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Iniciar sesión</a> --}}
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">INICIAR SESION</button>
          </div>
          <div class="text-center mt-4 font-weight-light">
            Todavia no tienes cuenta? <a href="#" class="text-primary">Registrate</a>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-6 login-half-bg d-flex flex-row">
      <p class="text-white font-weight-medium text-center flex-grow align-self-end"></p>
    </div>
  </div>
</div>
@endsection