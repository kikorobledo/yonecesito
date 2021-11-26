@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

@endsection


@section('content')

    <div class="container">

        <div class="row row-principal row-height-fix">

            <div class="col-12 datos">

                <div class="row">

                    <div class="col-8">

                        <div class="">

                            <div class="perfil-imagen m-0">

                                @if(Auth::user()->perfil->imagen != null)

                                    <img src="/storage/perfiles/imagenes/{{ Auth::user()->perfil->imagen }}" alt="Foto Perfil">

                                @else

                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil">

                                @endif

                            </div>

                            <a class="btn btn-sm btn-editar" style="cursor:pointer;margin-left: 120px; margin-top:-30px" data-toggle="modal" data-target="#modalFoto"><i class="fas fa-pen"></i></a>

                        </div>

                        <div class="datos">

                            <p class="datos-nombre">{{ Auth::user()->name }}</p>

                            @if(Auth::user()->perfil->direccion != null)

                                <p class="iconos-datos"><i class="fas fa-map-marker-alt"></i>{{ Auth::user()->perfil->direccion }}, {{ Auth::user()->perfil->colonia }}</p>

                            @endif

                            @if(Auth::user()->perfil->telefono != null)

                                <p class="iconos-datos"><i class="fas fa-phone"></i>{{ Auth::user()->perfil->telefono }}</p>

                            @endif

                            <p class="iconos-datos"><i class="fas fa-envelope"></i>{{ Auth::user()->email }}</p>

                            <p>Miembro desde {{ Auth::user()->created_at->diffForHumans() }} <button class="btn btn-sm btn-editar" style="cursor:pointer;" data-toggle="modal" data-target="#modalDatos"><i class="fas fa-pen"></i></button></p>

                        </div>

                    </div>

                    <div class="col-4">

                        <div class="resenas">
                            <ul class="nav nav-tabs" id="myTab">

                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#primera" role="tab" aria-controls="home" aria-selected="true">Como ofertante</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#segunda" role="tab" aria-controls="profile" aria-selected="false">Como trabajador</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active tab-div" id="primera" role="tabpanel" aria-labelledby="home-tab">

                                    @if($rating_ofertante)

                                    <p class="text-center reseñas-subtitulo">Con {{ count($resenas_ofertante) }} reseña.</p>

                                        <div class="d-flex justify-content-center rating-stars">

                                            <p class="align-self-center m-0 mr-2">{{ round($rating_ofertante,1) }}</p>

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating_ofertante)
                                                    <i class="fas fa-star align-self-center "></i>
                                                @else
                                                    <i class="far fa-star align-self-center"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    @else

                                        <p>Este usuario aún no tiene reseñas como ofertante.</p>

                                    @endif

                                </div>

                                <div class="tab-pane fade tab-div" id="segunda" role="tabpanel" aria-labelledby="profile-tab">

                                    @if($rating_trabajador)

                                        <p class="text-center reseñas-subtitulo">Con {{ count($resenas_trabajador) }} reseñas.</p>

                                        <div class="d-flex justify-content-center rating-stars">

                                            <p class="align-self-center m-0 mr-2">{{ round($rating_trabajador,1) }}</p>

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating_trabajador)
                                                    <i class="fas fa-star align-self-center "></i>
                                                @else
                                                    <i class="far fa-star align-self-center"></i>
                                                @endif
                                            @endfor

                                        </div>

                                    @else

                                        <p>Este usuario aún no tiene reseñas como trabajador.</p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Acerca de mi</p>

                    <button class="btn  btn-editar btn-editar-acerca" type="button"><i class="fas fa-pen"></i></button>

                </div>

                <div class="row contenido-acerca">

                    <div class="col-4">

                        @if(Auth::user()->perfil->titulo != null)

                            <p class="acerca-titulo">"{{ Auth::user()->perfil->titulo }}"</p>

                        @else

                            <p class="acerca-titulo">"Actualiza esta información"</p>

                        @endif

                    </div>

                    <div class="col-8">

                        @if(Auth::user()->perfil->acerca_de_mi != null)

                            <p class="acerca-descripcion">"{{ Auth::user()->perfil->acerca_de_mi }}"</p>

                        @else

                            <p class="acerca-descripcion">"Actualiza esta información"</p>

                        @endif

                    </div>


                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Habilidades</p>

                    <button class="btn btn-editar btn-editar-habilidades" type="button"><i class="fas fa-pen"></i></button>

                </div>

                <div class="row contenido-habilidades">

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Educación</h3>

                        @if(Auth::user()->perfil->educacion != null)

                            <span class="habilidades-contenido">{{ Auth::user()->perfil->educacion }}</span>

                        @else

                            <p class="habilidades-actualiza">"Actualiza esta información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Especialidad</h3>

                        @if(Auth::user()->perfil->especialidad != null)

                            <span class="habilidades-contenido">{{ Auth::user()->perfil->especialidad }}</span>

                        @else

                            <p class="habilidades-actualiza">"Actualiza esta información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Trabajo</h3>

                        @if(Auth::user()->perfil->trabajo != null)

                            <span class="habilidades-contenido">{{ Auth::user()->perfil->trabajo }}</span>

                        @else

                            <p  class="habilidades-actualiza">"Actualiza esta información"</p>

                        @endif

                    </div>

                    <div class="col-12 col-md-3 text-center">

                        <h3 class="habilidades-titulo">Idiomas</h3>

                        @if(Auth::user()->perfil->idiomas != null)
                            @php
                                $idiomas = explode(",", Auth::user()->perfil->idiomas);
                            @endphp

                            @foreach($idiomas as $idioma)

                                <span class="habilidades-contenido">{{$idioma}}</span>

                            @endforeach
                        @else

                            <p  class="habilidades-actualiza">"Actualiza esta información"</p>

                        @endif

                    </div>

                </div>

            </div>

            <div class="col-12 mt-5">

                <div class="d-flex justify-content-between mb-3">

                    <p class="titulo">Curriculum</p>

                    <button class="btn btn-editar btn-editar-curriculum" type="button"><i class="fas fa-pen"></i></button>

                </div>

                <div class="contenido-curriculum">

                    @if(Auth::user()->perfil->cv != null)

                    <a href="/storage/perfiles/cv/{{ Auth::user()->perfil->cv }}" class="btn  ml-5 btn-cancelar" target="_blank">Descargar CV</a>

                    @else

                        <p class="acerca-titulo">"No hay un CV disponible"</p>

                    @endif

                </div>

            </div>

            <div class="col-12 mt-5">
                <form action="">
                    <div class="d-flex justify-content-between mb-3">

                        <p class="titulo">Reseñas</p>

                    </div>

                    <div class="resenas">
                        <ul class="nav nav-tabs" id="myTab">

                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#primera2" role="tab" aria-controls="home" aria-selected="true">Como ofertante</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#segunda2" role="tab" aria-controls="profile" aria-selected="false">Como trabajador</a>
                            </li>

                        </ul>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active tab-div" id="primera2" role="tabpanel" aria-labelledby="home-tab">

                                @if(count($resenas_ofertante) != 0)

                                    <p class="text-left reseñas-subtitulo"> {{ count($resenas_ofertante) }} reseñas.</p>

                                    <div class="row">

                                        @foreach($resenas_ofertante as $resena)

                                            <div class="col-3 resena-container d-flex p-2 mr-2  mb-2">

                                                @if($resena->UsuarioCalificador->perfil->imagen != null)

                                                    <img src="/storage/perfiles/imagenes/{{$resena->UsuarioCalificador->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @else

                                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @endif

                                                <div>

                                                    <div class="d-flex justify-content-center rating-stars">

                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $resena->rate)
                                                                <i class="fas fa-star align-self-center "></i>
                                                            @else
                                                                <i class="far fa-star align-self-center"></i>
                                                            @endif
                                                        @endfor

                                                        <p class="align-self-center m-0 ml-2">{{ $resena->rate }}</p>

                                                    </div>

                                                    <p>"{{ $resena->contenido}}"</p>

                                                    <p class="m-0">{{ $resena->created_at->diffForHumans() }}</p>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <p>Este usuario aún no tiene reseñas como ofertante.</p>

                                @endif

                            </div>

                            <div class="tab-pane fade tab-div" id="segunda2" role="tabpanel" aria-labelledby="profile-tab">

                                @if(count($resenas_trabajador) != 0)

                                    <p class="text-left reseñas-subtitulo"> {{ count($resenas_trabajador) }} reseñas.</p>

                                    <div class="row">

                                        @foreach($resenas_trabajador as $resena)

                                            <div class="col-3 resena-container d-flex p-2 mr-2 mb-2">

                                                @if($resena->UsuarioCalificador->perfil->imagen != null)

                                                    <img src="/storage/perfiles/imagenes/{{ $resena->UsuarioCalificador->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @else

                                                    <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-barra">

                                                @endif

                                                <div>

                                                    <div class="d-flex justify-content-center rating-stars">

                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $resena->rate)
                                                                <i class="fas fa-star align-self-center "></i>
                                                            @else
                                                                <i class="far fa-star align-self-center"></i>
                                                            @endif
                                                        @endfor

                                                        <p class="align-self-center m-0 ml-2">{{ $resena->rate }}</p>

                                                    </div>

                                                    <p>"{{ $resena->contenido}}"</p>

                                                    <p class="m-0">{{ $resena->created_at->diffForHumans() }}</p>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <p>Este usuario aún no tiene reseñas como trabajador.</p>

                                @endif

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="acerca-extra d-none col-12 col-md-8 m-auto">

        <form action="{{ route('perfil.update', ['perfil' => Auth::user()->perfil->id])}}" method="POST">
            @csrf
            @method('put')

            <div class="form-group">

                <label for="titulo">Titulo</label>

                <input class="form-control @error('titulo') is-invalid @enderror" type="text" name="titulo" id="titulo" value="{{ Auth::user()->perfil->titulo }}">
                <small>Ingresa un titulo que describa tu profesión.</small>

                @error('titulo')

                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror

            </div>

            <div class="form-group">

                <label for="descripcion">Descripción</label>

                <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" id="descripcion" cols="30" rows="5">{{Auth::user()->perfil->acerca_de_mi}}</textarea>
                <small>Describe las actividades que puedes desempeñar, así como tus experiencias laborales.</small>

                @error('descripcion')

                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>

                @enderror

            </div>

            <div class="text-center">

                <button type="button" class="btn btn-cancelar btn-cancelar-acerca">Cancelar</button>

                <button class="btn btn-guardar" type="submit">Guardar</button>

            </div>

        </form>

    </div>

    <div class="curriculum-extra d-none col-12 col-md-8 m-auto">

        <p>Agregar tu curriculum. El tamaño máximo del archivo es de 5 mb. El formato permitido es .PDF</p>

        <form action="{{ route('perfil.update', ['perfil' => Auth::user()->perfil->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div id="dropzoneCV" class="dropzone rounded"></div>

            <input type="hidden" name="cv" id="cv">

            <p id="error" class="no-valid"></p>

            <div class="text-center">

                <button type="button" class="btn btn-cancelar btn-cancelar-curriculum">Cancelar</button>

                <button class="btn btn-guardar" type="submit">Guardar</button>

            </div>

        </form>

    </div>

    <div class="habilidades-extra d-none col-12 col-md-8 m-auto">

        <form action="{{ route('perfil.update', ['perfil' => Auth::user()->perfil->id])}}" method="POST">
            @csrf
            @method('put')

            <div class="form-group">

                <label for="educacion" class="">Educación</label>

                <div class="">
                    <input id="educacion" type="text" class="form-control @error('educacion') is-invalid @enderror" name="educacion" value="{{ Auth::user()->perfil->educacion }}">

                    @error('educacion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

            </div>

            <div class="form-group">

                <label for="especialidad" class="">Especialidad</label>

                <div class="">
                    <input id="especialidad" type="text" class="form-control @error('especialidad') is-invalid @enderror" name="especialidad" value="{{ Auth::user()->perfil->especialidad }}">

                    @error('especialidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

            </div>

            <div class="form-group">

                <label for="idiomas" class="">Idiomas</label>

                <div class="">

                    <input id="idiomas" type="text" class="form-control @error('idiomas') is-invalid @enderror" name="idiomas" value="{{ Auth::user()->perfil->idiomas }}">
                    <small>Separa los idiomas con comas.</small>

                    @error('idiomas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

            </div>

            <div class="form-group">

                <label for="trabajo" class="">Trabajo</label>

                <div class="">
                    <input id="trabajo" type="text" class="form-control @error('trabajo') is-invalid @enderror" name="trabajo" value="{{ Auth::user()->perfil->trabajo }}">

                    @error('trabajo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

            </div>

            <div class="text-center">

                <button type="button" class="btn btn-cancelar btn-cancelar-habilidades">Cancelar</button>

                <button class="btn btn-guardar" >Guardar</button>

            </div>

        </form>

    </div>

    <div class="modal fade" id="modalFoto" aria-labelledby="modalFoto" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="row justify-content-center">

                <div class="col-xs-12 col-md-8">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="modalFoto">Actualiza tu foto de perfil</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">×</span>

                            </button>

                        </div>

                        <div class="modal-body">

                            <form action="{{ route('perfil.update', ['perfil' => Auth::user()->perfil->id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <div id="dropzoneImagen" class="dropzone rounded"></div>

                                <input type="hidden" name="imagen" id="imagen">

                                <p id="error" class="no-valid"></p>

                                <div class="text-center">
                                    <button class="btn btn-guardar" type="submit">Guardar</button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="modalDatos"  role="dialog" aria-labelledby="modalDatos" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="row justify-content-center">

                <div class="col-xs-12 col-md-8">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="modalDatos">Actualiza tus datos</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">×</span>

                            </button>

                        </div>

                        <div class="modal-body">

                            <form action="{{ route('perfil.update', ['perfil' => Auth::user()->perfil->id])}}" method="POST">
                                @csrf
                                @method('put')

                                <div class="form-group">

                                    <label for="nombre" class="">Nombre</label>

                                    <div class="">
                                        <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ Auth::user()->name }}">

                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="direccion" class="">Calle y Número</label>

                                    <div class="">
                                        <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ Auth::user()->perfil->direccion }}">

                                        @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="colonia" class="">Colonia</label>

                                    <div class="">
                                        <input id="colonia" type="text" class="form-control @error('colonia') is-invalid @enderror" name="colonia" value="{{ Auth::user()->perfil->colonia }}">

                                        @error('colonia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="telefono" class="">Teléfono</label>

                                    <div class="">
                                        <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ Auth::user()->perfil->telefono }}">

                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                </div>

                                <div class="text-center">
                                    <button class="btn btn-guardar" type="submit">Guardar</button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection


@section('scripts')
@parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous"></script>

    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        document.addEventListener('DOMContentLoaded', () => {

            $(".btn-editar-acerca").click(function(){
                $(".contenido-acerca").addClass('d-none');
                $(".contenido-acerca").parent().append($(".acerca-extra").removeClass("d-none"));
            });

            $(".btn-cancelar-acerca").click(function(){
                $(".acerca-extra").addClass("d-none")
                $(".contenido-acerca").removeClass('d-none');

            });

            $(".btn-editar-curriculum").click(function(){
                $(".contenido-curriculum").addClass('d-none');
                $(".contenido-curriculum").parent().append($(".curriculum-extra").removeClass("d-none"));
            });

            $(".btn-cancelar-curriculum").click(function(){
                $(".curriculum-extra").addClass("d-none");
                $(".contenido-curriculum").removeClass('d-none');
            });

            $(".btn-editar-habilidades").click(function(){
                $(".contenido-habilidades").addClass('d-none');
                $(".contenido-habilidades").parent().append($(".habilidades-extra").removeClass("d-none"));
            });

            $(".btn-cancelar-habilidades").click(function(){
                $(".habilidades-extra").addClass("d-none");
                $(".contenido-habilidades").removeClass('d-none');
            });

            /* Dropzone */
            const dropzoneImagen = new Dropzone('#dropzoneImagen',{
                url: "{{ route('perfil.imagen')}}",
                dictDefaultMessage:'Sube aqui tu foto',
                acceptedFiles:".png,.jpg,.jpeg,.gif,.bmp",
                addRemoveLinks:true,
                dictRemoveFile:"Remover archivo",
                maxFiles:1,
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                success:function(file, response){
                    /* console.log(response); */

                    document.querySelector('#error').textContent="";

                    document.querySelector('#imagen').value = response.correcto;

                    file.nombreServidor = response.correcto;

                },
                maxfilesexceeded: function(file){
                    if(this.files[1] != null){
                        this.removeFile(this.files[0]);
                        this.addFile(file);
                    }
                },
                removedfile: function(file, response){

                    file.previewElement.parentNode.removeChild(file.previewElement);

                    params = {
                        imagen : file.nombreServidor
                    };

                    axios.post("{{ route('perfil.borrarimagen')}}",params)
                        .then(respuesta => console.log(respuesta));
                }
            });

            const dropzoneCV = new Dropzone('#dropzoneCV',{
                url: "{{ route('perfil.cv')}}",
                dictDefaultMessage:'Sube aqui tu CV',
                acceptedFiles:".pdf",
                addRemoveLinks:true,
                dictRemoveFile:"Remover archivo",
                maxFiles:1,
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                success:function(file, response){
                    /* console.log(response); */

                    document.querySelector('#error').textContent="";

                    document.querySelector('#cv').value = response.correcto;

                    file.nombreServidor = response.correcto;

                },
                maxfilesexceeded: function(file){
                    if(this.files[1] != null){
                        this.removeFile(this.files[0]);
                        this.addFile(file);
                    }
                },
                removedfile: function(file, response){

                    file.previewElement.parentNode.removeChild(file.previewElement);

                    params = {
                        cv : file.nombreServidor
                    };

                    axios.post("{{ route('perfil.borrarcv')}}",params)
                        .then(respuesta => console.log(respuesta));
                }
            });

        });

    </script>

    @if ($errors->has('titulo') || $errors->has('descripcion'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $(".contenido-acerca").addClass('d-none');
                $(".contenido-acerca").parent().append($(".acerca-extra").removeClass("d-none"));

            });

        </script>

    @endif

    @if ($errors->has('nombre') || $errors->has('direccion') || $errors->has('colonia') || $errors->has('telefono'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $("#modalDatos").modal({

                    show: true

                });
            });

        </script>

    @endif

    @if ($errors->has('educacion') || $errors->has('especialidad') || $errors->has('trabajo') || $errors->has('idiomas'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $(".contenido-habilidades").addClass('d-none');
                $(".contenido-habilidades").parent().append($(".habilidades-extra").removeClass("d-none"));

            });

        </script>

    @endif

@endsection
