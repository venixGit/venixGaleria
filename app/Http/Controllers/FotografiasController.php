<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotografias;
use App\Models\Palabras;
// use App\Http\Controllers\Auth\

class FotografiasController extends Controller
{
    public function mostrarFotos(){
        $palabra = $data->get('buscar');
        if ($palabra != "") {
            // $fotos = Fotografias::where('palabras_clave_foto', 'LIKE', '%'. $palabra .'%')
            //                     ->where('estado', "=" , 1)
            //                     ->paginate(3);
        }else{
            $fotos = Fotografias::where('estado', "=" , 1)
                                ->paginate(3);
            
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
            $fotografias->id_usuario = auth()->user()->id;
            $fotografias->titulo_foto = $request->get('titulo');
            // dd($fotografias->titulo_foto);
            $fotografias->historia_foto = $request->get('historia');
            // dd($fotografias->historia_foto);
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
            // dd($fotografias);
            return redirect()->route('home')->with('guardar','La fotografía ha sido guardada correctamente');

            
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error','Ah ocurrido un error al insertar la fotografia');
        }

    }



}
