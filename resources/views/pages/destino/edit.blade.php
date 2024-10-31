@extends('layouts.app')

@section('content')
    <article>
        <section>
            <div class="list-header">
                <h1>Edite o destino</h1>
                <a class="button-primary" href="{{ route('destino.index') }}">Voltar</a>
            </div>

            <x-destino-form :destino="$destino" :destinos="$destinos" /> <!-- Passando tanto o destino quanto a lista de destinos -->
        </section>
    </article>
@endsection