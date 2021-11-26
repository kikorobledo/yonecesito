<template>

    <div class="">

        <button class="btn btn-block btn-oferta" @click="abrir">Hacer Una Oferta</button>

        <div v-if="myModel">

            <transition name="modal">

                <div class="modal-mask w-100">

                    <div class="modal-wrapper w-100">

                        <div class="modal-dialog">

                            <div class="modal-content w-100">

                                <div class="modal-header">

                                    <h4 class="modal-title mx-auto">Hacer Una Oferta</h4>

                                    <button type="button" class="close float-right" @click="cerrar"><span aria-hidden="true">&times;</span></button>

                                </div>

                                <div class="modal-body w-100">

                                    <div v-if="principal">

                                        <p class="subtitulo mb-3">Para poder continuar actualiza los datos faltantes</p>

                                        <div class="grupo mb-3" @click="foto">

                                            <i :class="tieneFoto()" class="fas fa-check-circle ml-2"></i>

                                            <p class="texto">Actualiza tu foto de perfil</p>

                                            <i class="fas fa-chevron-right mr-2 flecha"></i>

                                        </div>

                                        <!-- <div class="grupo mb-3" @click="datosBancarios">

                                            <i :class="tieneDatosBancarios()" class="fas fa-check-circle ml-2" ></i>

                                            <p class="texto">Actualiza tus datos bancarios</p>

                                            <i class="fas fa-chevron-right mr-2 flecha"></i>

                                        </div> -->

                                        <div class="grupo mb-3" @click="fechaDeNacimiento_">

                                            <i :class="tieneFechaNacimiento()" class="fas fa-check-circle ml-2" ></i>

                                            <p class="texto">Fecha de nacimiento</p>

                                            <i class="fas fa-chevron-right mr-2 flecha"></i>

                                        </div>

                                        <div class="grupo mb-3" @click="telefono">

                                            <i :class="tieneTelefono()" class="fas fa-check-circle ml-2" ></i>

                                            <p class="texto">Actualiza tu número telefonico</p>

                                            <i class="fas fa-chevron-right mr-2 flecha"></i>

                                        </div>

                                        <div class="errores"></div>

                                        <button type="button" class="btn btn-block btn-siguiente" @click="siguiente">Siguiente</button>

                                    </div>

                                    <div v-if="actualizarFoto">

                                        <form @submit.prevent="actualizarFotoPerfil" enctype="multipart/form-data">

                                            <p class="texto mb-3">Actualiza tu foto de perfil</p>

                                            <div class="w-100 mb-3">

                                                <img v-if="usuarioLogeado.perfil.imagen != null" :src="`/storage/perfiles/imagenes/${usuarioLogeado.perfil.imagen}`"  alt="Foto Perfil" class="foto-perfil-barra">

                                                <img v-else src="/storage/img/usuario.jpg"  alt="Foto Perfil" class="foto-perfil-barra">

                                                <input type="file" ref="boton" class="d-none" @change="cargarImagen($event)">

                                                <button type="button" class="btn btn-guardar labela text-white" @click="$refs.boton.click()">Sube una foto</button>

                                            </div>

                                        </form>

                                        <button type="button" class="btn btn-block btn-siguiente" @click="regresar">Regresar</button>

                                    </div>

                                    <!-- <div v-if="actualizarDatosBancarios">

                                         <form  @submit.prevent="actualizarDatosBancariosPOST">

                                            <p class="mb-3 subtitulo">Proporcione sus datos bancarios para poder recibir el pago.</p>

                                            <div class="form-group text-left">

                                                <label for="propietario_tarjeta" class="texto">Nombre del Titular de la Cuenta</label>

                                                <input name="propietario_tarjeta" type="text" class="form-control" v-model="propietario_tarjeta" :placeholder="this.usuarioLogeado.datos_bancarios.propietario_tarjeta" required>

                                            </div>

                                            <div class="form-group text-left">

                                                <label for="numero_tarjeta" class="texto">Número de Tarjeta</label>

                                                <input name="numero_tarjeta" type="text" class="form-control" v-model="numero_tarjeta" :placeholder="this.usuarioLogeado.datos_bancarios.numero_tarjeta" required>

                                            </div>

                                            <p class="subtitulo">Dirección de facturación</p>

                                            <div class="form-group text-left">

                                                <label for="direccion" class="texto">Calle y Número</label>

                                                <input name="direccion" type="text" class="form-control" v-model="direccion" :placeholder="this.usuarioLogeado.datos_bancarios.direccion" required>

                                            </div>

                                            <div class="form-group text-left">

                                                <label for="colonia" class="texto">Colonia</label>

                                                <input name="colonia" type="text" class="form-control" v-model="colonia" :placeholder="this.usuarioLogeado.datos_bancarios.colonia" required>

                                            </div>

                                            <div class="form-group text-left">

                                                <label for="codigo_postal" class="texto">Código Postal</label>

                                                <input name="codigo_postal" type="number" min="0" class="form-control" v-model="codigo_postal" :placeholder="this.usuarioLogeado.datos_bancarios.codigo_postal" required>

                                            </div>

                                            <div class="form-group text-left">

                                                <label for="ubicacion-tarea">Ingresa tu estado.</label>

                                                <select name="ubicacion-tarea" class="form-control" v-model="estado_" required>

                                                    <option v-for="estado in estados" v-bind:key="estado.id" :value="estado.id">
                                                        {{ estado.nombre }}
                                                    </option>

                                                </select>

                                            </div>

                                            <button type="submit" class="btn btn-sm btn-oferta mb-3 float-right">Actualizar</button>

                                        </form>

                                        <button type="button" class="btn btn-block btn-siguiente" @click="regresar">Regresar</button>

                                    </div> -->

                                    <div v-if="actualizarFechaDeNacimiento">

                                        <form  @submit.prevent="actualizarFechaDeNacimientoPerfil">

                                            <p class="texto mb-3">Actualiza tu fecha de nacimiento</p>

                                            <div class="form-group d-flex">

                                                <input type="date" class="form-control" v-model="fechaDeNacimiento" required>

                                                <button type="submit" class="btn btn-sm btn-siguiente ml-2">Actualizar</button>

                                            </div>

                                        </form>

                                        <button type="button" class="btn btn-block btn-siguiente" @click="regresar">Regresar</button>

                                    </div>

                                    <div v-if="actualizarTelefono">

                                        <form  @submit.prevent="actualizarTelefonoPerfil">

                                            <p class="texto mb-3">Actualiza tu número telefonico</p>

                                            <div class="form-group d-flex">

                                                <input class="form-control" type="tel"  v-model="tel" :placeholder="usuarioLogeado.perfil.telefono" required>

                                                <button type="submit" class="btn btn-sm btn-siguiente ml-2">Actualizar</button>

                                            </div>

                                        </form>

                                        <button type="button" class="btn btn-block btn-siguiente" @click="regresar">Regresar</button>

                                    </div>

                                    <div v-if="oferta_ventana" class="text-left oferta_ventana">

                                        <form @submit.prevent="crearOferta">

                                            <div class="input-group w-50 mb-3">

                                                <div class="input-group-prepend">

                                                    <button class="btn btn-secondary text-white" type="button"><i class="fas fa-dollar-sign"></i></button>

                                                </div>

                                                <input class="form-control" type="number"  v-model="presupuesto" :placeholder="tarea.presupuesto" aria-describedby="basic-addon1">

                                            </div>

                                            <input type="hidden" id="contenido_oferta" name="descripcion" v-model="oferta" >

                                            <trix-editor class="" input="contenido_oferta" style="min-height:200px;" @blur="asignarContenidoOferta()"></trix-editor>

                                            <div class="d-flex justify-content-between w-100 mt-3">

                                                <div class="form-group mb-0">

                                                    <input type="file" ref="boton" class="d-none" @change="cargarImagenOferta($event)">

                                                    <button type="button" class="btn btn-guardar labela text-white ml-1 mb-1" @click="$refs.boton.click()"><i class="far fa-images"></i></button>

                                                </div>

                                                <div>

                                                    <button class="btn btn-guardar btn-sm mr-1 mb-1" type="submit">Hacer Oferta</button>

                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </transition>

        </div>

    </div>

</template>

<script>

    import {mapActions, mapState} from 'vuex'
    import store from '../store'

    export default {
        store,
        props:['tarea_id'],
        name: 'HacerOferta',
        data(){
            return{
                myModel:false,
                principal:true,
                actualizarFoto:false,
                actualizarTelefono:false,
                actualizarFechaDeNacimiento:false,
                /* actualizarDatosBancarios:false, */
                oferta_ventana:false,
                oferta:null,
                imagen:false,
                imagenSubida:null,
                imagenOferta:null,
                /* propietario_tarjeta:null,
                numero_tarjeta:null,
                direccion:null,
                colonia:null,
                codigo_postal:null,
                estado_:null, */
                tel:null,
                fechaDeNacimiento:null,
                presupuesto:null
            }
        },
        mounted(){

            if(this.user_id){
                this.usuario(this.user_id);
            }
        },
        computed:{
            ...mapState(['tarea','user_id','usuarioLogeado', 'estados','ofertas', 'cantidadOfertas']),
        },
        methods:{
            ...mapActions(['usuario']),
            abrir(){
                if(this.tarea.user_id === this.usuarioLogeado.id){
                    this.$swal({

                        title:"No puedes ofertar.",
                        icon:'error'

                    })

                    return;
                }

                this.actualizarFoto = false;

                this.actualizarTelefono = false;

                this.actualizarFechaDeNacimiento = false;
                /* this.actualizarDatosBancarios = false; */

                if(!this.user_id){
                    $("#loginModal").modal('show');
                }else{
                    this.myModel = true;
                }

            },
            cerrar(){

                this.myModel = false;

                this.principal = true;

                this.actualizarFoto = false;

                /* this.actualizarDatosBancarios = false; */

                this.oferta_ventana = false;
            },
            regresar(){

                this.principal = true;

                this.actualizarFoto = false;

                this.actualizarTelefono = false;

                this.actualizarFechaDeNacimiento = false;

                /* this.actualizarDatosBancarios = false; */

                this.oferta_ventana = false;
            },
            foto(){

                this.principal = false;

                this.actualizarFoto = true;

            },
           /*  datosBancarios(){

                this.principal = false;

                if(this.usuarioLogeado.datos_bancarios.direccion != null)
                    this.direccion = this.usuarioLogeado.datos_bancarios.direccion;
                if(this.usuarioLogeado.datos_bancarios.colonia != null)
                    this.colonia = this.usuarioLogeado.datos_bancarios.colonia;
                if(this.usuarioLogeado.datos_bancarios.codigo_postal != null)
                    this.codigo_postal = this.usuarioLogeado.datos_bancarios.codigo_postal;
                if(this.usuarioLogeado.datos_bancarios.estado_id != null)
                    this.estado_ = this.usuarioLogeado.datos_bancarios.estado_id;
                if(this.usuarioLogeado.datos_bancarios.propietario_tarjeta != null)
                    this.propietario_tarjeta = this.usuarioLogeado.datos_bancarios.propietario_tarjeta;
                if(this.usuarioLogeado.datos_bancarios.numero_tarjeta != null)
                    this.numero_tarjeta = this.usuarioLogeado.datos_bancarios.numero_tarjeta;

                this.actualizarDatosBancarios = true;

            }, */
            telefono(){

                this.principal = false;

                if(this.usuarioLogeado.perfil.telefono != null)
                    this.tel = this.usuarioLogeado.perfil.telefono;

                this.actualizarTelefono = true;

            },
            fechaDeNacimiento_(){

                this.principal = false;

                this.actualizarFechaDeNacimiento = true;

            },
            tieneFoto(){

                return this.usuarioLogeado.perfil.imagen != null ? "verde" : "flecha";
            },
            tieneFechaNacimiento(){

                return this.usuarioLogeado.perfil.fecha_de_nacimiento != null ? "verde" : "flecha";
            },

            tieneTelefono(){

                return this.usuarioLogeado.perfil.telefono != null ? "verde" : "flecha";
            },
            /* tieneDatosBancarios(){

                if(this.usuarioLogeado.datos_bancarios.direccion == null){
                    return "flecha";
                }else if(this.usuarioLogeado.datos_bancarios.colonia == null){
                    return "flecha";
                }else if(this.usuarioLogeado.datos_bancarios.codigo_postal == null){
                    return "flecha";
                }else if(this.usuarioLogeado.datos_bancarios.estado_id == null){
                    return "flecha";
                }else if(this.usuarioLogeado.datos_bancarios.propietario_tarjeta == null){
                    return "flecha";
                }else if(this.usuarioLogeado.datos_bancarios.numero_tarjeta == null){
                    return "flecha";
                }else{
                    return "verde";
                }

            }, */
            actualizarFotoPerfil(){
                const formData = new FormData();

                formData.append('imagen', this.imagenSubida);
                formData.append('perfil_id', this.usuarioLogeado.perfil.id);

                axios.post('/api/actualizar_foto_perfil/' , formData)
                    .then(response =>{
                        /* console.log(response) */
                        this.usuarioLogeado.perfil.imagen = response.data.imagen;
                    }).catch(error => {
                        /* console.log(error) */
                        this.$swal({

                            title:"Hubo un error al actualizar la información.",
                            icon:'error'

                        })
                    })
            },
            /* actualizarDatosBancariosPOST(){

                const formData = new FormData();

                formData.append('direccion', this.direccion);
                formData.append('colonia', this.colonia);
                formData.append('codigo_postal', this.codigo_postal);
                formData.append('direccion', this.direccion);
                formData.append('estado_id', this.estado_);
                formData.append('propietario_tarjeta', this.propietario_tarjeta);
                formData.append('numero_tarjeta', this.numero_tarjeta);
                formData.append('user_id', this.usuarioLogeado.id);

                axios.post('/dato_bancario/update', formData)
                    .then(response =>{

                        console.log(response);

                        this.usuarioLogeado.datos_bancarios.direccion = response.data.direccion

                        this.usuarioLogeado.datos_bancarios.colonia = response.data.colonia

                        this.usuarioLogeado.datos_bancarios.codigo_postal = response.data.codigo_postal

                        this.usuarioLogeado.datos_bancarios.estado_id =response.data.estado_id

                        this.usuarioLogeado.datos_bancarios.propietario_tarjeta = response.data.propietario_tarjeta

                        this.usuarioLogeado.datos_bancarios.numero_tarjeta = response.data.numero_tarjeta


                        this.principal = true;

                        this.actualizarDatosBancarios = false;

                    }).catch(error => {
                        this.$swal({

                            title:"Hubo un error al actualizar la información.",
                            icon:'error'

                        })
                        console.log(error)
                    })
            }, */
            actualizarTelefonoPerfil(){
                const formData = new FormData();

                formData.append('telefono', this.tel);
                formData.append('perfil_id', this.usuarioLogeado.perfil.id);

                axios.post('/api/actualizar_telefono_perfil/' , formData)
                    .then(response =>{
                        /* console.log(response) */

                        this.usuarioLogeado.perfil.telefono = this.tel;

                        this.principal = true;

                        this.actualizarTelefono = false;

                    }).catch(error => {
                        /* console.log(error) */
                        this.$swal({

                            title:"Hubo un error al actualizar la información.",
                            icon:'error'

                        })
                    })
            },
            actualizarFechaDeNacimientoPerfil(){
                const formData = new FormData();

                formData.append('fecha_de_nacimiento', this.fechaDeNacimiento);
                formData.append('perfil_id', this.usuarioLogeado.perfil.id);

                axios.post('/api/actualizar_fecha_de_nacimiento_perfil/' , formData)
                    .then(response =>{
                        /* console.log(response) */

                        this.usuarioLogeado.perfil.fecha_de_nacimiento = response.data.fecha_de_nacimiento;

                        this.principal = true;

                        this.actualizarFechaDeNacimiento = false;

                    }).catch(error => {
                        /* console.log(error) */
                        this.$swal({

                            title:"Hubo un error al actualizar la información.",
                            icon:'error'

                        })
                    })
            },
            cargarImagen(e){

                const tipoArchivo = e.target.files[0].type;

                if(tipoArchivo === 'image/jpeg' || tipoArchivo === 'image/png'){
                    this.imagenSubida = e.target.files[0];
                    let show = "<span>" + e.target.files[0].name + "</span>";
                    let output = document.querySelector('.labela');
                    output.innerHTML = show;
                    output.classList.add("active");


                    this.actualizarFotoPerfil()
                }else{
                    this.$swal({

                        title:"Formato no valido.",
                        icon:'error'

                    })
                    this.imagenSubida = null;
                    return;
                }

            },
            cargarImagenOferta(e){

                const tipoArchivo = e.target.files[0].type;

                if(tipoArchivo === 'image/jpeg' || tipoArchivo === 'image/png'){
                    this.imagenOferta = e.target.files[0];
                    let show = "<span>" + e.target.files[0].name + "</span>";
                    let output = document.querySelector('.labela');
                    output.innerHTML = show;
                    output.classList.add("active");

                }else{
                    this.$swal({

                        title:"Formato no valido.",
                        icon:'error'

                    })
                    this.imagenOferta = null;
                    return;
                }
            },
            asignarContenidoOferta(){
                this.oferta = $('#contenido_oferta')[0].value;
            },
            crearOferta(){

                const formData = new FormData();

                if(this.imagenOferta != null)
                    formData.append('imagen', this.imagenOferta);

                if(this.presupuesto != null)
                    formData.append('presupuesto', this.presupuesto);

                formData.append('contenido', this.oferta);
                formData.append('tarea_id', this.tarea_id);
                formData.append('usuario_id', this.usuarioLogeado.id);


                axios.post('/api/oferta', formData)
                    .then(response => {
                        console.log(response)

                        this.oferta = null;
                        this.imagenOferta = null;
                        this.presupuesto = null;

                        if(this.cantidadOfertas === 0)
                            this.$store.commit("CARGAR_CANTIDAD_OFERTAS", 1);

                        if(response.data.imagen){
                            $('div[contenedor_oferta=' + this.tarea_id + ']').append(
                                "<div class='temporal oferta d-flex flex-column' oferta_principal=" + response.data.id + ">" +
                                    "<div>"+
                                        "<img src=" + `/storage/perfiles/imagenes/${ this.usuarioLogeado.perfil.imagen }` + " alt='Foto del usuario'>" +
                                        "<div class='d-flex flex-column text-left'>" +
                                            "<a href='#'>" + this.usuarioLogeado.name + "</a>" +
                                            "<div class='estrellas'>" +
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "5.0" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class='oferta-descripcion'>" +
                                        "<div class='parrafo'>" + response.data.contenido + "</div><br>" +
                                        "<a class='mt-2 float-left' href='/storage/ofertas/" + response.data.imagen + "' data-lightbox='" + response.data.imagen + "' data-title='Imagen descriptiva'>"+
                                            "<img src='/storage/ofertas/" + response.data.imagen + "'</img>"+
                                        "</a>"+
                                        "<div class='oferta-footer d-flex justify-content-between w-100'>" +
                                            "<p>" + response.data.createdAtHumanReadable + "</p>" +
                                            "<button class='btn btn-sm btn-eliminar-oferta float-right' style='color: #aaaaaa;' id='"+ response.data.id +"'><i class='fas fa-trash-alt'></i></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>"
                            );
                        }else{
                            $('div[contenedor_oferta=' + this.tarea_id + ']').append(
                                "<div class='temporal oferta d-flex flex-column' oferta_principal=" + response.data.id + ">" +
                                    "<div>"+
                                        "<img src=" + `/storage/perfiles/imagenes/${ this.usuarioLogeado.perfil.imagen }` + " alt='Foto del usuario'>" +
                                        "<div class='d-flex flex-column text-left'>" +
                                            "<a href='#'>" + this.usuarioLogeado.name + "</a>" +
                                            "<div class='estrellas'>" +
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "<i class='fas fa-star'></i>"+
                                                "5.0" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class='oferta-descripcion'>" +
                                        "<div class='parrafo'>" + response.data.contenido + "</div>" +
                                        "<div class='oferta-footer d-flex justify-content-between w-100'>" +
                                            "<p>" + response.data.createdAtHumanReadable + "</p>" +
                                            "<button class='btn btn-sm btn-eliminar-oferta float-right' style='color: #aaaaaa;' id='"+ response.data.id +"'><i class='fas fa-trash-alt'></i></button>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>"
                            );
                        }

                        this.cerrar();
                        /* console.log($('div[oferta_principal=' + response.data.id + ']')) */
                        $('div[oferta_principal=' + response.data.id + ']')[0].firstChild.scrollIntoView({behavior:'smooth'})

                    }).catch(error => {
                        console.log(error);
                        this.$swal({

                            title:"Hubo un error al hacer la oferta.",
                            icon:'error'

                        })
                    })

            },
            siguiente(){

                if(
                    /* this.usuarioLogeado.datos_bancarios.direccion == null ||
                    this.usuarioLogeado.datos_bancarios.colonia == null ||
                    this.usuarioLogeado.datos_bancarios.codigo_postal == null ||
                    this.usuarioLogeado.datos_bancarios.estado_id == null ||
                    this.usuarioLogeado.datos_bancarios.propietario_tarjeta == null ||
                    this.usuarioLogeado.datos_bancarios.numero_tarjeta == null || */
                    this.usuarioLogeado.perfil.imagen == null ||
                    this.usuarioLogeado.perfil.fecha_de_nacimiento == null ||
                    this.usuarioLogeado.perfil.telefono == null
                ){
                    this.$swal({

                        title:"Actualiza los datos faltantes.",
                        icon:'warning'

                    })
                }else{

                    this.principal = false;
                    this.oferta_ventana = true;
                }
            }
        }
    }

</script>

<style scoped>

    .modal-mask{
        position: fixed;
        z-index: 10;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;

    }

    .modal-wrapper{
        display: table-cell;
        vertical-align: middle;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .btn-oferta{
        background-color:rgb(125, 179, 67);
        color:white;
        font-weight: 600;
        border-radius: 50px;
    }

    .btn-oferta:hover{
        color:white;
    }

    .subtitulo{
        font-size: 14px;
    }

    .texto{
        font-size:13px;
        font-weight:400;
        text-transform: initial;
    }

    .grupo{
        display: flex;
        justify-content: space-between;
        border: 1px solid #d6d6d6;
        border-radius: 5px;
        text-align: center;
        padding: 5px 5px;
        margin-bottom: 20px;
    }

    .grupo{
        align-items: center;
    }

    .grupo:hover{
        cursor: pointer;
    }

    .grupo:hover{
        border: 1px solid #bbc2dc;
    }

    .btn-siguiente{
        color: rgb(0, 143, 180);
        background-color: rgb(246, 248, 253);
        border-radius: 160px;
        padding: 8px 16px;
        border-color: rgb(231, 235, 251);
        display: inline-block;
        text-align: center;
        font-weight: 600;
    }

    .labela{
        font-size: 0.7875rem;
        color: white;
    }

    .labela i{
        font-size: 1rem;
    }

    .labela:hover {
        cursor: pointer;
    }

    .btn-guardar{
        color: white;
    }

    .btn-guardar i{
        color: white;
    }

    .verde{
        color: rgb(125, 179, 67);
    }

    .flecha{
        color: #bbc2dc;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .swal2-container {
        z-index: 10000;
    }

    .oferta_ventana{
        max-height: calc(100vh - 175px);
        overflow: scroll;
        overflow-x: hidden
    }

    html {
        overflow: scroll;
        overflow-y: hidden;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    /* Optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }

</style>
