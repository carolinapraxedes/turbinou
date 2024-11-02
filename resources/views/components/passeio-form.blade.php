<div class="list-container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ $passeio ? route('passeio.update', $passeio->id) : route('passeio.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($passeio)
            @method('PUT') <!-- Para editar o passeio -->
        @endif
        
        <div class="container-form-passeio">
            <div class="row">
                <div class="w-full">
                    <label for="nome">Nome do passeio*</label><br>
                    <input type="text" class="input-login" name="nome" maxlength="255" id="nome" placeholder="Digite o nome do passeio" required value="{{ $passeio->nome ?? '' }}">
                    @if($errors->has('nome'))
                        <p class="text-red-600 mt-1">
                            {{ $errors->first('nome') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="w-full" style="margin-right: 24px;">
                    <label for="horario">Horário*</label><br>
                    <select id="horario" name="horario" class="input-login" required>
                        <option value="" selected disabled>Selecione o horário</option>
                        <option value="morning" {{ isset($passeio) && $passeio->horario === 'morning' ? 'selected' : '' }}>Manhã</option>
                        <option value="afternoon" {{ isset($passeio) && $passeio->horario === 'afternoon' ? 'selected' : '' }}>Tarde</option>
                        <option value="night" {{ isset($passeio) && $passeio->horario === 'night' ? 'selected' : '' }}>Noite</option>
                    </select>
                    @if($errors->has('horario'))
                        <div class="text-red-600 mt-1">
                            {{ $errors->first('horario') }}
                        </div>
                    @endif
                </div>
                <div class="w-full">
                    <label for="destino">Destino *</label><br>
                    <select id="destino" name="destino_id" class="input-login" required>
                        <option value="" selected disabled>Selecione o destino</option>
                        @foreach($destinos as $destino)
                            <option value="{{ $destino->id }}" {{ isset($passeio) && $passeio->destino_id === $destino->id ? 'selected' : '' }}>
                                {{ $destino->cidade }} ({{ $destino->estado }})
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('destino'))
                        <div class="text-red-600 mt-1">
                            {{ $errors->first('destino') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="w-full">
                <label for="imagem">Imagem do passeio</label><br>
                <input type="file" class="input-login" name="imagem" id="imagem">
                @if($passeio && $passeio->imagem)
                    <p>Imagem atual: <a href="{{ asset('storage/passeios/imagens/' . $passeio->imagem) }}" target="_blank">{{ $passeio->imagem }}</a></p>
                @endif
            </div>
            @if($errors->has('imagem'))
                <div class="text-red-600 mt-1">
                    {{ $errors->first('imagem') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="w-full">
                <label for="descricao">Descrição</label><br>
                <textarea name="descricao" id="descricao" placeholder="Digite a descrição" cols="30" rows="10" maxlength="260" class="input-login" oninput="updateCharacterCount()">{{ $passeio->descricao ?? '' }}</textarea>
                <p id="charCount" class="text-gray-600">0/260</p> <!-- Elemento para o contador -->
            </div>
            @if($errors->has('descricao'))
                <div class="text-red-600 mt-1">
                    {{ $errors->first('descricao') }}
                </div>
            @endif
        </div>
        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="button-emerald">Salvar</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateCharacterCount() {
        const textarea = document.getElementById('descricao');
        const charCountDisplay = document.getElementById('charCount');
        charCountDisplay.textContent = `${textarea.value.length}/260`; // Atualiza o contador
    }
</script>
