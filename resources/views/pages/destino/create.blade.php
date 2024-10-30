@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    
    <form action="{{ route('destino.store') }}" method="POST">
        @csrf
        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="">Selecione o estado</option>
        </select>
        
        <label for="cidade">Cidade:</label>
        <select id="cidade" name="cidade">
            <option value="">Selecione a cidade</option>
        </select>
        
        <button type="submit">Salvar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Carregar os estados do Brasil ao carregar a página
        $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados', function(estados) {
            estados.sort(function(a, b) {
                return a.nome.localeCompare(b.nome);
            });
            estados.forEach(function(estado) {
                $('#estado').append(`<option value="${estado.id}">${estado.nome}</option>`);
            });
            console.log(estado)
        });

        // Carregar as cidades ao selecionar um estado
        $('#estado').change(function() {
            var estadoId = $(this).val();
            if (estadoId) {
                $.getJSON(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`, function(cidades) {
                    $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
                    cidades.forEach(function(cidade) {
                        $('#cidade').append(`<option value="${cidade.id}">${cidade.nome}</option>`);
                    });
                });
            } else {
                $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
            }
        });
    });
</script>

@endsection



