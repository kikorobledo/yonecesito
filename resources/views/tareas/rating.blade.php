@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row row-principal d-flex justify-content-center">

                <div class="col-12 text-center mb-5">

                    <h2>Califica tu Experiencia</h2>

                </div>

                <div class="col-12 col-md-3">

                    <div class="text-center">

                        @if($tarea->usuario->perfil->imagen != null)

                            <img src="/storage/perfiles/imagenes/{{ $tarea->usuario->perfil->imagen }}" alt="Foto Perfil" class="foto-perfil-rating">

                        @else

                            <img src="{{ asset('storage/img/usuario.jpg') }}" alt="Foto Perfil" class="foto-perfil-rating">

                        @endif

                    </div>

                    <p class="nombre-rating mb-0">{{$tarea->usuario->name}}</p>


                    @if($rating)

                        <div class="d-flex justify-content-center rating-stars">

                            <p class="align-self-center m-0 mr-2">{{ $rating }}</p>

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rating)
                                    <i class="fas fa-star align-self-center "></i>
                                @else
                                    <i class="far fa-star align-self-center"></i>
                                @endif
                            @endfor

                        </div>

                    @else

                        <div class="d-flex justify-content-center rating-stars">

                            <p class="align-self-center m-0 mr-2">0</p>

                            @for($i = 0; $i < 5; $i++)

                                <i class="far fa-star align-self-center "></i>

                            @endfor

                        </div>

                    @endif

                </div>

                <div class="col-12 col-md-6">

                    <form method="POST" action="{{ route('resena.store')}}">
                        @csrf

                        <div class="form-group">

                            <div class="input-group w-25">

                                <div class="input-group-prepend">

                                    <button class="btn btn-success color-btn-guardar" type="button"><i class="fas fa-star"></i></button>

                                </div>

                                <input type="number" name="rate" id="rate" min="0" max="5" class="form-control" placeholder="0-5" aria-label="" aria-describedby="basic-addon1">

                            </div>

                        </div>

                        <div class="form-group">

                            <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10"></textarea>

                        </div>

                        <div>

                            @if($check == null)

                                <button class="btn btn-block btn-guardar" type="submit">Enviar reseña</button>

                            @else

                                <button class="btn btn-block btn-secondary" type="button">Ya has calificado esta experiencia</button>

                            @endif

                        </div>

                        <input type="hidden" name="calificado" id="calificado" value={{ $tarea->usuario->id}}>

                        <input type="hidden" name="calificador" id="calificador" value={{ $tarea->trabajadorAsignado->id}}>

                        <input type="hidden" name="tarea_id" id="tarea_id" value={{ $tarea->id}}>

                    </form>

                </div>

        </div>

    </div>

@endsection
