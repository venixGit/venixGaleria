<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;
use Illuminate\Support\Facades\Storage;  
use Illuminate\Support\Facades\Response;  
use Illuminate\Support\Facades\DB;

class ArticulosController extends Controller
{
    public function mostrarArticulos(Request $data){
       /**
        * Aca lo primero que se hace es una validación que me indica si en el buscador hay algun texto, 
        * en caso de ser esto true que me muestra los datos relacionados con ese valor que es la palabra
        * clave que tiene guardada cada post del articulo en la bd, de lo contrario si no viene ningun dato
        * entonces que me muestre todos los articulos creados.
        * @var [type]
        */
        $palabra = $data->get('buscar');
        if ($palabra != "") {
            $fotos = Articulos::where('palabras_clave_articulo', 'LIKE', '%'. $palabra .'%')
                                ->where('estado', "=" , 1)
                                ->get();
        }else{
            $fotos = Articulos::where('estado', "=" , 1)
                                ->paginate(3);
        }
        return view('home', get_defined_vars());   
    }


/**
 * aca lo que estoy haciendo es utilizar el request utilice un objeto que me permita capturar el dato
 * que estoy necesitando para despues almacenarla en una variable, de esta manera lo que estamos haciendo es
 * que por medio de estos request van a traer cada dato que este en los input de la vista.
 * para la imagen lo que hice fue capturar el id del input buscarimagen, para así decir lo que venga en este
 * archivo, que se guarde en la carpeta storage, y convierta el archivo en iim
 * @param  Request $request [description]
 * @return [type]           [description]
 */
    public function guardarArticulos(Request $request){
        $articulos = new Articulos();

        $articulos->titulo_articulo = $request->get('txtTitulo');
        $articulos->palabras_clave_articulo = $request->get('txtPalabrasClave');
        $articulos->historia_articulo = $request->get('txtHistoria');

        if($request->hasFile('imgNew')){
            $destino = '/foto';
            //obtiene el archivo con el metodo file()
            $imgPath = $request->file('imgNew');
            //time() asigna un numero aleatorio al archivo
            $imgName = time() . '.' . $imgPath->getClientOriginalExtension();
            //asignamos donde se va aguardar el archivo con su destion, y el nombre ya creado
            $path = $request->file('imgNew')->storeAs($destino,$imgName);
            //guarda la ruta en la base de bd
            $articulos->img_articulo = ''.$path;
            // $articulos->img_articulo = 'storage/'.$path;
        }
        $articulos->save();
        return redirect()->route('home')->with('alert','Articulo agregado exitosamente');
    }

    public function mostrarImg(Request $request){
        //el request esta apuntando a un variable que yo defino aca en el controlador
        // $archivo = $content = Storage::get($ruta); 
        $ruta = $request->img;
        $tipo = Storage::mimeType($ruta);
        $archivo = Response::make(Storage::get($ruta),200,[
            'Content-Type' => $tipo,
            'Content-Disposition' => 'inline; filename="' . $ruta . '"'
        ]);
        return $archivo;
    }
    
    public function mostrarDetalle(Request $request){
        
        $detalle = Articulos::find($request->idArticulo);
        // dd($detalle);
        if ($detalle != NULL) {
            return $detalle;
        }else{
            return "NO";
        }
    }
}
