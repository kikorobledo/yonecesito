document.addEventListener('DOMContentLoaded', () => {

    $(".boton-publicar-primera").click(function () {
        $(".publicar-primera").addClass('hideMe');
        $(".publicar-segunda").removeClass('hideMe');
    });

    $(".boton-publicar-segunda").click(function () {
        $(".publicar-segunda").addClass('hideMe');
        $(".publicar-tercera").removeClass('hideMe');
    });

    $(".boton-publicar-tercera").click(function () {
        $(".publicar-segunda").addClass('hideMe');
        $('#modalIngresar').modal("show");
    });

    $(".cerrar-publicar-oferta").click(function () {
        $(".publicar-primera").removeClass('hideMe');
        $(".publicar-segunda").addClass('hideMe');
        $(".publicar-tercera").addClass('hideMe');
    });

});
