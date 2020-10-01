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

        $('.anim1').velocity("transition.slideUpBigIn", {
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


        $(document).off('click', ".readerPistolBox button");
        $(document).on('click', '.readerPistolBox button', function(e) {

            var devolVal = $(document).find('#productoBox').val();
            if (devolVal == '') {
                $.growl.error({
                    message: "Debe ingresar el codigo de barras del producto"
                });
                return;
            }
            getThisProd();
        });
        $(document).find('#productoBox').keypress(function(e) {
            if (e.which == 13) {

                var devolVal = $(document).find('#productoBox').val();
                if (devolVal == '') {
                    $.growl.error({
                        message: "Debe ingresar el codigo de barras del producto"
                    });
                    return;
                }
                getThisProd();
            }
        });

    }, 1000);

    function getThisDevol() {
        $('.searchingBtn').html('<i class="fa fa-spinner fa-spin"></i>');
        var devolVal = $(document).find('#buscarDevol').val(),
            formData = new FormData();
        formData.append('devolVal', devolVal);
        formData.append('meth', 'consultarDevol');
        apiCall(formData, function(data) {
            $('.searchingBtn').html('<i class="fa fa-search"></i>');
            var resp = JSON.parse(data.resp.GetReturnOrdenByNumberResult);
            console.log(resp);
            console.log(resp.pedidoList.length);
            if (resp.pedidoList.length > 0) {
                $('.anim3').velocity("transition.slideUpBigOut", {
                    duration: 200,
                    complete: function() {
                        var code = '';
                        $('.listadoDevol tbody').html(code);
                        for (i = 0; i < resp.pedidoList.length; i++) {
                            $('.listadoDevol tbody').append(' <tr class="thisDevolProd">' +
                                '<td class="codArticulo" data-valtype="codArticulo">' + resp.pedidoList[i].codArticulo + '</td>' +
                                '<td class="codigoBarras" data-valtype="codigoBarras">' + resp.pedidoList[i].codigoBarras + '</td> ' +
                                '<td class="descricion" data-valtype="descricion">' + resp.pedidoList[i].descricion + '</td> ' +
                                '<td class="descricion" data-valtype="descricion">' + resp.pedidoList[i].referencia + '</td> ' +
                                '<td class="unidadesTotales" data-valtype="unidadesTotales">' + resp.pedidoList[i].unidadesTotales + '</td> ' +
                                ' </tr>');
                        }

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
                });
            } else {
                $.growl.error({
                    message: "No existen documentos por procesar"
                });
                return;
            }
        });
    }

    function getThisProd() {
        var codbar = $(document).find('#productoBox').val(),
            isInvoked = 0,
            isPresent = 0;
        $(document).find('.listadoDevol tbody tr').each(function(i, n) {
            var codigoBarras = $(n).find('.codigoBarras').html(),
                totalUnidades = $(n).find('.unidadesTotales').html();

            if (codigoBarras == codbar) {
                isPresent = 1;
                $(document).find('.porDevolInfoBox').each(function(ii, nn) {
                    var codigoBarrasDevuelto = $(nn).find('.codigoBarrasDevuelto').html();
                    if (codigoBarras == codigoBarrasDevuelto) {
                        isInvoked = 1;
                        var unidTotales = $(nn).find('.unidTotales').html(),
                            unidXDevolver = $(nn).find('.unidXDevolver').html();
                        if (+unidXDevolver < +unidTotales) {
                            unidXDevolver++;
                            var newPropor = (+unidXDevolver * 100) / +unidTotales
                            $(nn).find('.unidXDevolver').html(unidXDevolver);
                            $(nn).find('.unidXDevolverPropor').attr('style', 'width: ' + newPropor.toFixed(0) + '%');
                            if(+unidXDevolver == +unidTotales){
                                $(nn).find('.card').addClass('bg-info text-white');
                            }
                        } else {
                            $.growl.error({
                                message: "No puedes exceder el límite de la Orden"
                            });
                        }
                    }
                });
                if (isInvoked == 0) {
                    var newPropor = 100 / +totalUnidades
                    var invoke = `
                        <div class="col-sm-12 col-lg-12 col-xl-6 porDevolInfoBox">
                            <div class="card anim cod_` + codigoBarras + `">
                                <div class="card-header">
                                    <div class="card-title"><i class="fa fa-barcode "></i> <strong class=" codigoBarrasDevuelto">` + codigoBarras + `</strong></div>
                                    <div class="card-options">
                                        <i class="fa fa-times float-left pull-left "></i> </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <label class="tx-12">Unidades Totales</label>
                                            <h2 class="font-weight-normal unidTotales">` + totalUnidades + `</h2>
                                        </div>
                                        <div class="col border-left text-center">
                                            <label class="tx-12">Por Devolver</label>
                                            <h2 class="font-weight-normal unidXDevolver">1</h2>
                                        </div>
                                    </div>
                                    <div class="progress mt-4">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-join unidXDevolverPropor" style="width: ` + newPropor + `%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                    $(invoke).insertAfter('.readerPistolBox');
                    $('.cod_' + codigoBarras).velocity("transition.slideUpBigIn", {
                        stagger: 250
                    });
                }
            }
        });
        if (isPresent == 0) {
            $.growl.error({
                message: "Este producto no se encuentra en la Orden "
            });
        }
        $(document).find('#productoBox').val('');
        $(document).find('#productoBox').focus();

    }
</script>