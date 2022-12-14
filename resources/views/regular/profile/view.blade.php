@extends('layouts.regular')

@section('content')

<div class="container-fluid">

    <div class="d-flex flex-column flex-md-row">

        <div class="col-12 col-md-6 mx-auto">
            <div class="card shadow">

                <div class="card-header">
                    <h5 class="title">Meu Usuário</h5>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('regular.profile.update', auth()->user()->id) }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- @include('alerts.success') --}}
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'name']) --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="weight">Peso (kg):</label>
                                    <input type="number" step="0.01" name="weight" class="form-control" placeholder="Peso" value="{{ old('weight', auth()->user()->weight / 100) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="height">Altura (m):</label>
                                    <input type="number" step="0.01" name="height" class="form-control" placeholder="Email" value="{{ old('height', auth()->user()->height / 100) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="birthday">Data de nascimento:</label>
                                    <input type="date" name="birthday" class="form-control"  value="{{ old('birthday', auth()->user()->birthday) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Telefone:" value="{{ old('phone', auth()->user()->phone) }}">
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="activity_level_id">Nível de atividade física:</label>

                                    <select name="activity_level_id" id="activity_level_id" class="form-control">
                                        @foreach ($activities as $act)
                                            @if($act->id == auth()->user()->activity_level_id)
                                                <option selected value="{{ $act->id }}"> {{ $act->name }}</option>
                                            @else
                                                <option value="{{ $act->id }}"> {{ $act->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="date" name="birthday" class="form-control"  value="{{ old('birthday', auth()->user()->birthday) }}"> --}}
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="gender_id">Gênero:</label>

                                    <select name="gender_id" id="gender_id" class="form-control">
                                        @foreach ($genders as $g)
                                            @if($g->id == auth()->user()->gender_id)
                                                <option selected value="{{ $g->id }}"> {{ $g->name }}</option>
                                            @else
                                                <option value="{{ $g->id }}"> {{ $g->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="date" name="birthday" class="form-control"  value="{{ old('birthday', auth()->user()->birthday) }}"> --}}
                                    {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="height">Fórmula utilizada:</label>

                                    <select name="formula_id" id="formula_id" class="form-control">
                                        @foreach ($formulas as $form)
                                            @if($form->id == auth()->user()->formula_id)
                                                <option selected value="{{ $form->id }}"> {{ $form->name }}</option>
                                            @else
                                                <option value="{{ $form->id }}"> {{ $form->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <button type="submit" class="btn btn-primary btn-round btn-block">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-flex mx-auto">
            <div class="vr"></div>
        </div>

        <div class="col-12 col-md-5 mx-auto">

            <div class="card">
                <div class="card-header">
                    <h5 class="title">Alterar senha</h5>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('regular.profile.password', auth()->user()->id) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        {{-- @include('alerts.success', ['key' => 'password_status']) --}}
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label>Nova senha:</label>
                                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Nova senha') }}" type="password" name="password" required>
                                    {{-- @include('alerts.feedback', ['field' => 'password']) --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label>Confirme a nova senha:</label>
                                    <input class="form-control" placeholder="{{ __('Confirme a nova senha') }}" type="password" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mx-auto">
                            <button type="submit" class="btn btn-primary btn-round btn-block">Alterar senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
