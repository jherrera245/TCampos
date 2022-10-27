@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Login') }}</div>
    <div class="card-body login-card-body">

        <p class="login-box-msg">Crear cuenta</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    placeholder="username" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="input-group mb-3">

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="input-group mb-3">

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="password" name="password" required autocomplete="new-password">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password-confirm" type="password" class="form-control"
                placeholder="Password confirmation" name="password_confirmation" required autocomplete="new-password">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Registrar') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</div>
@endsection