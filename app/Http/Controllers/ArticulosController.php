<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArticulosController extends Controller
{
    public function mostrarArticulos(Request $request){
       /**
        * Aca lo primero que se hace es una validación que me indica si en el buscador hay algun texto, 
        * en caso de ser esto true que me muestra los datos relacionados con ese valor que es la palabra
        * clave que tiene guardada cada post del articulo en la bd, de lo contrario si no viene ningun dato
        * entonces que me muestre todos los articulos creados.
        * @var [type]
        */
        $palabra = $request->get('txtBuscar');
        if ($palabra != "") {
            $data = Articulos::where('palabras_clave_articulo', 'LIKE', '%'. $palabra .'%')->get();
            // dd($data);
            return view('home', compact('data'));
        }else{
            $data = Articulos::all();
        }
        return view('home', compact('data'));   
    }


    public function crearArticulos(){
        dd('lol');
       return view('home');
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
            $destino = 'public/app/img';
            //obtiene el archivo con el metodo file()
            $imgPath = $request->file('imgNew');
            //time() asigna un numero aleatorio al archivo
            $imgName = time() . '.' . $imgPath->getClientOriginalExtension();
            //asignamos donde se va aguardar el archivo con su destion, y el nombre ya creado
            $path = $request->file('imgNew')->storeAs($destino,$imgName);
            //guarda la ruta en la base de bd
            $articulos->img_articulo = ''.$path;
            // $articulos->img_articulo = '/storage/'.$path;
        }
        $articulos->save();
        return redirect()->route('home')->with('alert','Articulo agregado exitosamente');
    }

    public function mostrarImg( $filename){
     
        // $storage_path = storage_path();
        // $url = $storage_path.'/storage/'.$filename;// depende de root en el archivo filesystems.php.
        // //verificamos si el archivo existe y lo retornamos
        // if (\Storage::exists($filename))
        // {
        //     return response()->download($url);
        // }
        // //si no se encuentra lanzamos un error 404.
        // abort(404);


        // $path = storage_public('img/' . $filename);

        // if (!File::exists($path)) {
        // abort(404);
        // }
        // $file = File::get($path);
        // $type = File::mimeType($path);
        // $response = Response::make($file, 200);
        // $response->header("Content-Type", $type);
        // return $response;
    }

    public function busquedas(Request $request){
         // $users = DB::select('select * from articulos where palabras_clave_articulo = :palabras_clave_articulo', ['palabras_clave_articulo' => 'hack,virus,testing']);
        
        // $palabra =  DB::select('select * from articulos where palabras_clave_articulo =','hack,virus,testing');
        // $dato = "testing";
        // $palabra = Articulos::where('palabras_clave_articulo', 'LIKE', '%'. $dato .'%')->get();
        // $palabra = Articulos::search('key,custom')
        //     ->within('palabras_clave_articulo')
        //     ->get();
        // dd($palabra);
        // 
        //$articulos = new Articulos();
        

    }
    
}
