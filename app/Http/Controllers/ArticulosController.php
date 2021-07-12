<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;
use Illuminate\Support\Facades\Storage;  
use Illuminate\Support\Facades\Response;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


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
                                ->paginate(3);
        }else{
            $fotos = Articulos::where('estado', "=" , 1)
                                ->paginate(3);
            
            //ejemplo para validar cada campo                    
            // $fotos = Articulos::select('id_articulo','titulo_articulo','img_articulo','palabras_clave_articulo')
            //                     ->where('estado', "=" , 1)
            //                     ->paginate(3);
          
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
        $request->validate([
            'imagen' => 'required',
            'titulo' => 'required',
            'palabras_clave' => 'required',
            'historia' => 'required',
        ]);

        // try {
            $articulos = new Articulos();      
            $articulos->titulo_articulo = $request->get('titulo');
            $articulos->palabras_clave_articulo = $request->get('palabras_clave');
            $articulos->historia_articulo = $request->get('historia');
           
            if($request->hasFile('imagen')){
                //obtiene el archivo con el metodo file()   
                $destino = '/foto';
                $imgPath = $request->file('imagen');
                $nombrePath = round(microtime(1)*100);
                //time() asigna un numero aleatorio al archivo
                $imgName = $nombrePath.time() . '.' . $imgPath->getClientOriginalExtension();
                //asignamos donde se va aguardar el archivo con su destion, y el nombre ya creado
                $path = $request->file('imagen')->storeAs($destino,$imgName);
                //guarda la ruta en la base de bd  1625353552031625353552 foto/1625353575311625353575.jpg
                // dd($path);
                $articulos->img_articulo = ''.$path;       
                // $articulos->img_articulo = 'storage/'.$path;
            }
            $articulos->save();
            return redirect()->route('home')->with('guardar','La fotografía ha sido guardada correctamente');
            
        // } catch (\Exception $e) {
        //     return redirect()->route('home')->with('error','Ah ocurrido un error al insertar, verifica que tu archivo este disponible');
        // }
        
        
    }

    public function mostrarImg(Request $request){
        //el request esta apuntando a un variable que yo defino aca en el controlador
        //Response: tipo de respuesta predefinido permite mostrar info en un componente html sin tener que procesar en la vivsta
        //storage->get(devuelve un archivo base 64)
        //Responses son distintas funciones de laravel que permiten responder cualquier solicitud realizada por el navegador u otra
        //aplicación
        //mimeType permite obtener una extencion del archivo que esta selecionado
        // $archivo = $content = Storage::get($ruta); 
        // $default = "storage/app/foto/default.jpg";
        $ruta = $request->img;
        try {
            if (Storage::disk('local')->exists($ruta)) {
                $tipo = Storage::mimeType($ruta);
                $archivo = Response::make(Storage::get($ruta),200,[
                    'Content-Type' => $tipo,
                    'Content-Disposition' => 'inline; filename="' . $ruta . '"'
                ]);

            }else{
                return $this->imagenDefault();
            }
            return $archivo;

        } catch (FileNotFoundException $e) {
            return $this->imagenDefault();
        }

        
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

    private function imagenDefault(){
        $ruta = "foto/default.png";
        $tipo = Storage::mimeType($ruta);
        $archivo = Response::make(Storage::get($ruta),200,[
            'Content-Type' => $tipo,
            'Content-Disposition' => 'inline; filename="' . $ruta . '"'
        ]);
        return $archivo;
    }
}
