<div class="modal fade" id="modalRespuestaPregunta" aria-labelledby="modalRespuestaPregunta" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="row justify-content-center">

            <div class="col-12">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title mx-auto" id="modalRespuestaPregunta">Respuesta Pregunta</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="oferta d-flex flex-column">

                            <div class="mb-2">

                                <img src="" alt="Imagen de perfil" id="imagen-pregunta-respuesta">

                                <div class="d-flex flex-column text-left">

                                    <a id="perfil-pregunta-respuesta" href="#"></a>

                                </div>

                            </div>

                            <div class="oferta-descripcion">

                                <p class="parrafo m-0" id="contenido-pregunta-respuesta"></p>

                            </div>

                        </div>

                        <form action="" method="POST" id="form_respuesta_pregunta" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">

                                <textarea 
                                        name="contenido_respuesta_pregunta" 
                                        id="contenido_respuesta_preguntaInput" 
                                        rows="5" 
                                        class="form-control @error('contenido_respuesta_pregunta')  is-invalid  @enderror" 
                                        placeholder="Responde aquí" 
                                        style="resize: none;">{{ old('contenido_respuesta_pregunta') }}
                                </textarea>

                                <span class="invalid-feedback" role="alert" id="contenido_respuesta_preguntaError">
                                    <strong></strong>
                                </span>

                                <span class="invalid-feedback" role="alert" id="imagen-respuesta-preguntaError">
                                    <strong></strong>
                                </span>

                            </div>

                            <div class="d-flex justify-content-between">

                                <div class="form-group">

                                    <label for="imagen-respuesta-pregunta" class="labela-pregunta btn-guardar"><i class="far fa-images"></i></label>

                                    <input name="imagen-respuesta-pregunta" type="file" id="imagen-respuesta-pregunta" class="form-control imagen-respuesta-pregunta">

                                </div>

                                <div>

                                    <button class="btn btn-guardar btn-sm " type="submit">Responder</button>

                                </div>

                            </div>

                            <input type="hidden" name="pregunta_id" id="pregunta_id_respuesta">
                            <input type="hidden" name="user_id" id="pregunta_id_user" value="{{ Auth::user()->id }}">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


@section('scripts2')


    @parent


    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', () => {

            /* Cambiar aspecto del input file */
            var loader = function(e){
                
                let file = e.target.files;
                
                let show = "<span>" + file[0].name + "</span>";

                let output = document.querySelector('.labela-pregunta');
                output.innerHTML = show;
                output.classList.add("active");
                
            }

            let fileInput = document.querySelector('#imagen-respuesta-pregunta');
            
            fileInput.addEventListener('change', loader);


            /* Resetear form al cerrar modal */
            $( "#modalRespuestaPregunta" ).on('hidden.bs.modal', function(){

                document.querySelector('#form_respuesta_pregunta').reset();
                let output = document.querySelector('.labela-pregunta');
                output.innerHTML = "<i class='far fa-images'></i>";
            });

            /* Guardar la respuesta en la base de datos */
            $('#form_respuesta_pregunta').submit(function(e){

                e.preventDefault();

                let formData = new FormData();

                const pregunta_id = $('#pregunta_id_respuesta').val();

                formData.append('contenido_respuesta_pregunta', $('#contenido_respuesta_preguntaInput').val());

                formData.append('pregunta_id', $('#pregunta_id_respuesta').val());

                formData.append('user_id', $('#pregunta_id_user').val());

                if($('input[type=file]')[0].files[0]){
                    alert()
                    formData.append('imagen-respuesta-pregunta', $('input[type=file]')[0].files[0]);
                }

                $(".invalid-feedback").children("strong").text("");

                $("#form_respuesta_pregunta input").removeClass("is-invalid");

                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{ route('respuesta_pregunta.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        console.log(response)

                        $("#modalRespuestaPregunta" ).modal('hide');

                        if(response.imagen){

                            $('button[pregunta_id_principal='+ pregunta_id +']').parent().parent().parent().parent().append( "<div nueva-respuesta-id=" + response.respuesta_pregunta_id +" class='oferta-descripcion w-75 float-right nueva-respuesta'> <div> <img src='/storage/perfiles/imagenes/" + response.foto + "'</img> </div> <p>" + response.user + "</p>  <p class='parrafo'>" + response.contenido  + "</p>" + "<a href='/storage/" + response.imagen + "' data-lightbox=" + response.imagen + " data-title='Imagen descriptiva'><img src='/storage/" + response.imagen + "'</img></div>");

                        }
                        else{

                            $('button[pregunta_id_principal='+ pregunta_id +']').parent().parent().parent().parent().append( "<div nueva-respuesta-id=" + response.respuesta_pregunta_id +" class='oferta-descripcion w-75 float-right nueva-respuesta'> <div> <img src='/storage/perfiles/imagenes/" + response.foto + "'</img> </div> <p>" + response.user + "</p><p class='parrafo mb-0'>" + response.contenido  + "</p>" + "</div>");

                        }


                        /* Boton borrar */
                        /* <div class='float-right'><button style='color:#aaaaaa' class='btn btn-sm' respuesta-pregunta-id=" + response.respuesta_pregunta_id + "><i class='fas fa-trash-alt'></i></button></div> */

                        const res = document.querySelector('.nueva-respuesta');
                        res.scrollIntoView();
                        res.scrollIntoView(true);
                        res.scrollIntoView(false);

                    },
                    error: (response) => {
                        console.log(response)
                        if(response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });
                        } else {
                            /* window.location.reload(); */
                        }
                    }
                })

            });

        });

    </script>


    @if ($errors->has('contenido_respuesta_pregunta') || $errors->has('imagen-respuesta-pregunta'))

        <script type="text/javascript">

            document.addEventListener('DOMContentLoaded', () => {

                $('#modalRespuestaPregunta').modal({

                    show: true

                });

            });

        </script>

    @endif


@endsection
