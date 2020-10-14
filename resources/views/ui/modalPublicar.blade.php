<div id="modalPublicar" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header modal-cabecera">

                <button type="button" class="close cerrar-publicar-oferta" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <form action="{{ route('tarea.store')}}" method="POST">
                    @csrf

                    <div class="box-body">

                        <div class="publicar-primera">

                            <img src="{{ asset('storage/img/card.png') }}" alt="" class="icono">

                            <p class="modal-publicar-titulo">Comieza a recibir ofertas</p>
                            <p class="modal-publicar-texto">A continuación te haremos algunas preguntas en referencia a tu oferta. No tomara mucho tiempo.</p>

                            <button type="button" class="btn boton-publicar-oferta boton-publicar-primera">Siguiente</button>

                        </div>

                        <div class="publicar-segunda hideMe">

                            <p class="modal-publicar-titulo">Cúentanos lo que necesitas</p>


                            <div class="form-group">

                                <label for="nombreTarea">Este será el título de tu oferta.</label>

                                <input class="form-control @error('nombreTarea') is-invalid @enderror" type="text" name="nombreTarea" id="nombreTarea" value="{{ old('nombreTarea') }}">

                                @error('nombreTarea')

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>

                            <div class="form-group">

                                <label for="descripcionTarea">¿Cuáles son los detalles? Sé lo mas específico que puedas.</label>

                                <textarea cols="30" rows="10" class="form-control @error('descripcionTarea') is-invalid @enderror" name="descripcionTarea" id="descripcionTarea" value="{{ old('descripcionTarea') }}">{{ old('descripcionTarea') }}</textarea>

                                @error('descripcionTarea')

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>

                            <button type="button" class="btn boton-publicar-oferta boton-publicar-segunda">Siguiente</button>

                        </div>

                        <div class="publicar-tercera hideMe">

                            <p class="modal-publicar-titulo">Últimos datos</p>

                            <div class="form-group">

                                <label for="ubicacion-tarea">Ingresa tu estado.</label>

                                <select name="ubicacion-tarea" id="ubicacion-tareaTarea" class="form-control @error('ubicacion-tarea') is-invalid @enderror">

                                    <option value="">Seleccione Una Opción</option>

                                    @foreach($estados as $estado)

                                        <option value="{{ $estado->id }}" {{ old('ubicacion-tareaTarea') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>

                                    @endforeach

                                </select>

                                @error('ubicacion-tarea')

                                    <span class="invalid-feedback d-block" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                            <div class="form-group">

                                <label for="presupuestoTarea">Ingresa tu presupuesto.</label>

                                <input class="form-control @error('presupuestoTarea') is-invalid @enderror" type="number" min=0 name="presupuestoTarea" id="presupuestoTarea" value="{{ old('presupuestoTarea') }}">

                                @error('presupuestoTarea')

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                                @if(Auth::user())

                                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                                @endif

                            </div>

                            <div class="form-group">

                                <label for="fecha_de_vencimientoTarea">¿Cuando lo necesitas hecho?</label>

                                <input class="form-control @error('fecha_de_vencimientoTarea') is-invalid @enderror" type="date" name="fecha_de_vencimientoTarea" id="fecha_de_vencimientoTarea" value="{{ old('fecha_de_vencimientoTarea') }}">

                                @error('fecha_de_vencimientoTarea')

                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>

                            <div class="form-group">

                                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                    <label class="btn btn-secondary active">

                                        <input type="radio" name="tipo[]" autocomplete="off" value="presencial" checked> Presencial

                                    </label>

                                    <label class="btn btn-secondary">

                                        <input type="radio" name="tipo[]" autocomplete="off" value="remoto"> Remoto

                                    </label>

                                </div>

                            </div>


                            @if(Auth::user())

                                <button type="submit" class="btn boton-publicar-oferta boton-publicar-tercera">Ingresar Oferta</button>

                            @else

                                <a type="submit" class="btn boton-publicar-oferta boton-publicar-tercera" data-toggle="modal" data-target="#registerModal">Ingresar Oferta</a>

                            @endif


                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


@section('scripts2')


    @parent

    @if ($errors->has('presupuestoTarea') && $errors->has('ubicacion-tarea') && $errors->has('nombreTarea') && $errors->has('descripcionTarea') && $errors->has('fecha_de_vencimientoTarea') && $errors->has('presupuestoTarea'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('#modalPublicar').modal({

                    show: true

                });

                $(".publicar-primera").addClass('hideMe');
                $(".publicar-segunda").removeClass('hideMe');
                $(".publicar-tercera").addClass('hideMe');

            });

        </script>
    @elseif($errors->has('nombreTarea') || $errors->has('descripcionTarea'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('#modalPublicar').modal({

                    show: true

                });

                $(".publicar-primera").addClass('hideMe');
                $(".publicar-segunda").removeClass('hideMe');
                $(".publicar-tercera").addClass('hideMe');

            });

        </script>

    @elseif($errors->has('presupuestoTarea') || $errors->has('ubicacion-tarea')  || $errors->has('fecha_de_vencimientoTarea'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('#modalPublicar').modal({

                    show: true

                });

                $(".publicar-primera").addClass('hideMe');
                $(".publicar-tercera").removeClass('hideMe');

            });

        </script>

    @endif

@endsection
