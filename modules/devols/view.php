<div class="page">
    <div class="page-main">
        <div class="app-content  my-3 my-md-5" id="appContent">
            <div class="side-app">
                <div class="page-header">
                    <h4 class="page-title">Devolución de Productos</h4>
                    <a id="updateCharts" class="btn btn-outline-primary btn-pill "><i class="fa fa-refresh"></i></a>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">___APPNAME___</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Devoluciones</li>
                    </ol>
                </div>
                <div class="row offscreen">
                    <div class="col-lg-12">
                        <div class="alert alert-primary d-none d-lg-block" role="alert">
                            <strong>Actualizando...</strong> <i class="fa fa-refresh fa-2x fa-spin"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-xl-3 anim anim1 anim11">
                    <div class="card">
                        <a><img class="card-img-top br-tr-7 br-tl-7" src="___APIURI___assets/img/devols.jpg" alt="Bienvenido"></a>
                        <div class="card-body d-flex flex-column">
                            <h4><a href="#"><i class="fa fa-search"></i> Buscar Orden de Devolución</a></h4>
                        </div>
                        <div class="card-footer d-flex flex-column">
                            <div class="text-muted">Consulte en el sistema la orden para poder actualizar el estado de los prodcutos.</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 anim anim1 buscarDevolBox">
                    <div class="input-group mb-3 ">
                        <input type="number" class="form-control br-tl-7 br-bl-7" id="buscarDevol" placeholder="Ingrese la orden de Devolución">
                        <div class="input-group-append ">
                            <button type="button" class="btn btn-join br-tr-7 br-br-7 searchingBtn text-white">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="card anim anim3">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-list"></i> Orden de Devolución <strong class="ordenTitleNumbr"></strong></h3>
                            <div class="card-options">
                                <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered border-top card-table table-vcenter text-nowrap table-primary listadoDevol">
                                <thead class="bg-join text-white">
                                    <tr>
                                        <th class="text-white">Código</th>
                                        <th class="text-white">Barcode</th>
                                        <th class="text-white">Producto</th>
                                        <th class="text-white">Referencia</th>
                                        <th class="text-white">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 readerPistolBox">
                    <div class="card m-b-20 anim anim3">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="mdi mdi-barcode-scan"></i> Escanear productos</h3>
                            <div class="card-options">
                                <!--  <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control productoBoxInp" id="productoBox" placeholder="Código de Barras">
                                    <span class="input-group-append ">
                                        <button class="btn btn-join text-white" type="button">
                                            Enviar <i class="fa fa-chevron-right "></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 anim anim3 ">
                    <div class="form-group">
                        <button type="button" class="text-white btn btn-join  form-control " id="saveThisDevol">
                            <i class="fa fa-upload "></i> Cargar Devolución
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!--footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        ___DERECHOSDEAUTOR___
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
        <!-- Back to top -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    </div>