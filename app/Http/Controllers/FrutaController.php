<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\Fruta;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FrutaController extends Controller
{
    //creamos el array de origenes
    private $origenes =
    ['Castilla y León', 'Andalucía', 'Castilla-La Mancha', 'Aragón', 'Extremadura', 'Cataluña', 'Galicia','Comunidad Valenciana',
    'Murcia','Principado de Asturias', 'Comunidad Foral de Navarra', 'Comunidad de Madrid', 'Canarias', 'País Vasco', 'Cantabria',
    'La Rioja', 'Islas Baleares',  'Ceuta', 'Melilla'];

    //crea un array de frutas
    public function rellenarFrutas()
    {
        $frutas = [];

        $fruta = new Fruta();
        $fruta->nombre = 'Manzana';
        $fruta->origen = 'Navarra';
        $fruta->imagen = 'imagenes/manzana.png';
        array_push($frutas,$fruta);

        $fruta = new Fruta();
        $fruta->nombre = 'Uva';
        $fruta->origen = 'La Rioja';
        $fruta->imagen = 'imagenes/uva.png';
        array_push($frutas,$fruta);

        $fruta = new Fruta();
        $fruta->nombre = 'Naranja';
        $fruta->origen = 'Comunidad Valenciana';
        $fruta->imagen = 'imagenes/naranja.png';
        array_push($frutas,$fruta);

        $fruta = new Fruta();
        $fruta->nombre = 'Fresa';
        $fruta->origen = 'Andalucía';
        $fruta->imagen = 'imagenes/fresa.png';
        array_push($frutas,$fruta);

        $fruta = new Fruta();
        $fruta->nombre = 'Tomate';
        $fruta->origen = 'Cataluña';
        $fruta->imagen = 'imagenes/tomate.png';
        array_push($frutas,$fruta);

        return $frutas;
    }

    //coge del array de frutas y las va añadiendo en una card
    public function indexFrutas(Request $request)
    {
        //has -> si esta la session
        if($request->session()->has('fruites')) //si existe la session
        {
            //get-> obtenemos la session
            $frutas = $request->session()->get('fruites');
        }
        else //sino
        {
            $frutas = $this->rellenarFrutas();
            $request->session()->put('fruites', $frutas);
            //put-> para ponerlo
        }

        $datos['fruites'] = $frutas; //fruites es como lo llamaremos fuera de la funcion, frutas
        $datos['titulo'] = 'FRUTAS';
        return view('frutas', $datos);
    }

    //coge los datos introducidos y crea una card/fruta con esos datos
    public function crearFruta(Request $request)
    {
        //guarda la fruta
        $fruta = new Fruta();

        $fruta->nombre = $request->input('nombre');
        $fruta->origen= $request->input('origen');
        $fichero = $request->file('imagen');

        if($fichero) //si existe
        {
            $imagen_path = $fichero->getClientOriginalName(); //coge el path original
            Storage::disk('public')->putFileAs('imagenes/', $fichero, $imagen_path);
        }
        $fruta->imagen = "imagenes/" . $imagen_path;

        $frutas = $request->session()->get('fruites');
        array_push($frutas, $fruta);
        $request->session()->put('fruites',$frutas);

        $datos['fruites'] = $frutas; //de pasamos al array de datos la fruta
        $datos['titulo'] = 'FRUTAS';
        return view('frutas', $datos);
    }

    //metodo que utilizamos a la vista nuevo para mostrar los origenes
    public function vitsaFruita()
    {
        $datos['titulo'] = 'NUEVA FRUTA';
        //Le pasamos el array origenes para que lo muestre
        $datos['origenes'] = $this->origenes; //this siempre que sea una funcion/dato de la misma "pagina"
        return view('nuevo', $datos);
    }

    public function vitsaEditarFruita(Request $request, $nombre)
    {
         //buscamos la fruta que hemos pasado
        $frutas = $request->session()->get('fruites');

        $i = 0;
        $encontrado = false;

        //mientras no lo hayamos encontrado y no haya llegado al final del array
        while ($i < \count($frutas) && !$encontrado)
        {
            //si lo e eoncontrado
            if($frutas[$i]->nombre == $nombre)
            {
                $encontrado = true;
            }
            else //sino lo encuentra
            {
                $i++;
            }
        }

        //si lo hemos  encontrado
        if($encontrado)
        {
            $datos['fruites'] = $frutas[$i];//le pasamos toda la fruta
            $datos['origenes'] = $this->origenes; //le pasamos el array de origenes
            $datos['titulo'] = 'EDITAR FRUTA';
        }
        return view('edita', $datos);
    }

    public function editarFruita(Request $request, $nombre)
    {
        //buscamos la fruta que hemos pasado
        $frutas = $request->session()->get('fruites');

        $i = 0;
        $encontrado = false;

        //mientras no lo hayamos encontrado y no haya llegado al final del array
        while ($i < \count($frutas) && !$encontrado)
        {
            //si lo e eoncontrado
            if($frutas[$i]->nombre == $nombre)
            {
                $encontrado = true;
            }
            else //sino lo encuentra
            {
                $i++;
            }
        }

        //si lo hemos  encontrado
        if($encontrado)
        {
            $frutas[$i]->origen = $request->input('origen');

            //primero borramos el fichero (imagen)
            if(Storage::disk('public')->exists($frutas[$i]->imagen)) //si existe
            {
                Storage::disk('public')->delete($frutas[$i]->imagen);
            }

            $fichero = $request->file('imagen');
            if($fichero) //si existe
            {
                $imagen_path = $fichero->getClientOriginalName(); //coge el path original
                Storage::disk('public')->putFileAs('imagenes/', $fichero, $imagen_path);
            }

            $frutas[$i]->imagen = "imagenes/" . $imagen_path;

            $request->session()->put('fruites',$frutas);
        }

        $datos['fruites'] = $frutas; //de pasamos al array de datos la fruta
        $datos['titulo'] = 'FRUTAS';
        return view('frutas', $datos);
    }

    public function delete(Request $request, $nombre)
    {
        //buscamos la fruta que hemos pasado
        $frutas = $request->session()->get('fruites');

        $i = 0;
        $encontrado = false;

        //mientras no lo hayamos encontrado y no haya llegado al final del array
        while ($i < \count($frutas) && !$encontrado)
        {
            //si lo e eoncontrado
            if($frutas[$i]->nombre == $nombre)
            {
                $encontrado = true;
            }
            else //sino lo encuentra
            {
                $i++;
            }
        }

        //si lo hemos  encontrado
        if($encontrado)
        {
            //primero borramos el fichero (imagen)
            if(Storage::disk('public')->exists($frutas[$i]->imagen)) //si existe
            {
                Storage::disk('public')->delete($frutas[$i]->imagen);
            }

            //borramos la posicion del array
            unset($frutas[$i]);
            //reordenar array y lo guarda en el mismo array y asi quitamos los espacios vacios
            $frutas = array_values($frutas);
            $request->session()->put('fruites', $frutas);
        }

        return \redirect()->action('FrutaController@indexFrutas'); //te redicciona a la vista indice
    }
}
