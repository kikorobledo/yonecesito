<template>
</template>

<script>

    export default {
        props:['colonia','lat','lng'],
        created(){

            if(this.colonia == null || this.lat == null || this.lng == null){

                this.$swal.fire(
                    'Actualiza la información de tu tarea.',
                    'Porfavor actualiza los datos de la ubicación de tu tarea para que pueda ser mostrada en la seccion principal de tareas y sea vista por todos los usuarios. No olvides posicionar el ping correctamente.',
                    'question'
                    );
            }

        }

    }

</script>
