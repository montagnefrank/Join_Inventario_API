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

        $(document).find('.anim').velocity("transition.slideUpBigIn", {
            stagger: 250
        });
        enterSubm();

        $(document).off('click', "#addNewLecturaPistola");
        $(document).on('click', '#addNewLecturaPistola', function(e) {
            newProductRead();
        });

        $(document).off('click', ".deleteThisLectura");
        $(document).on('click', '.deleteThisLectura', function(e) {
            var currentTotal = $('.totalRead').html();
            var cant = $(this).parent().parent().find('.cant').html();
            currentTotal = +currentTotal - +cant;
            $('.totalRead').html(currentTotal);
            $(this).parent().parent().remove();
        });

        $(document).off('click', "#saveTomaLecturas");
        $(document).on('click', '#saveTomaLecturas', function(e) {

            var rowsCount = 0,
                inventariodetail = [],
                userId = $('#sidebarLoaded').attr('userIdPanel'),
                gondolaVal = $('#gondolaBox').val();

            if (gondolaVal == '') {
                $.growl.error({
                    message: "Debe ingresar el codigo de Góndola"
                });
                return;
            }

            $(document).find('.listadoTomaFisica tbody tr').each(function(i, n) {

                var inventarioRow = {};
                inventarioRow.bodega = $(n).find('.bode').html();
                inventarioRow.ubicacion = $(n).find('.locat').html();
                inventarioRow.cajamaster = $(n).find('.cajam').html();
                inventarioRow.codbarras = $(n).find('.prod').html();
                inventarioRow.unidades = $(n).find('.cant').html();
                inventarioRow.usuario = userId;
                inventarioRow.gondola = gondolaVal;

                inventariodetail.push(inventarioRow);

                rowsCount++;
            });

            if (rowsCount > 0) {

                $(this).velocity("transition.slideUpOut", {
                    duration: 200,
                    complete: function() {
                        $('#saveTomaLecturasFake').velocity("transition.slideUpIn", {
                            duration: 200,
                            complete: function() {

                                var currentTotal = $('.totalRead').html();
                                var invent = {};
                                invent.inventario = {};
                                invent.inventario.inventariodetail = inventariodetail;
                                invent.inventario.filas = currentTotal;
                                var formData = new FormData(),
                                    userId = $('#sidebarLoaded').attr('userIdPanel');
                                formData.append('userToma', userId);
                                formData.append('inventario', JSON.stringify(invent));
                                formData.append('meth', 'saveNewToma');
                                apiCall(formData, function(data) {
                                    console.log(data);
                                    if (data.status == "saved") {
                                        $(document).find('.listadoTomaFisica tbody').html('');
                                        $('#saveTomaLecturasFake').velocity("transition.slideUpOut", {
                                            duration: 200,
                                            complete: function() {
                                                $('#gondolaBox').val('');
                                                $('.totalRead').html('0');
                                                swal({
                                                    title: "Felicitaciones",
                                                    text: "Su toma ha sido registrada exitosamente.",
                                                    type: "success",
                                                    showCancelButton: false,
                                                    confirmButtonText: 'Entendido',
                                                    cancelButtonText: 'salir'
                                                });
                                                $('#saveTomaLecturas').velocity("transition.slideUpIn", {
                                                    duration: 200
                                                })
                                            }
                                        });
                                    } else {
                                        //$(document).find('.listadoTomaFisica tbody').html('');
                                        $('#saveTomaLecturasFake').velocity("transition.slideUpOut", {
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
                                                $('#saveTomaLecturas').velocity("transition.slideUpIn", {
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
                    message: "No hay filas para enviar"
                });
            }

        });

        $(document).off('change', "input[type=radio][name=caja-radios]");
        $(document).on('change', "input[type=radio][name=caja-radios]", function(e) {
            console.log(this.value);
            if (this.value == 'sincajamaster') {
                $(document).find('.cajamasterBoxInpG').slideUp('slow');
                $(document).find('#cajamasterBox').val('0000');
            } else if (this.value == 'cajamaster') {
                $(document).find('#cajamasterBox').val('');
                $(document).find('.cajamasterBoxInpG').slideDown('slow');
            }
        });
    }, 1000);

    // CREAR ARREGLO DE FECHAS DIA POR DIA
    function getDateArray(type = 'normal') {
        // CREAMOS EL RANGO DE FECHAS QUE SE MOSTRARA EN EL GRAFICO
        var startDate = new Date("2019-11-11");
        var today = new Date(),
            dd = today.getDate() + 1,
            mm = today.getMonth() + 1,
            yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        today = yyyy + '-' + mm + '-' + dd;
        var endDate = new Date(today);

        var arr = new Array();
        var dt = new Date(startDate);
        while (dt <= endDate) {
            var thisday = new Date(dt),
                d = thisday.getDate() + 1,
                m = thisday.getMonth() + 1,
                y = thisday.getFullYear();
            if (d < 10) {
                d = '0' + d;
            }
            if (m < 10) {
                m = '0' + m;
            }
            if (m == 11) {
                if (d == 31) {
                    d = '01';
                    m = '12';
                }
            }
            if (m == 12) {
                if (d == 32) {
                    d = '01';
                    m = '01';
                }
            }
            if (type == 'normal') {
                thisday = m + '-' + d;
            } else {
                thisday = y + '-' + m + '-' + d;
            }
            arr.push(thisday);
            dt.setDate(dt.getDate() + 1);
        }

        return arr;
    }

    /** FUNCIONALIDAD DE LOS INPUT */
    function enterSubm() {
        $('.locationBoxInp').on('keypress', function(e) {
            if (e.which == 13) {
                if ($('input[name=caja-radios]:checked').val() == 'cajamaster') {
                    $('.cajamasterBoxInp').val('');
                    $('.cajamasterBoxInp').focus();
                } else {
                    $('.productoBoxInp').val('');
                    $('.productoBoxInp').focus();
                }
            }
        });
        $('.cajamasterBoxInp').keypress(function(e) {
            if (e.which == 13) {
                $('.productoBoxInp').val('');
                $('.productoBoxInp').focus();
            }
        });
        $('.productoBoxInp').keypress(function(e) {
            if (e.which == 13) {
                newProductRead();
            }
        });
    }

    /** NUEVA LECTURA DE PRODUCTO */
    function newProductRead() {

        var bode = $(document).find('#selectBodegaPls').val(),
            locat = $(document).find('#locationBox').val(),
            cajam = $(document).find('#cajamasterBox').val(),
            prod = $(document).find('#productoBox').val(),
            isPresent = 0;

        if (bode == '' || locat == '' || cajam == '' || prod == '') {
            $.growl.error({
                message: "Debes capturar todos los campos"
            });
            return false;
        }

        $(document).find('.listadoTomaFisica tbody tr').each(function(i, n) {
            var bodeRow = $(n).find('.bode').html(),
                locatRow = $(n).find('.locat').html(),
                cajamRow = $(n).find('.cajam').html(),
                prodRow = $(n).find('.prod').html(),
                cantRow = $(n).find('.cant').html();

            if (bode == bodeRow && locat == locatRow && cajam == cajamRow && prod == prodRow) {
                cantRow = +cantRow + 1;
                $(n).find('.cant').html(cantRow);
                isPresent = 1;
                $.growl.notice({
                    message: "Registrado exitosamente Item: " + prod
                });
            }
        });

        if (isPresent == 0) {
            $('.listadoTomaFisica tbody')
                .append(' <tr>' +
                    '<th scope="row" class="bode" data-valtype="bode">' + bode + '</th>' +
                    '<td class="locat" data-valtype="locat">' + locat + '</td> ' +
                    '<td class="cajam" data-valtype="cajam">' + cajam + '</td> ' +
                    '<td class="prod" data-valtype="prod">' + prod + '</td> ' +
                    '<td class="cant" data-valtype="cant">1</td> ' +
                    '<td><button class="btn btn-danger deleteThisLectura " ><i class="fa fa-trash-o"></i></button></td> ' +
                    ' </tr>');
            $.growl.notice({
                message: "Registrado exitosamente Item: " + prod
            });
        }
        $(document).find('#productoBox').val('');
        $(document).find('#productoBox').focus();

        var currentTotal = $('.totalRead').html();
        currentTotal = +currentTotal + 1;
        $('.totalRead').html(currentTotal);

        return true;
    }
</script>