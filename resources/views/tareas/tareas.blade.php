@extends('layouts.app')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.min.css" integrity="sha512-sC2S9lQxuqpjeJeom8VeDu/jUJrVfJM7pJJVuH9bqrZZYqGe7VhTASUb3doXVk6WtjD0O4DTS+xBx2Zpr1vRvg==" crossorigin="anonymous" />

@endsection

@section('content')

    <div class="container">

        <div class="row row-principal pt-0 pl-3 pr-3 ">

            <div class="col-12 mb-3 p-0">

                <filtro-tareas :estados="{{ json_encode($estados) }}"></filtro-tareas>

            </div>

            <div class="col-12 col-md-4 pr-0 mr-0 pl-0 mb-xs-3 mb-lg-0">

                @if(Request::input('tarea_id'))

                    <principal-tareas tarea_id={{Request::input('tarea_id')}}></principal-tareas>

                @else

                    <principal-tareas tarea_id={{ null }}></principal-tareas>

                @endif

            </div>

            <div class="col-12 col-md-8 ml-0 pr-0 pl-0 descripcion-tarea">

                @if(Request::input('tarea_id'))

                    @if(Auth::user())

                        <principal-tarea user_id={{Auth::user()->id}} :estados="{{ json_encode($estados) }}" tarea_id={{Request::input('tarea_id')}}></principal-tarea>

                    @else

                        <principal-tarea user_id="" :estados="{{ json_encode($estados) }}" tarea_id={{Request::input('tarea_id')}}></principal-tarea>

                    @endif

                @else

                    @if(Auth::user())

                        <principal-tarea user_id={{Auth::user()->id}} :estados="{{ json_encode($estados) }}"></principal-tarea>

                    @else

                        <principal-tarea user_id="" :estados="{{ json_encode($estados) }}"></principal-tarea>

                    @endif

                @endif

            </div>

        </div>

    </div>

@endsection

@section('scripts2')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js"
        integrity="sha512-zEL66hBfEMpJUz7lHU3mGoOg12801oJbAfye4mqHxAbI0TTyTePOOb2GFBCsyrKI05UftK2yR5qqfSh+tDRr4Q=="
        crossorigin="anonymous" defer>
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', () => {

        /* Borrar Oferta */
        $('body').on('click', '.btn-eliminar-oferta', function(){

            const params = {
                id: this.getAttribute('id')
            };

            Swal.fire({
                title: '¿Deseas eliminar esta oferta?',
                text: "Una vez eliminada no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {

                    if (result.isConfirmed){

                        axios.post(`/api/oferta/${this.getAttribute('id')}`, {params, _method:'delete'})
                            .then(respuesta => {
                                console.log(respuesta)

                                Swal.fire({

                                    title:"Oferta eliminada",
                                    icon:'success'

                                    }).then((result) => {

                                        $(this).parent().parent().parent().remove();

                                    })

                            }).catch(error => {

                                console.log(error);

                            });
                    }
                });

        });

        /* Borrar Respuesta Oferta */
        $('body').on('click','.btn-eliminar-respuesta-oferta',function(){

            const params = {
                id: this.getAttribute('id')
            };

            Swal.fire({
                title: '¿Deseas eliminar esta respuesta?',
                text: "Una vez eliminada no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {

                    if (result.isConfirmed){

                        axios.post(`/respuesta_oferta/${this.getAttribute('id')}`, {params, _method:'delete'})
                            .then(respuesta => {

                                Swal.fire({

                                    title:"Respuesta eliminada",
                                    icon:'success'

                                    }).then((result) => {

                                        $(this).parent().remove();

                                    })

                            }).catch(error => {

                                console.log(error);

                            });
                    }
                });

        });

        /* Borrar Pregunta */
        $('body').on('click', '.btn-eliminar-pregunta', function(){

            const params = {
                id: this.getAttribute('id')
            };

            Swal.fire({
                title: '¿Deseas eliminar esta pregunta?',
                text: "Una vez eliminada no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {

                    if (result.isConfirmed){

                        axios.post(`/api/pregunta/${this.getAttribute('id')}`, {params, _method:'delete'})
                            .then(respuesta => {
                                console.log(respuesta)

                                Swal.fire({

                                    title:"Pregunta eliminada",
                                    icon:'success'

                                    }).then((result) => {

                                        $(this).parent().parent().parent().remove();

                                    })

                            }).catch(error => {

                                console.log(error);

                            });
                    }
                });

        });

        /* Borrar Respuesta Pregunta */
        $('body').on('click','.btn-eliminar-respuesta-pregunta',function(){

        const params = {
            id: this.getAttribute('id')
        };

        Swal.fire({
            title: '¿Deseas eliminar esta respuesta?',
            text: "Una vez eliminada no se podra recuperar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {

                if (result.isConfirmed){

                    axios.post(`/respuesta_pregunta/${this.getAttribute('id')}`, {params, _method:'delete'})
                        .then(respuesta => {

                            Swal.fire({

                                title:"Respuesta eliminada",
                                icon:'success'

                                }).then((result) => {

                                    $(this).parent().remove();

                                })

                        }).catch(error => {

                            console.log(error);

                        });
                }
            });
        });

    });

    </script>

@endsection
