<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotografias;
use App\Models\Palabras;
use Illuminate\Support\Facades\Storage;  
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use App\Http\Controllers\Auth\

class FotografiasController extends Controller
{
    public function mostrarFotos(Request $data){
        $palabra = $data->get('buscar');
        if ($palabra != "") {
            /**
             * whereHas() = "permite hacer un filtro en una relacion, y ademas especificar que tipo de filtro necesito
             * chequear de mi modelo deseado"
             * Para que esto funcione tienen que estar las respectivas relaciones en en los modelos, ejem. la funcion 
             * palabrasClaves es una funcion que hace una relacion a la tabla palabras_claves, lo hace utilizando
             * eloquent.
             * Una vez tenemos esto utilizamos el whereHas, que aplica una condicion que si la condicion se cumple
             * que muestre solo ese tipo de valor, tambien dentro de este whereHas se agrega la funcion relacionada
             * del modelo, una funcion anomima donde se creara un qry que haga la consulta, cabe destacar que si deseamos
             * utilizar una variable externa podemos integrarla usando use(nombre de la variable)
             * @var [type]
             */
            $fotos = Fotografias::whereHas('palabrasClaves', function ($query) use ($palabra) {
                                $query->where('nombre', 'LIKE', '%'. $palabra .'%' );
                                })
                                ->where('estado', "=" , 1)
                                ->with('palabrasClaves')
                                ->orderBy('created_at','DESC')
                                ->paginate(3);
                                // ->get();
                                
            // dd(json_decode($fotos));
            // dd($fotos);
        }else{
            //para mostrar las palabras claves lo que hicimos fue crear una funcion relacionada en el modelo, que
            //lleva una relacion con la tabla que deseamos, de esta manera mandamos esta funcion como parametro a la vista
            //para poder recorrerla en un foreach
            $fotos = Fotografias::where('estado', "=" , 1)
                                ->with('palabrasClaves')
                                ->orderBy('created_at','DESC')
                                ->paginate(3);
            // dd($fotos);
            //en este caso es mejor utilizar eloquent
            // $fotos = DB::table('fotografias')
            //                         ->leftjoin('palabras_claves', 'fotografias.id_foto', "=", 'palabras_claves.id_foto')
            //                         // ->select('fotografias.*', 'palabras_claves.nombre' )
            //                         // ->where('fotografias.id_foto', "==" ,"palabras_claves.id_foto")
            //                         ->where('fotografias.estado', "=", "1")
            //                         // ->paginate(3);
            //                         ->get();

            // dd($fotos);
            //ejemplo para validar cada campo                    
            // $fotos = Articulos::select('id_articulo','titulo_articulo','img_articulo','palabras_clave_articulo')
            //                     ->where('estado', "=" , 1)
            //                     ->paginate(3);
          
        }
        return view('home', get_defined_vars());
    }

    public function guardarFotos(Request $request){
        $request->validate([
            'imagen' => 'required',
            'titulo' => 'required',
            'palabras_clave' => 'required',
            'historia' => 'required',
        ]);

        try {
            $fotografias = new Fotografias();

            if($request->hasFile('imagen')){
                // dd("si hay imagen");
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
                $fotografias->img_foto = ''.$path;       
                // $articulos->img_articulo = 'storage/'.$path;
            }
            DB::transaction( function () use ($request, $fotografias){
                $fotografias->id_usuario = auth()->user()->id;
                $fotografias->titulo_foto = $request->get('titulo');
                // dd($fotografias->titulo_foto);
                $fotografias->historia_foto = $request->get('historia');
                // dd($fotografias->historia_foto); 
                $fotografias->save();
                
                //obtengo el id de la fotografia guarda
                $idFoto = $fotografias->id_foto;
                // dd($idFoto);
                // convierto en un arreglo la cadena de texto
                $palabrasClaves = explode(',', $request->get('palabras_clave'));
                //recorro la cadena de texto en un foreach para guardarlo
                foreach ($palabrasClaves as $key) {
                    //objeto del modelo Palabras
                    $palabra = new Palabras();
                    //almaceno el id obtenido de la fotografia
                    $palabra->id_foto = $idFoto;
                    //guardo el nombre de la palabra en la columna nombre
                    $palabra->nombre = $key;
                    $palabra->save();
                }
            });
            // dd($fotografias);
            return redirect()->route('home')->with('guardar','La fotografía ha sido guardada correctamente');
            
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home')->with('error','Ah ocurrido un error al insertar la fotografia');
        }

    }

    public function mostrarImg(Request $data){
        $ruta = $data->img;
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

    public function imagenDefault(){
        $ruta = "foto/default.png";
        $tipo = Storage::mimeType($ruta);
        $archivo = Response::make(Storage::get($ruta),200,[
            'Content-Type' => $tipo,
            'Content-Disposition' => 'inline; filename="' . $ruta . '"'
        ]);
        return $archivo;
    }

    public function mostrarDetalle(Request $data){
        $detalleFotos = Fotografias::with('palabrasClaves')
                                    ->where('estado', "=", 1)
                                    ->find($data->idFotografia);

        if ($detalleFotos != NULL) {
            $fecha = $detalleFotos->created_at->diffForHumans();
            // dd(json_decode($detalleFotos));
            return get_defined_vars();
        }else{
            return "NO";
        }
    }

    public function mostrarEditarDetalle(Request $data){
        $editarDetalleFoto = Fotografias::with('palabrasClaves')
                                    ->where('estado', "=", 1)
                                    ->find($data->idFotoDetalle);
        // dd($data->idFotoDetalle);
        if ($editarDetalleFoto != NULL) {
            $fecha = $editarDetalleFoto->created_at->diffForHumans();
            // dd(json_decode($detalleFotos));
            return get_defined_vars();
        }else{
            return "NO";
        }
    }
    
    public function editarFotos(Request $data){
        // dd($data->all());
        // $urlFoto;
        $data->validate([
            // 'imagen' => 'required',
            'titulo' => 'required',
            'palabras_clave' => 'required',
            'historia' => 'required',
        ]);
        
        try {
            /*validar si el input foto == null, no hacer nada*/
            $urlFoto;
            if ($data->hasFile('imagen')) {
                //eliminar foto antigua del storage.
                $this->deleteFotoStorage($data->urlOldFoto);
                $destino = '/foto';
                $imgPath = $data->file('imagen');
                $nombrePath = round(microtime(1)*100);
                $imgName = $nombrePath.time() . '.' . $imgPath->getClientOriginalExtension();
                $path = $data->file('imagen')->storeAs($destino,$imgName);
                $urlFoto = $path;
            }else{
                $urlFoto = $data->urlOldFoto;
            }
            DB::transaction(function () use($data, $urlFoto){

                $editarFotografias = Fotografias::find($data->idFotoUpdate);
                $editarFotografias->titulo_foto = $data->titulo;
                $editarFotografias->historia_foto = $data->historia;
                $editarFotografias->img_foto = $urlFoto;
                $editarFotografias->save();
                // dd($urlFoto);
                // 
                //eliminar palabras antiguas
                // $palabrasDelete = Palabras::where('id_foto','=', $data->idFotoUpdate)->get();
                Palabras::where('id_foto','=', $data->idFotoUpdate)->delete();
                // dd('palabras',$palabrasDelete);
                $idFoto = $data->idFotoUpdate;
                // dd($idFoto);
                $palabrasClaves = explode(',', $data->get('palabras_clave'));
                foreach ($palabrasClaves as $key) {
                    $palabra = new Palabras();
                    $palabra->id_foto = $idFoto;
                    $palabra->nombre = $key;
                    $palabra->save();
                }
            });
            // dd($data);
            // dd($fotografias);
            return redirect()->route('home')->with('actualizar','La fotografía ha sido actualizada correctamente');

            // dd(json_decode($editarFotografias));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('home')->with('error','Ah ocurrido un error al actualizar la fotografia');
        }
    }
    //aca solo esta recibiendo el parametro de la url de la foto
    public function deleteFotoStorage($data){
        $fotoBorrada = Storage::disk('local')->delete($data);
        return $fotoBorrada;
    }

    public function eliminarFoto(Request $data){
        // dd($data->all());
        $eliminarFotografias = Fotografias::where('id_foto',"=",$data->idFotoDelete)
                                            ->update(['estado' =>  0]);
        Palabras::where('id_foto','=', $data->idFotoDelete)
                        ->update(['estado' => 0]);
        return redirect()->route('home')->with('eliminar','La fotografía ha sido eliminada correctamente');
        // dd($eliminarFotografias);
    }
}
