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

        /** CUANDO INICIA EL MODULO CARGAMOS LAS PRIMERAS TARJETAS */
        $('.anim1').velocity("transition.slideUpBigIn", {
            stagger: 250,
            complete: function() {
                $('#buscarDevol').focus();
            }
        });

        /** LE RESTAMOS 1 UNIDAD AL LISTADO SELECCIONADO */
        $(document).off('click', ".restarUnidad");
        $(document).on('click', '.restarUnidad', function(e) {

            var codigoBarrasDevuelto = $(this).parent().parent().parent().find('.codigoBarrasDevuelto').html(),
                unidTotales = $(this).parent().parent().parent().find('.unidTotales').html(),
                unidXDevolver = $(this).parent().parent().parent().find('.unidXDevolver').html();

            unidXDevolver--;
            if (unidXDevolver == 0) {
                $(this).parent().parent().parent().parent().remove();
                return;
            }
            var newPropor = (+unidXDevolver * 100) / +unidTotales
            $(this).parent().parent().parent().find('.unidXDevolver').html(unidXDevolver);
            $(this).parent().parent().parent().find('.unidXDevolverPropor').attr('style', 'width: ' + newPropor.toFixed(0) + '%');
        });

        /** ELIMINAMOS EL LISTADO SELECCIONADO */
        $(document).off('click', ".eliminarUnidades");
        $(document).on('click', '.eliminarUnidades', function(e) {
            $(this).parent().parent().parent().parent().remove();
            return;
        });

        /** GUARDAMOS EL TRASLADO */
        $(document).off('click', "#saveNewDevol");
        $(document).on('click', '#saveNewDevol', function(e) {

            var rowsCount = 0,
                reubDet = [],
                userId = $('#sidebarLoaded').attr('userIdPanel');

            $(document).find('.listadoTraslad tbody tr').each(function(i, n) {

                var reubRow = {};
                reubRow.prod = $(n).find('.codigoBarras').html();
                reubRow.orig = $(n).find('.origProd').attr('data-origProd');
                reubRow.dest = $(n).find('.destProd').attr('data-destProd');
                reubRow.tiporig = $(n).find('.tipOrigProd').html();
                reubRow.tipdest = $(n).find('.tipDestProd').html();
                reubRow.totalUnidades = $(n).find('.cantProd').html();

                reubDet.push(reubRow);
                rowsCount++;
            });

            if (rowsCount > 0) {

                $(this).velocity("transition.slideUpOut", {
                    duration: 200,
                    complete: function() {
                        $('#saveNewDevolFake').velocity("transition.slideUpIn", {
                            duration: 200,
                            complete: function() {
                                console.log(reubDet);
                                var formData = new FormData(),
                                    userId = $('#sidebarLoaded').attr('userIdPanel');
                                formData.append('userReub', userId);
                                formData.append('objReub', JSON.stringify(reubDet));
                                formData.append('meth', 'saveNewReub');
                                apiCall(formData, function(data) {
                                    console.log(data);
                                    if (data.status == "saved") {
                                        $('.anim3,.porDevolInfoBox,#saveNewDevolFake').velocity("transition.slideUpOut", {
                                            duration: 200,
                                            complete: function() {
                                                swal({
                                                    title: "Felicitaciones",
                                                    text: "Su Devolucion ha sido registrada exitosamente.",
                                                    type: "success",
                                                    showCancelButton: false,
                                                    confirmButtonText: 'Entendido',
                                                    cancelButtonText: 'salir'
                                                });
                                                $('.porDevolInfoBox').remove();
                                                $('.anim11,#saveNewDevol').velocity("transition.slideUpIn", {
                                                    duration: 200
                                                })
                                            }
                                        });
                                    } else {
                                        $('#saveNewDevolFake').velocity("transition.slideUpOut", {
                                            duration: 200,
                                            complete: function() {
                                                swal({
                                                    title: "Lo Sentimos",
                                                    text: "Hubo un problema para guardar sus datos, intente de nuevo",
                                                    type: "error",
                                                    showCancelButton: false,
                                                    confirmButtonText: 'Entendido',
                                                    cancelButtonText: 'salir'
                                                });
                                                $('#saveNewDevol').velocity("transition.slideUpIn", {
                                                    duration: 200
                                                })
                                            }
                                        });
                                    }
                                });

                            }
                        });
                    }
                });
            } else {
                $.growl.error({
                    message: "No hay productos leidos para reubicar"
                });
            }

        });


        enterSubm();
    }, 1000);

    /** AL LEER CON PISTOLA UN CODIGO DE BARRA */
    function getThisProd() {

        var origVal = $(document).find('#cajamasterBox').val(),
            destVal = $(document).find('#locationBox').val(),
            prodVal = $(document).find('#productoBox').val(),
            tiporigVal = $(document).find("input[type=radio][name=orig-radios]:checked").val(),
            tipdestVal = $(document).find("input[type=radio][name=dest-radios]:checked").val(),
            isPresent = 0;

        if (tiporigVal == 'C') {
            tipdestVal = 'U';
        }
        $(document).find('.listadoTraslad tbody tr').each(function(i, n) {
            var prod = $(n).find('.codigoBarras').html(),
                orig = $(n).find('.origProd').attr('data-origProd'),
                dest = $(n).find('.destProd').attr('data-destProd'),
                tiporig = $(n).find('.tipOrigProd').html(),
                tipdest = $(n).find('.tipDestProd').html(),
                totalUnidades = $(n).find('.cantProd').html();

            if (prod == prodVal && destVal == dest && origVal == orig && tiporigVal == tiporig && tipdestVal == tipdest) {
                isPresent = 1;
                totalUnidades = +totalUnidades + 1;
                $(n).find('.cantProd').html(totalUnidades);
            }
        });
        if (isPresent == 0) {
            $('.listadoTraslad tbody').append(' <tr class="thisTrasladoProd">' +
                '<td class="codigoBarras" data-valtype="codigoBarras">' + prodVal + '</td>' +
                '<td class="origProd" data-origProd="' + origVal + '">(' + tiporigVal + ')-' + origVal + '</td> ' +
                '<td class="destProd" data-destProd="' + destVal + '">(' + tipdestVal + ')-' + destVal + '</td> ' +
                '<td class="cantProd" data-valtype="cantProd">' + 1 + '</td> ' +
                '<td class="offscreen tipOrigProd" data-valtype="tipOrigProd">' + tiporigVal + '</td> ' +
                '<td class="offscreen tipDestProd" data-valtype="tipDestProd">' + tipdestVal + '</td> ' +
                ' </tr>');

            $('.anim11').velocity("transition.slideUpBigOut", {
                stagger: 250,
                complete: function() {
                    $('.anim3').velocity("transition.slideUpBigIn", {
                        stagger: 250,
                        complete: function() {
                            $('#productoBox').focus();
                        }
                    });
                }
            });
        }
        $(document).find('#productoBox').val('');
        $(document).find('#productoBox').focus();

    }


    /** FUNCIONALIDAD DE LOS INPUT */
    function enterSubm() {
        /*  ORIGEN! */
        $('.cajamasterBoxInp').keypress(function(e) {
            if (e.which == 13) {
                $('.locationBoxInp').val('');
                $('.locationBoxInp').focus();
            }
        });

        /*  DESTINO! */
        $('.locationBoxInp').on('keypress', function(e) {
            if (e.which == 13) {
                $('.productoBoxInp').val('');
                $('.productoBoxInp').focus();
            }
        });
        $('.productoBoxInp').keypress(function(e) {
            if (e.which == 13) {
                var origVal = $(document).find('#cajamasterBox').val(),
                    destVal = $(document).find('#locationBox').val(),
                    prodVal = $(document).find('#productoBox').val();
                if (origVal == '' || destVal == '' || prodVal == '') {
                    $.growl.error({
                        message: "Debe llenar todos los campos"
                    });
                    return;
                }
                getThisProd();
            }
        });

        $(document).off('change', "input[type=radio][name=orig-radios]");
        $(document).on('change', "input[type=radio][name=orig-radios]", function(e) {
            console.log(this.value);
            if (this.value == 'U') {
                $(document).find('.DestRadios').slideDown('slow');
            } else if (this.value == 'C') {
                $(document).find('.DestRadios').slideUp('slow');
            }
        });

        /** AL PRESIONAR EL BOTON EL CODIGO DE BARRA Y LO CARGAMOS AL LISTADO */
        $(document).off('click', ".readerPistolBox button.envi");
        $(document).on('click', '.readerPistolBox button.envi', function(e) {

            var origVal = $(document).find('#cajamasterBox').val(),
                destVal = $(document).find('#locationBox').val(),
                prodVal = $(document).find('#productoBox').val();
            if (origVal == '' || destVal == '' || prodVal == '') {
                $.growl.error({
                    message: "Debe llenar todos los campos"
                });
                return;
            }
            getThisProd();
        });

    }
</script>