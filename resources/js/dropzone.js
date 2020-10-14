const { default: Axios } = require("axios");

document.addEventListener('DOMContentLoaded', () =>{

    if(document.querySelector('#dropzone')){

        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone('div#dropzone',{
            url: '/imagenes/store',
            dictDefaultMessage:'Sube hasta 6 imagenes',
            maxFiles:6,
            reuired:true,
            acceptedFiles:".jpg, .png, .gif, .jpeg",
            addRemoveLinks: true,
            dictRemoveFile: 'Remover imagen',
            headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            init: function(){

                const galeria = document.querySelectorAll('.galeria');

                if(galeria.length > 0){

                    galeria.forEach(imagen => {
                        const imagenPublicada = {};
                        imagenPublicada.size = 1;
                        imagenPublicada.name = imagen.value;
                        imagenPublicada.nombreServidor = imagen.value;

                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`);

                        imagenPublicada.previewElement.classList.add('dz-success');
                        imagenPublicada.previewElement.classList.add('dz-complete');

                    });
                }

            },
            success: function(file, respuesta){
                /* console.log(file); */
                console.log(respuesta);
                file.nombreServidor = respuesta.archivo;
            },
            sending: function(file, xhr, formData){
                formData.append('id_tarea', document.querySelector('#id_tarea').value);
            },
            removedfile: function(file,respuesta){
                console.log(file);

                const params = {
                    imagen: file.nombreServidor
                };

                axios.post('/imagenes/destroy', params)
                    .then(respuesta => {
                        console.log(respuesta);

                        /* Eliminar del DOM */
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    });
            }
        });

    }



});
