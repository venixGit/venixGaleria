<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;
class ArticulosController extends Controller
{
    //  public function mostrarArticulos(Articulos $articulo){
    //     // return Project::find($project);
      
    //     return view('home',[
    //         'articulo' => $articulo
    //     ]);
    // }
    public function crearArticulos(){
       return view('home');
       //return "Esta pasando el mensaje";
    }

    // public function store(Request $request){
    //      $request->validate([
    //         'titulo_articulo' => 'required', 
    //         'palabras_clave_articulo' => 'required',
    //         'historia_articulo' => 'required'
    //     ]);
    //     Articulos::create($request->all());
    //     return redirect()->route('/')->with('Success','Articulo created successfully');
    // }
    public function store(Request $request){
        $articulos = new Articulos();

        $articulos->titulo_articulo = $request->get('txtTitulo');
        $articulos->palabras_clave_articulo = $request->get('txtPalabrasClave');
        $articulos->historia_articulo = $request->get('txtHistoria');

        if($request->hasFile('imgNew')){
            $destino = 'public/img/app';
            $imgPath = $request->file('imgNew');
            $imgName = time() . '.' . $imgPath->getClientOriginalExtension();
            $path = $request->file('imgNew')->storeAs($destino,$imgName);
            $articulos->img_articulo = '/storage/'.$path;
        }
        $articulos->save();

        return redirect()->route('home')->with('alert','Articulo agregado exitosamente');

    }
}
