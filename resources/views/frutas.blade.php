@extends('templates.plantilla')


@section('titulo')
    {{ $titulo }}
@endsection

@section('principal')

   {{-- Bucle para mostrar todas las frutas de l'array --}}
    <div class="card-deck" >
    @foreach ($fruites as $fruta)
        <div class="card-lg-4 mt-3" style="width: 400px">
            <div class="card">
            <img class="card-img-top myCard-img" src="{{ asset( 'storage/' . $fruta->imagen)}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title text-center">{{ $fruta->nombre }}</h5>
                <p class="card-text text-center">{{  $fruta->origen }}</p>
            </div>
            <div class="card-footer">
                <form action="{{ action('FrutaController@vitsaEditarFruita', ['nombre'=> $fruta->nombre ]) }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
                <form action="{{ action('FrutaController@delete', ['nombre'=> $fruta->nombre ]) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>
            </div>
        </div>

    @endforeach
     </div>
@endsection
