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

        /** BUSCAMOS LA ORDEN DE DEVOLUCION POR EL BOTON O POR LA PISTOLA */
        $(document).off('click', ".buscarDevolBox button");
        $(document).on('click', '.buscarDevolBox button', function(e) {

            var devolVal = $(document).find('#buscarDevol').val();
            if (devolVal == '') {
                $.growl.error({
                    message: "Debe ingresar el codigo de la Orden"
                });
                return;
            }
            getThisTraslado();
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
                getThisTraslado();
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

        /** GUARDAMOS LA  DEVOLUCION */
        $(document).off('click', "#saveNewDevol");
        $(document).on('click', '#saveNewDevol', function(e) {

            var rowsCount = 0,
                devoldetail = [],
                userId = $('#sidebarLoaded').attr('userIdPanel'),
                carritonBox = $('#carritonBox').val();

            if (carritonBox == '') {
                $.growl.error({
                    message: "Debe ingresar el número de carrito"
                });
                return;
            }
            $(document).find('.porDevolInfoBox').each(function(i, n) {
                $(n).find('.thisReadDevol tbody tr').each(function(ii, nn) {

                    var devolRow = {};
                    devolRow.codarticulo = $(nn).find('.codarticuloRead').html();
                    devolRow.talla = $(nn).find('.tallaRead').html();
                    devolRow.color = $(nn).find('.colorRead').html();
                    devolRow.oldquantity = $(nn).find('.oldquantityRead').html();
                    devolRow.type = '22';
                    devolRow.barcode = $(nn).find('.barcodeRead').html();
                    devolRow.returnquantity = $(nn).find('.thisCantAcum').html();
                    devolRow.cajamas = $(nn).find('.cajMasRead').html();
                    devolRow.ubi = $(nn).find('.locatRead').html();;
                    devolRow.doc = $(nn).find('.docRead').html();
                    devolRow.usuario = userId;
                    devolRow.carrito = carritonBox;

                    devoldetail.push(devolRow);

                    rowsCount++;
                });
            });

            if (rowsCount > 0) {

                $(this).velocity("transition.slideUpOut", {
                    duration: 200,
                    complete: function() {
                        $('#saveNewDevolFake').velocity("transition.slideUpIn", {
                            duration: 200,
                            complete: function() {
                                var formData = new FormData(),
                                    userId = $('#sidebarLoaded').attr('userIdPanel');
                                formData.append('userDevol', userId);
                                formData.append('devol', JSON.stringify(devoldetail));
                                formData.append('meth', 'saveNewTraslado');
                                apiCall(formData, function(data) {
                                    console.log(data);
                                    if (data.status == "saved") {
                                        $('.anim3,.porDevolInfoBox,#saveNewDevolFake').velocity("transition.slideUpOut", {
                                            duration: 200,
                                            complete: function() {
                                                swal({
                                                    title: "Felicitaciones",
                                                    text: "Su Traslado ha sido registrado en el sistema exitosamente.",
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
                    message: "No hay productos leidos para recibir"
                });
            }

        });


        enterSubm();
    }, 1000);

    /** OBTENEMOS LOS DATOS DE LA ORDEN DE TRASLADO */
    function getThisTraslado() {
        $('.searchingBtn').html('<i class="fa fa-spinner fa-spin"></i>');
        var trasladoVal = $(document).find('#buscarDevol').val(),
            formData = new FormData(),
            userId = $('#sidebarLoaded').attr('userIdPanel');
        formData.append('userId', userId);
        formData.append('trasladoVal', trasladoVal);
        formData.append('meth', 'consultarTraslado');
        apiCall(formData, function(data) {
            console.log(data);
            $('.searchingBtn').html('<i class="fa fa-search"></i>');
            var resp = JSON.parse(data.resp.GetSolicitudTrasladoResult);
            console.log(resp);
            console.log(resp.pedidoList.length);
            if (resp.pedidoList.length > 0) {
                $('.anim3').velocity("transition.slideUpBigOut", {
                    duration: 200,
                    complete: function() {
                        var code = '';
                        $('.listadoDevol tbody').html(code);
                        $('.ordenTitleNumbr').html(trasladoVal);
                        for (i = 0; i < resp.pedidoList.length; i++) {
                            $('.listadoDevol tbody').append(' <tr class="thisDevolProd">' +
                                '<td class="codArticulo" data-valtype="codArticulo">' + resp.pedidoList[i].codArticulo + '</td>' +
                                '<td class="codigoBarras" data-valtype="codigoBarras">' + resp.pedidoList[i].codigoBarras + '</td> ' +
                                '<td class="descricion" data-valtype="descricion">' + resp.pedidoList[i].todoRecibido + '</td> ' +
                                '<td class="referencia" data-valtype="referencia">' + resp.pedidoList[i].referencia + '</td> ' +
                                '<td class="unidadesTotales" data-valtype="unidadesTotales">' + resp.pedidoList[i].unidadesTotales + '</td> ' +
                                '<td class="unidadesLeidas" data-valtype="unidadesLeidas">0</td> ' +
                                '<td class="offscreen talla" data-valtype="talla">' + resp.pedidoList[i].talla + '</td> ' +
                                '<td class="offscreen color" data-valtype="color">' + resp.pedidoList[i].color + '</td> ' +
                                '<td class="offscreen suPedido" data-valtype="suPedido">' + resp.pedidoList[i].suPedido + '</td> ' +
                                ' </tr>');
                        }
                        $('.anim11').velocity("transition.slideUpBigOut", {
                            stagger: 250,
                            complete: function() {
                                $('.anim3').velocity("transition.slideUpBigIn", {
                                    stagger: 250,
                                    complete: function() {
                                        $('#cajamasterBox').focus();
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

    /** AL LEER CON PISTOLA UN CODIGO DE BARRA */
    function getThisProd() {
        var codbar = $(document).find('#productoBox').val(),
            locatRead = $(document).find('#locationBox').val(),
            cajMasRead = $(document).find('#cajamasterBox').val(),
            isInvoked = 0,
            isListed = 0,
            isPresent = 0;
        $(document).find('.listadoDevol tbody tr').each(function(i, n) {
            var codigoBarras = $(n).find('.codigoBarras').html(),
                codarticuloRead = $(n).find('.codArticulo').html(),
                tallaRead = $(n).find('.talla').html(),
                colorRead = $(n).find('.color').html(),
                docRead = $(n).find('.suPedido').html(),
                totalUnidades = $(n).find('.unidadesTotales').html();

            if (codigoBarras == codbar) {
                var qyt = 1;
                isPresent = 1;

                var formData = new FormData();
                formData.append('codigoArticulo', codarticuloRead);
                formData.append('talla', tallaRead);
                formData.append('color', colorRead);
                formData.append('codigoBarrasCaja', cajMasRead);
                formData.append('meth', 'totalProdsInBox');
                apiCall(formData, function(data) {
                    var resp = JSON.parse(data.result.GetQuantityProductInMasterBoxResult);
                    if (resp.code == '200') {
                        if (resp.quantity <= totalUnidades) {
                            qyt = resp.quantity;
                        }
                    }
                    $(document).find('.porDevolInfoBox').each(function(ii, nn) {
                        var codigoBarrasDevuelto = $(nn).find('.codigoBarrasDevuelto').html();
                        if (codigoBarras == codigoBarrasDevuelto) {
                            isInvoked = 1;
                            var unidXDevolver = $(nn).find('.unidXDevolver').html();
                            if (+unidXDevolver < +totalUnidades) {
                                unidXDevolver = +unidXDevolver + +qyt;
                                var newPropor = (+unidXDevolver * 100) / +totalUnidades
                                $(nn).find('.unidXDevolver').html(unidXDevolver);
                                $(n).find('.unidadesLeidas').html(unidXDevolver);
                                $(nn).find('.unidXDevolverPropor').attr('style', 'width: ' + newPropor.toFixed(0) + '%');
                                if (+unidXDevolver == +totalUnidades) {
                                    $(nn).find('.card').addClass('bg-info text-white');
                                }
                                $(nn).find('.thisReadDevol tbody tr').each(function(iii, nnn) {
                                    var thisLocation = $(nnn).find('.locatRead').html(),
                                        thisCajaMas = $(nnn).find('.cajMasRead').html(),
                                        thisCant = $(nnn).find('.thisCantAcum').html();
                                    if (thisLocation == locatRead && thisCajaMas == cajMasRead) {
                                        isListed = 1;
                                        thisCant++;
                                        $(nnn).find('.thisCantAcum').html(thisCant);
                                    }
                                });
                                if (isListed == 0) {
                                    var listThis = `
                                            <tr>
                                                <td class="text-dark locatRead text-center">` + locatRead + `</td>
                                                <td class="text-dark cajMasRead text-center">` + cajMasRead + `</td>
                                                <td class="text-dark thisCantAcum text-center">` + qyt + `</td>
                                                <td class="offscreen codarticuloRead text-center">` + codarticuloRead + `</td>
                                                <td class="offscreen tallaRead text-center">` + tallaRead + `</td>
                                                <td class="offscreen colorRead text-center">` + colorRead + `</td>
                                                <td class="offscreen oldquantityRead text-center">` + totalUnidades + `</td>
                                                <td class="offscreen barcodeRead text-center">` + codigoBarras + `</td>
                                                <td class="offscreen docRead text-center">` + docRead + `</td>
                                            </tr>
                                            `;
                                    $(nn).find('.thisReadDevol tbody').append(listThis);
                                }
                            } else {
                                $.growl.error({
                                    message: "No puedes exceder el límite de la Orden"
                                });
                            }
                        }
                    });
                    if (isInvoked == 0) {
                        var newPropor = (+qyt * 100) / +totalUnidades
                        var invoke = `
                        <div class="col-sm-12 col-lg-12 col-xl-6 porDevolInfoBox">
                            <div class="card anim cod_` + codigoBarras + `">
                                <div class="card-header">
                                    <div class="card-title"><i class="fa fa-barcode "></i> <strong class=" codigoBarrasDevuelto">` + codigoBarras + `</strong></div>
                                    <div class="card-options ">
                                        <!-- <span class="btn btn-info mr30 float-left restarUnidad"><i class="fa fa-minus"></i> </span> -->
                                        <span class="btn btn-join text-white float-left pull-left mr10 eliminarUnidades"><i class="fa fa-times  "></i> </span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered border-top card-table table-vcenter text-nowrap table-primary thisReadDevol">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <th class="text-white">Ubicacion</th>
                                                <th class="text-white">Caja Master</th>
                                                <th class="text-white">Cantidad</th>
                                                <th class="offscreen">codarticulo</th>
                                                <th class="offscreen">talla</th>
                                                <th class="offscreen">color</th>
                                                <th class="offscreen">oldquantity</th>
                                                <th class="offscreen">barcode</th>
                                                <th class="offscreen">doc</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-dark locatRead text-center">` + locatRead + `</td>
                                                <td class="text-dark cajMasRead text-center">` + cajMasRead + `</td>
                                                <td class="text-dark thisCantAcum text-center">` + qyt + `</td>
                                                <td class="offscreen codarticuloRead text-center">` + codarticuloRead + `</td>
                                                <td class="offscreen tallaRead text-center">` + tallaRead + `</td>
                                                <td class="offscreen colorRead text-center">` + colorRead + `</td>
                                                <td class="offscreen oldquantityRead text-center">` + totalUnidades + `</td>
                                                <td class="offscreen barcodeRead text-center">` + codigoBarras + `</td>
                                                <td class="offscreen docRead text-center">` + docRead + `</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="offscreen "></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-center">
                                            <label class="tx-12">Unidades Totales</label>
                                            <h2 class="font-weight-normal unidTotales">` + totalUnidades + `</h2>
                                        </div>
                                        <div class="col border-left text-center">
                                            <label class="tx-12">A Trasladar</label>
                                            <h2 class="font-weight-normal unidXDevolver">` + qyt + `</h2>
                                        </div>
                                    </div>
                                    <div class="progress mt-4">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-join unidXDevolverPropor" style="width: ` + newPropor + `%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;

                        $(n).find('.unidadesLeidas').html(qyt);
                        $(invoke).insertAfter('.readerPistolBox');
                        $('.cod_' + codigoBarras).velocity("transition.slideUpBigIn", {
                            stagger: 250
                        });
                    }
                });
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


    /** FUNCIONALIDAD DE LOS INPUT */
    function enterSubm() {
        $('.cajamasterBoxInp').keypress(function(e) {
            if (e.which == 13) {
                $('.productoBoxInp').val('');
                $('.productoBoxInp').focus();
            }
        });
        $('.productoBoxInp').keypress(function(e) {
            if (e.which == 13) {
                var devolVal = $(document).find('#productoBox').val(),
                    calaVal = $(document).find('#cajamasterBox').val(); //,
                //locatVal = $(document).find('#locationBox').val();
                if (devolVal == '' || calaVal == '' /* || locatVal == ''*/ ) {
                    $.growl.error({
                        message: "Debe llenar todos los campos"
                    });
                    return;
                }
                getThisProd();
            }
        });

        $(document).find('#locationBox').val('0000');
        $(document).off('change', "input[type=radio][name=caja-radios]");
        $(document).on('change', "input[type=radio][name=caja-radios]", function(e) {
            console.log(this.value);
            if (this.value == 'U') {
                $(document).find('#locationBox').val('');
                $(document).find('.cajamasterBoxInpG').slideUp('slow');
                $(document).find('.locationBoxInpG').slideDown('slow');
                $(document).find('#cajamasterBox').val('0000');
                $('.locationBoxInp').focus();
            } else if (this.value == 'C') {
                $(document).find('#cajamasterBox').val('');
                $(document).find('.cajamasterBoxInpG').slideDown('slow');
                $(document).find('.locationBoxInpG').slideUp('slow');
                $(document).find('#locationBox').val('0000');
                $('.cajamasterBoxInp').focus();
            }
        });

        /** AL PRESIONAR EL BOTON EL CODIGO DE BARRA Y LO CARGAMOS AL LISTADO */
        $(document).off('click', ".readerPistolBox button.envi");
        $(document).on('click', '.readerPistolBox button.envi', function(e) {

            var devolVal = $(document).find('#productoBox').val(),
                calaVal = $(document).find('#cajamasterBox').val(); //,
            //locatVal = $(document).find('#locationBox').val();
            if (devolVal == '' || calaVal == '' /* || locatVal == ''*/ ) {
                $.growl.error({
                    message: "Debe llenar todos los campos"
                });
                return;
            }
            getThisProd();
        });

    }
</script>