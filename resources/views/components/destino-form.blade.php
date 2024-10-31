<div class="list-container">
    <form action="{{ $destino ? route('destino.update', $destino->id) : route('destino.store') }}" method="POST">
        @csrf
        @if($destino)
            @method('PUT') <!-- Para editar o destino -->
        @endif
        
        <div class="container-form">
            <div class="w-full" style="margin-right: 24px">
                <label for="estado">Estado</label><br>
                <select id="estado" name="estado" class="input-login" required>
                    <option value="">Selecione o estado</option>
                    @foreach($destinos as $destino)
                        <option value="{{ $destino->sigla }}" {{ $destino && $destino->estado === $destino->sigla ? 'selected' : '' }}>
                            {{ $destino->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <label for="cidade">Cidade</label><br>
                <select id="cidade" name="cidade" class="input-login" required>
                    <option value="">Selecione a cidade</option>
                    <!-- Populando as cidades e marcando a cidade atual como selecionada -->
                    @if($destino)
                        <option value="{{ $destino->cidade }}" selected>{{ $destino->cidade }}</option>
                    @endif
                </select>
            </div>
        </div>
        
        <button type="submit" class="button-primary">Salvar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Carregar os estados do Brasil ao carregar a página
        $.getJSON('https://servicodados.ibge.gov.br/api/v1/localidades/estados', function(estados) {
            estados.sort(function(a, b) {
                return a.nome.localeCompare(b.nome);
            });
            estados.forEach(function(estado) {
                $('#estado').append(`<option value="${estado.sigla}">${estado.nome}</option>`);
            });

            // Se estiver editando, setar o estado selecionado
            @if($destino)
                $('#estado').val('{{ $destino->estado }}').change(); // Chama o evento para carregar as cidades
            @endif
        });

        // Carregar as cidades ao selecionar um estado
        $('#estado').change(function() {
            let estadoId = $(this).val();
            if (estadoId) {
                $.getJSON(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/municipios`, function(cidades) {
                    $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
                    cidades.forEach(function(cidade) {
                        $('#cidade').append(`<option value="${cidade.nome}">${cidade.nome}</option>`);
                    });

                    // Se estiver editando, setar a cidade selecionada
                    @if($destino)
                        $('#cidade').val('{{ $destino->cidade }}');
                    @endif
                });
            } else {
                $('#cidade').empty().append('<option value="">Selecione a cidade</option>');
            }
        });
    });
</script>
