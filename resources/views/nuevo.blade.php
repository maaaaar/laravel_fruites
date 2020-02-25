@extends('templates.plantilla')

@section('titulo')
    {{ $titulo }}
@endsection

@section('principal')
    <div class="card mt-2 border-seconsary">
        <div class="card-header bg-secondary text-light"> Fruta </div>
        <div class="card-body">
            <form action="{{ action('FrutaController@crearFruta') }}" method="post" enctype="multipart/form-data"> {{-- multipart para enviar ficheros --}}
                @csrf
                <div class="form-group row">
                    <label for="txtNombre" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" name="nombre" id="txtNombre" class="form-control" placeholder="Nombre de la fruta" aria-describedby="helpid">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtOrigen" class="col-sm-2">Origen</label>
                    <select class="col-sm-10" name="origen">
                        @foreach ($origenes as $origen)
                            <option value="{{$origen}}">{{$origen}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- ESCOGER FICHERO --}}
                <div class="form-group row">
                    <label for="txtImagen" class="col-sm-2 col-form-label">Imagen</label>
                    <div class="col-sm-10">
                        <input type="file" name="imagen" id="txtImagen" class="form-control" placeholder="Imagen de la fruta" aria-describedby="helpid">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-2">
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                        <a name="" id="" class="btn btn-secondary" href="" role="button">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection