@extends('layouts.regular')

@section('content')
<regular-home token="{{ auth()->user()->api_token }}"></regular-home>
@endsection

@section('scripts')
<script type="text/javascript">
    
    document.addEventListener("DOMContentLoaded", function(e) {

        dados = ''

        @if(auth()->user()->gender_id == null)
            dados += 'Gênero; '
        @endif
        
        @if(auth()->user()->activity_level_id == null)
            dados += 'Nível de atividade física; '
        @endif
        
        @if(auth()->user()->weight == null)
            dados += 'Peso; '
        @endif
        
        @if(auth()->user()->height == null)
            dados += 'Altura; '
        @endif
        
        @if(auth()->user()->birthday == null)
            dados += 'Data de Nascimento; '
        @endif

        if (dados != '') {
            Swal.fire({
                title: 'Opa!',
                text: 'Por favor, preencha os seguintes dados: ' + dados,
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'profile'
                }
            })
        }
    });
</script>
@endsection