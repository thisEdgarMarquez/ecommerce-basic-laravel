@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>

                                @if ($errors->has('apellido'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cedula de identidad') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="numeric" class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" value="{{ old('cedula') }}" maxlength="8" minlength="8"  required autofocus>

                                @if ($errors->has('cedula'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rif" class="col-md-4 col-form-label text-md-right">{{ __('Rif') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('rif') ? ' is-invalid' : '' }}" name="rif" value="{{ old('rif') }}" maxlength="11" minlength="11">

                                @if ($errors->has('rif'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rif') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono1" class="col-md-4 col-form-label text-md-right">{{ __('Telefono 1') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="numeric" class="form-control{{ $errors->has('telefono1') ? ' is-invalid' : '' }}" name="telefono1" value="{{ old('telefono1') }}" maxlength="11" minlength="11"  required autofocus>

                                @if ($errors->has('telefono1'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono2" class="col-md-4 col-form-label text-md-right">{{ __('Telefono 2') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="numeric" class="form-control{{ $errors->has('telefono2') ? ' is-invalid' : '' }}" name="telefono2" value="{{ old('telefono2') }}" maxlength="11" minlength="11">

                                @if ($errors->has('telefono2'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>
                            <div class="col-md-6">
                                <textarea id="name" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" required autofocus>
                                {{ old('direccion') }}
                                </textarea>
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-default">Limpiar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
