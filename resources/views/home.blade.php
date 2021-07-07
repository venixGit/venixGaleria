@extends('layouts.template')
 
@section('photos')
    <div class="card-columns">
    @if (isset($fotos) && count($fotos)) 
        @foreach ($fotos as $foto)
            <div class="card shadow" onclick="showPhoto({{ (isset($foto->id_articulo)) ? $foto->id_articulo : ""}})">
                <img id="imgMostrar" src="/mostrarImg?img={{(isset($foto->img_articulo)) ? $foto->img_articulo : ""}}" class="card-img-top" alt="...">
                <div class="card-body">
                    @foreach (explode(',',(isset($foto->palabras_clave_articulo)) ? $foto->palabras_clave_articulo : "") as $palabra)
                        <span  onchange="savePhoto()" id="txtPalabrasClave" name="txtPalabrasClave"class="badge badge-pill border border-info px-2 px-1 text-sans">
                            #{{$palabra}}
                        </span>
                    @endforeach                                 
                    <p class="card-text mt-1 text-sans">{{(isset($foto->titulo_articulo)) ? $foto->titulo_articulo : ""}}</p>
                    <p class="mt-2 mb-0 pb-0 d-flex justify-content-between">
                        <small class="text-muted">{{ (isset($foto->updated_at)) ? $foto->updated_at->diffForHumans() : ""}}</small>
                    </p>
                </div>
            </div>
        @endforeach
    @else
        {{-- <h1 class="">Sin resultados</h1> --}}
        <img class="img-fluid" src="{{asset('img/app/error404.svg')}}" alt="">
    @endif
    </div>
    <div class="col-12 d-flex justify-content-end">
        {{ $fotos->links()}}     
    </div> 
    

    <!-- Modal new IMG-->
{{-- guardar --}}
@if (\Session::has('guardar'))
    <div id="" class="alert-success">
    {!! \Session::get('guardar')!!}
    </div>
@endif

{{-- error --}}
@if (\Session::has('error'))
    <div id="" class="alert-danger">
    {!! \Session::get('error')!!}
    </div>
@endif

    <form id="guardarImagen" action="{{route('crearArticulos')}}" {{-- class="guardarImagen" --}} method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="newImg" tabindex="-1" role="dialog" aria-labelledby="newImgTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">               
              <div class="modal-header">
                <h5 class="modal-title" id="newImgTitle">Nueva Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
              <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">

                        <div class="input-group mb-3">
                          <div class="custom-file">
                            <input  type="file" 
                                    class="custom-file-input nuevaImagen" 
                                    id="imagen"
                                    name="imagen"  
                                    aria-describedby="inputGroupFileAddon04"
                                    onchange="previewPhoto()"
                                    
                            >
                            {{-- @error('imagen')
                                <br>
                                <small>{{$message}}</small>
                            @enderror --}}
                            {{-- {!! $errors->first('imagen','<small>:message</small><br>')!!} --}}
                            <label class="custom-file-label" for="imgNew" data-browse="Buscar">Buscar Imagen</label>
                          </div>
                        </div>

                        <img id="imgPhoto" src="{{asset('img/app/blue_photo.svg')}}" class="img-fluid verFoto" alt="" style="max-height: 400px;">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                            <div class="col-12">
                                <label for="txtTitulo" class="font-weight-normal">Titulo</label>
                                <div class="input-group mb-3">
                                    <input    type="text" 
                                            class="form-control" 
                                            id="titulo" 
                                            name="titulo" 
                                            aria-describedby="txtTitulo" 
                                            placeholder="Escribe un titulo"
                                            value="{{old('titulo_articulo')}}"
                                            {{-- required="" --}}       
                                    >
                                    {{-- @error('titulo')
                                        <br>
                                        <small>{{$message}}</small>
                                    @enderror --}}
                                    {{-- {!!$errors->first('titulo','<small>:message</small><br>')!!}    --}}
                                </div>
                            </div>  
                            <div class="col-12">
                                <label for="txtPlabrasClave" class="font-weight-normal">Palabras Clave</label>
                                <div class="input-group mb-3">

                                <input    type="text" 
                                            class="form-controls" 
                                            id="palabras_clave" 
                                            name="palabras_clave" 
                                            data-role="tagsinput" 
                                            data-role="tagsinput" 
                                            placeholder="Palabra clave"
                                            value="{{old('palabras_clave_articulo')}}" 
                                            {{-- required=""  --}}
                                >
                                {{-- @error('palabras_clave')
                                    <br>
                                    <small>{{$message}}</small>
                                @enderror --}}
                                {{-- {!!$errors->first('palabras_clave','<small>:message</small><br>')!!} --}}
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="txtHistoria" class="font-weight-normal">Historia</label>
                                <div class="input-group mb-3">
                                    <textarea   name="historia" 
                                                id="historia" 
                                                cols="30" 
                                                rows="6" 
                                                class="form-control" 
                                                placeholder="Cuenta la historia de tu fotografia"
                                                value="{{old('historia_articulo')}}"
                                                {{-- required="" --}}
                                    ></textarea>
                                   {{--  @error('historia')
                                        <br>
                                        <small>{{$message}}</small>
                                    @enderror --}}
                                    {{-- {!!$errors->first('historia','<small>:message</small><br>')!!}     --}}
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="saveImagen" class="btn btn-success" onclick="savePhoto()">Guardar</button>
                {{-- @if(Session::has('message'))
                    {!! Session::get('message') !!}
                @endif --}}
              </div>
            </div>
          </div>
        </div>
    </form>

    <!-- Modal show IMG-->
    <div class="modal fade" id="showImg" tabindex="-1" role="dialog" aria-labelledby="newImgTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">        
        <div class="modal-content">
          <div class="modal-header">      
            <h5 class="modal-title text-uppercase" id="showImgTitle">Detalle de Foto | <span id="titleModalSpan"></span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <img id="imgMostrarFoto" src="" class="img-fluid" alt="" style="height: 400px;">
                </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <div class="row">
                            <div class="col-12">                 
                                 <h3 class="display-4" id="titleImg" name="titleImg"></h3>                       
                            </div>
                            <div class="col-12">
                                 <label id="fechaImg" name="fechaImg" class="text-muted"> <small></small></label>
                            </div>  
                            <div class="col-12">
                                <label  id="palabrasClave" >
                                    <span id="txtMostrarPalabra" name="txtMostrarPalabra" class="badge badge-pill border border-info px-2 py-1">  
                                    </span>
                                </label>
                            </div>
                            <div class="col-12">
                            <hr class="m-0 p-0">
                                <!-- <textarea class="text-sans mt-1" id="historyImg" ></textarea> -->
                            <textarea name="pueb" id="textHistoriaArticulo" cols="30" rows="10" class="form-control text-sans" readonly>
                               
                            </textarea>
                        </div>  
                    </div>
                </div>
            </div>
          </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
      </div>
    </div>
@endsection
