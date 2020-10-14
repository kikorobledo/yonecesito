<div class="modal fade" id="modalRespuestaOferta" aria-labelledby="modalRespuestaOferta" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="row justify-content-center">

            <div class="col-12">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title mx-auto" id="modalRespuestaOferta">Respuesta Oferta</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="oferta d-flex flex-column">

                            <div class="mb-2">

                                <img src="" alt="Imagen de perfil" id="imagen-oferta-respuesta">

                                <div class="d-flex flex-column text-left">

                                    <a id="perfil-oferta-respuesta" href="#"></a>

                                    <div class="estrellas">

                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        5.0
                                    </div>

                                </div>

                            </div>

                            <div class="oferta-descripcion">

                                <p class="parrafo m-0" id="contenido-oferta-respuesta"></p>

                            </div>

                        </div>

                        <form action="{{ route('respuesta_oferta.store') }}" method="POST" id="form_respuesta_oferta" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">

                                <textarea name="contenido_respuesta_oferta" id="contenido_respuesta_ofertaInput" rows="5" class="form-control @error('contenido_respuesta_oferta')  is-invalid  @enderror" placeholder="Responde aquí" style="resize: none;">{{ old('contenido_respuesta_oferta') }}</textarea>

                                <span class="invalid-feedback" role="alert" id="contenido_respuesta_ofertaError">
                                    <strong></strong>
                                </span>

                                <span class="invalid-feedback" role="alert" id="imagen-respuesta-ofertaError">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="d-flex justify-content-between">

                                <div class="form-group">

                                    <label for="imagen-respuesta-oferta" class="labela btn-guardar"><i class="far fa-images"></i></label>

                                    <input name="imagen-respuesta-oferta" type="file" id="imagen-respuesta-oferta" class="form-control imagen-respuesta-oferta">

                                </div>

                                <div>

                                    <button class="btn btn-guardar btn-sm " type="submit">Responder</button>

                                </div>

                            </div>

                            <input type="hidden" name="oferta_id" id="oferta_id_respuesta">
                            <input type="hidden" name="user_id" id="oferta_id_user" value="{{ Auth::user()->id }}">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@section('scripts2')


    @parent


    @if ($errors->has('contenido_respuesta_oferta') || $errors->has('imagen-respuesta-oferta'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('#modalRespuestaOferta').modal({

                    show: true

                });

            });

        </script>

    @endif


@endsection
