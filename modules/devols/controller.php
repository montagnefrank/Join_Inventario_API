<script class='controller'>
    setTimeout(function() {

        /*           ACTUALIZAR CONTADORES               */
        $(document).off('click', "#updateCharts");
        $(document).on('click', '#updateCharts', function(e) {
            var userIntel = JSON.parse(window.localStorage.getItem("userIntel")),
                panelToShow = userIntel.panelUsuario,
                userId = $('#sidebarLoaded').attr('userIdPanel');
            $("#loading").fadeIn("fast", function() {
                showPanel(panelToShow, userId);
            });
        });

        $('.anim').velocity("transition.slideUpBigIn", {
            stagger: 250,
            complete: function() {
                $('#buscarDevol').focus();
            }
        });


        $(document).off('click', ".buscarDevolBox button");
        $(document).on('click', '.buscarDevolBox button', function(e) {

            var devolVal = $(document).find('#buscarDevol').val();
            if (devolVal == '') {
                $.growl.error({
                    message: "Debe ingresar el codigo de la Orden"
                });
                return;
            }
            getThisDevol();
        });

        $(document).find('#buscarDevol').keypress(function(e) {
            if (e.which == 13) {

                var devolVal = $(document).find('#buscarDevol').val();
                if (devolVal == '') {
                    $.growl.error({
                        message: "Debe ingresar el codigo de la Orden"
                    });
                    return;
                }
                getThisDevol();
            }
        });
    }, 1000);

    function getThisDevol() {

        console.log('test');
        var devolVal = $(document).find('#buscarDevol').val(),
            formData = new FormData();
        formData.append('devolVal', devolVal);
        formData.append('meth', 'consultarDevol');
        $.ajax({
            url: apiURI,
            type: 'POST',
            cache: false,
            dataType: "json",
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                console.log('test2');
                console.log(data);

            },
            error: function(error) {
                console.log("Hubo un error de internet, intente de nuevo");
                console.log(error);
            }
        });
    }
</script>