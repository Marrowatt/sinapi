@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black">
                <div class="row g-0">
                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <h4 class="mb-4">We are more than just a company</h4>
                            <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
        
                            <div class="text-center">
                                {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                    style="width: 185px;" alt="logo"> --}}
                                <h4 class="mt-1 mb-5 pb-1">Registre-se</h4>
                            </div>
    
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                
                                <div class="form-outline mb-3">
                                    <label for="name" class="col-md-4">Nome: </label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="email" class="col-md-4">E-mail: </label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus />                            
                                
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="password" class="col-md-4">Senha: </label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline mb-3">
                                    <label for="password-confirm" class="col-md-4">Confirmar senha: </label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="text-center pt-1 mb-4 pb-1">
                                    <button class="btn btn-primary btn-block fa-lg col-12 gradient-custom-2 mb-3" type="submit">Enviar</button>
                                </div>

                                <div class="d-flex align-items-center justify-content-center pb-4">
                                    <p class="mb-0 me-2">Já tens uma conta?</p>
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">Entrar</a>
                                </div>

                            </form>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
