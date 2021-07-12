@extends('layout')

@section('cabecalho')
    Episodios da {{$temporadaNumero}}ª temporada
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

    <form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="post">
        @csrf
        <ul class="list-group mb-2">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{$episodio->numero}}
                    @auth
                    <input type="checkbox"
                           name="episodios[]"
                           value="{{$episodio->id}}"
                           {{$episodio->assistido ? 'checked' : ''}}>
                    @endauth
                    @guest
                    <input type="checkbox" name="episodios[]"
                           value="{{$episodio->id}}"
                           {{$episodio->assistido ? 'checked' : ''}}
                           disabled='true'>
                    @endguest
                </li>
            @endforeach
        </ul>
        @auth
        <button class="btn btn-primary mb-2">Salvar</button>
        @endauth
        @guest
            <button onclick='history.go(-1)' class="btn btn-danger mb-2">Voltar</button>
        @endguest
    </form>
@endsection
