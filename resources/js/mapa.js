import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

if(document.querySelector('#mapa')){

    document.addEventListener('DOMContentLoaded', () => {

        /* MAPA */


        const lat = document.querySelector('#tarea-actual-lat').innerHTML;

        const lng = document.querySelector('#tarea-actual-lng').innerHTML;

        const mapa = L.map('mapa').setView([lat, lng], 12);

        /* Eliminar pines previos */
        let markers = new L.FeatureGroup().addTo(mapa);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'

        }).addTo(mapa);

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng],{

            draggable:true,
            autoPan:true

        }).addTo(mapa);

        /* Agregar pin a las capas */
        markers.addLayer(marker);

        /* Geocode Service */
        const geocodeService = L.esri.Geocoding.geocodeService();

        /* Buscador de direcciones */
        const buscador = document.querySelector('#formBuscador');
        const btnbuscador = document.querySelector('#btnformBuscador');

        btnbuscador.addEventListener('click', buscarDireccion);


        reubicarPin(marker);

        /* Detectar movimiento del marker */
        function reubicarPin(marker){

            marker.on('moveend', function(e){

                marker = e.target;

                const posicion = marker.getLatLng();

                console.log(posicion);

                /* Centrar el mapa */
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));

                /* Reverse Geocoding cuando el usuario reubica el pin */
                geocodeService.reverse().latlng(posicion,16).run(function(error, resultado){

                    marker.bindPopup(resultado.address.LongLabel);
                    marker.openPopup();

                    llenarInputs(resultado);

                });

            });

        }

        function llenarInputs(resultado){

            console.log(resultado);
            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.Neighborhood || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';

        }

        function buscarDireccion(){

            if(buscador.value.length > 10){

                provider.search({query:buscador.value + ' ' + document.querySelector('#tarea_estado').value + ' MEX '})
                    .then(resultado => {

                        if(resultado.length > 0){
                            console.log(resultado)
                            /* Limpiar los pines previos */
                            markers.clearLayers();

                            /* Reverse Geocoding cuando el usuario reubica el pin */
                            geocodeService.reverse().latlng(resultado[0].bounds[0],16).run(function(error, resultado){

                                /* Llenar los inputs */
                                llenarInputs(resultado);

                                /* Centrar el mapa */
                                mapa.setView(resultado.latlng);

                                /* Agregar el pin */
                                marker = new L.marker(resultado.latlng,{

                                    draggable:true,
                                    autoPan:true

                                }).addTo(mapa);

                                /* Asignar el contenedor de markers el nuevo pin */
                                markers.addLayer(marker);

                                /* Mover el pin */
                                reubicarPin(marker);

                            });
                        }else{
                            alert("No hay resultados para: " + buscador.value + ', ' + document.querySelector('#tarea_estado').value + ', MEX ' + " arrastra el pin a tu ubicación")
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });

            }
        }


        /* MODAL */
        $('#modalUbicacion').on('shown.bs.modal', function() {
            mapa.invalidateSize();
        });

    });
}
