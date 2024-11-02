@extends('layouts.app')

@section('content')
<article>
    <section>
        <div class="list-header">
            <h1>Passeios</h1>
            <a class="button-primary" href="{{route('passeio.create')}}">Cadastrar passeio</a>
            
        </div>
        <div class="list-container">
            @if($passeios->isEmpty())
                <p>Não existem destinos cadastrados.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Horário</th>
                            <th>Destino</th>
                            <th></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($passeios as $passeio)
                            @php
                                // Array associativo para mapear os horários
                                $horariosBonitos = [
                                    'morning' => 'Manhã',
                                    'afternoon' => 'Tarde',
                                    'night' => 'Noite',
                                ];
                            @endphp
                            <tr>
                                <td>{{ $passeio->nome }}</td>
                                <td>{{ $horariosBonitos[$passeio->horario] ?? 'Não definido' }}</td>
                                <td>{{ $passeio->destino->cidade }} - {{ $passeio->destino->estado }}</td>
                                <td>
                                    <a href="{{route('passeio.edit', $passeio->id)}}" class="edit">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.3103 6.87842L17.1216 2.68873C16.9823 2.5494 16.8169 2.43888 16.6349 2.36348C16.4529 2.28808 16.2578 2.24927 16.0608 2.24927C15.8638 2.24927 15.6687 2.28808 15.4867 2.36348C15.3047 2.43888 15.1393 2.5494 15 2.68873L3.43969 14.25C3.2998 14.3888 3.18889 14.554 3.11341 14.736C3.03792 14.918 2.99938 15.1132 3.00001 15.3103V19.5C3.00001 19.8978 3.15804 20.2793 3.43935 20.5606C3.72065 20.8419 4.10218 21 4.50001 21H8.6897C8.88675 21.0006 9.08197 20.9621 9.26399 20.8866C9.44602 20.8111 9.61122 20.7002 9.75001 20.5603L21.3103 8.99998C21.4496 8.86069 21.5602 8.69531 21.6356 8.5133C21.711 8.33129 21.7498 8.13621 21.7498 7.9392C21.7498 7.74219 21.711 7.5471 21.6356 7.36509C21.5602 7.18308 21.4496 7.01771 21.3103 6.87842ZM8.6897 19.5H4.50001V15.3103L12.75 7.06029L16.9397 11.25L8.6897 19.5ZM18 10.1887L13.8103 5.99998L16.0603 3.74998L20.25 7.93873L18 10.1887Z" fill="#171717"/>
                                        </svg>
                                            
                                    </a>
                                    <form action="{{ route('passeio.destroy', $passeio->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete" onclick="return confirm('Tem certeza que deseja excluir este passeio?')">
                                            <svg width="24" class="delete"  height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20.25 4.5H3.75C3.55109 4.5 3.36032 4.57902 3.21967 4.71967C3.07902 4.86032 3 5.05109 3 5.25C3 5.44891 3.07902 5.63968 3.21967 5.78033C3.36032 5.92098 3.55109 6 3.75 6H4.5V19.5C4.5 19.8978 4.65804 20.2794 4.93934 20.5607C5.22064 20.842 5.60218 21 6 21H18C18.3978 21 18.7794 20.842 19.0607 20.5607C19.342 20.2794 19.5 19.8978 19.5 19.5V6H20.25C20.4489 6 20.6397 5.92098 20.7803 5.78033C20.921 5.63968 21 5.44891 21 5.25C21 5.05109 20.921 4.86032 20.7803 4.71967C20.6397 4.57902 20.4489 4.5 20.25 4.5ZM18 19.5H6V6H18V19.5ZM7.5 2.25C7.5 2.05109 7.57902 1.86032 7.71967 1.71967C7.86032 1.57902 8.05109 1.5 8.25 1.5H15.75C15.9489 1.5 16.1397 1.57902 16.2803 1.71967C16.421 1.86032 16.5 2.05109 16.5 2.25C16.5 2.44891 16.421 2.63968 16.2803 2.78033C16.1397 2.92098 15.9489 3 15.75 3H8.25C8.05109 3 7.86032 2.92098 7.71967 2.78033C7.57902 2.63968 7.5 2.44891 7.5 2.25Z" fill="#171717"/>
                                            </svg>
                                        </button>
                                    </form>
                                    
                                    
                                </td>
                                

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($passeios->total() > 5)
                    <div class="pagination">
                        <p>
                            Mostrando passeios: {{ $passeios->firstItem() }} ao {{ $passeios->lastItem() }} 
                            ({{ $passeios->total() }} itens ao todo)
                        </p>
                        <div class="page-navegation">
                            <span>
                                <a href="{{ $passeios->previousPageUrl() }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>Anterior
                                </a>
                            </span>
                            <span>
                                <a href="{{ $passeios->nextPageUrl() }}">Próximo 
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
            
                                </a>
                            </span>
        
        
                        </div>
                    </div>
                @endif
            @endif
           
        </div>
    </section>
   
    
</article>

@endsection