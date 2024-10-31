@extends('layouts.app')

@section('content')
    <article>
        <section>
            <div class="list-header">
                <h1>Destinos</h1>
                <a class="button-primary" href="{{route('destino.index')}}">Voltar</a>
                
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



