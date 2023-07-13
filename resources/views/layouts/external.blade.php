<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Sistema de Controle Nutricional" />
        <meta name="author" content="Marcos Borges" />

        <title>{{ config('app.name') }} </title>
        
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.6/dist/vue-multiselect.min.css">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="#!"> {{ config('app.name') }} </a>
                @if (Route::has('login'))
                    <div class="hidden fixed right-0 px-6 sm:block">
                        @auth
                            @if(auth()->user()->user_type->name == 'Regular')
                                <a href="{{ route('regular.dashboard') }}" class="btn btn-primary">Home</a>
                            @elseif(auth()->user()->user_type->name == 'Nutritionist')
                                <a href="{{ url('nutritionist.dashboard') }}" class="btn btn-primary">Home</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary">Entrar</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Registrar</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="text-center text-white">
                            
                            <h1 class="mb-5">Encontre informações sobre uma alimentação saudável</h1>

                            <div class="col-12 mx-auto" id='wrapper'>
                                <food-search></food-search>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Icons Grid-->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <i class="fa fa-table fa-3x mb-3"></i>
                            <h3>Tabela TACO</h3>
                            <p class="lead mb-0">Alimentos com os valores atualizados de acordo com a Tabela TACO</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <i class="fa fa-edit fa-3x mb-3"></i>
                            <h3>Personalize sua dieta</h3>
                            <p class="lead mb-0">E favorite seus alimentos</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <i class="fa fa-plus fa-3x mb-3"></i>
                            <h3>Quer mais?</h3>
                            <p class="lead mb-0">Faça o cadastro e tenha acesso a mais recursos</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="call-to-action text-white text-center" id="signup">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <h2 class="mb-4">Quer ficar por dentro das novidades? <br> Cadastre seu e-mail! </h2>

                        <form class="form-subscribe" id="contactFormFooter" data-sb-form-api-token="API_TOKEN">

                            <div class="row">
                                <div class="col">
                                    <input class="form-control form-control-lg" id="emailAddressBelow" type="email" placeholder="E-mail" data-sb-validations="required,email" />
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:required">E-mail é requerido.</div>
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddressBelow:email">E-mail informado é inválido.</div>
                                </div>
                                <div class="col-auto"><button class="btn btn-primary btn-lg" id="submitButton" type="submit"><i class="fa fa-paper-plane"></i></button></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
        

        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-auto text-center text-lg-start my-auto">
                        <p class="text-muted small mb-4 mb-lg-0">&copy; {{ config('app.name') }} {{ \Carbon\Carbon::now()->format('Y') }}. Todos os direitos reservados.</p>
                    </div>
                    
                </div>
            </div>
        </footer>
        
        <script src="{{ asset('js/app.js') }}"></script>
        
    </body>
</html>
