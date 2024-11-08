@extends('layouts.app')

@section('content')
    <article>
        <section>
            <div class="list-header">
                <h1>Destinos</h1>
                <a class="button-primary" href="{{route('destino.index')}}">
                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.75 6.52473C13.75 6.67391 13.6907 6.81699 13.5852 6.92247C13.4797 7.02796 13.3366 7.08723 13.1875 7.08723H2.17019L6.27292 11.1893C6.32519 11.2415 6.36664 11.3036 6.39493 11.3718C6.42321 11.4401 6.43777 11.5133 6.43777 11.5872C6.43777 11.6611 6.42321 11.7343 6.39493 11.8026C6.36664 11.8709 6.32519 11.9329 6.27292 11.9852C6.22066 12.0375 6.15862 12.0789 6.09033 12.1072C6.02205 12.1355 5.94886 12.15 5.87495 12.15C5.80104 12.15 5.72786 12.1355 5.65957 12.1072C5.59129 12.0789 5.52925 12.0375 5.47699 11.9852L0.414485 6.9227C0.362186 6.87045 0.320697 6.80842 0.292389 6.74013C0.264082 6.67184 0.249512 6.59865 0.249512 6.52473C0.249512 6.45081 0.264082 6.37761 0.292389 6.30932C0.320697 6.24104 0.362186 6.179 0.414485 6.12676L5.47699 1.06426C5.58253 0.95871 5.72569 0.899414 5.87495 0.899414C6.02422 0.899414 6.16738 0.95871 6.27292 1.06426C6.37847 1.16981 6.43777 1.31296 6.43777 1.46223C6.43777 1.61149 6.37847 1.75465 6.27292 1.8602L2.17019 5.96223H13.1875C13.3366 5.96223 13.4797 6.02149 13.5852 6.12698C13.6907 6.23247 13.75 6.37554 13.75 6.52473Z" fill="#F5F5F5"/>
                    </svg>    
                    Voltar
                </a>
                
            </div>
            <x-destino-form /> 
        </section>
    </article>
    
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Carregar os estados do Brasil ao carregar a página
        $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados', function(estados) {
            estados.sort(function(a, b) {
                return a.nome.localeCompare(b.nome);
            });
            estados.forEach(function(estado) {
                console.log(estado)
                $('#estado').append(`<option value="${estado.sigla}">${estado.nome}</option>`);
            });
            console.log(estado)
        });

        // Carregar as cidades ao selecionar um estado
        $('#estado').change(function() {
            let estadoId = $(this).val();
            if (estadoId) {
                $.getJSON(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`, function(cidades) {
                    $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
                    cidades.forEach(function(cidade) {
                        console.log(cidade)
                        $('#cidade').append(`<option value="${cidade.nome}">${cidade.nome}</option>`);
                    });
                });
            } else {
                $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
            }
        });
    });
</script>

@endsection



