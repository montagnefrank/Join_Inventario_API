<div class="page">
    <div class="page-main">
        <div class="app-content  my-3 my-md-5" id="appContent">
            <div class="side-app">
                <div class="page-header">
                    <h4 class="page-title">Reubicacion de Productos</h4>
                    <a id="updateCharts" class="btn btn-outline-primary btn-pill "><i class="fa fa-refresh"></i></a>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">___APPNAME___</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Reubicaciones</li>
                    </ol>
                </div>

                <div class="col-lg-6 col-md-12 col-xl-3 anim anim1 anim11">
                    <div class="card">
                        <a><img class="card-img-top br-tr-7 br-tl-7" src="___APIURI___assets/img/trasl.jpg" alt="Bienvenido"></a>
                        <div class="card-body d-flex flex-column">
                            <h4><a href="#"><i class="fa fa-search"></i> Reubicacion de productos</a></h4>
                        </div>
                        <div class="card-footer d-flex flex-column">
                            <div class="text-muted">Ingrese los productos que desea Reubicar y luego indique los codigos de ubicación que desea registrar.</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 readerPistolBox anim anim1 ">
                    <div class="card m-b-20 ">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="mdi mdi-barcode-scan"></i> Escanear productos</h3>
                            <div class="card-options">
                                <!--  <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="custom-control custom-radio fs10">
                                    <input type="radio" class="custom-control-input" name="orig-radios" value="C" checked>
                                    <span class="custom-control-label">Caja Master</span>
                                </label>
                                <label class="custom-control custom-radio fs10">
                                    <input type="radio" class="custom-control-input" name="orig-radios" value="U">
                                    <span class="custom-control-label">Ubicación</span>
                                </label>
                                <div class="input-group cajamasterBoxInpG">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-join text-white" type="button">Origen</button>
                                    </span>
                                    <input type="text" class="form-control cajamasterBoxInp" id="cajamasterBox" placeholder="Ingresar Código">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group locationBoxInpG">
                                <div class="DestRadios anim">
                                    <label class="custom-control custom-radio fs10">
                                        <input type="radio" class="custom-control-input" name="dest-radios" value="C" checked>
                                        <span class="custom-control-label">Caja Master</span>
                                    </label>
                                    <label class="custom-control custom-radio fs10">
                                        <input type="radio" class="custom-control-input" name="dest-radios" value="U">
                                        <span class="custom-control-label">Ubicación</span>
                                    </label>
                                </div>
                                <div class="input-group ">
                                    <span class="input-group-prepend">
                                        <button class="btn btn-join text-white" type="button">Destino</button>
                                    </span>
                                    <input type="number" class="form-control locationBoxInp" id="locationBox" placeholder="Ingresar">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control productoBoxInp" id="productoBox" placeholder="Código de Barras">
                                    <span class="input-group-append ">
                                        <button class="btn btn-join text-white envi" type="button">
                                            Enviar <i class="fa fa-chevron-right "></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="card anim anim3">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-list"></i> Reubicar Productos </h3>
                            <div class="card-options">
                                <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered border-top card-table table-vcenter text-nowrap table-primary listadoTraslad">
                                <thead class="bg-join text-white">
                                    <tr>
                                        <th class="text-white">Prodcuto</th>
                                        <th class="text-white">Origen</th>
                                        <th class="text-white">Destino</th>
                                        <th class="text-white">Cantidad</th>
                                        <th class="offscreen">tipOrig</th>
                                        <th class="offscreen">tipDest</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 anim anim3 locationBoxInpGDiv">
                    <div class="form-group">
                        <button type="button" class="text-white btn btn-join  form-control " id="saveNewDevol">
                            <i class="fa fa-upload "></i> Cargar Reubicacion
                        </button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="text-white btn btn-join  form-control anim" id="saveNewDevolFake">
                            <i class="fa fa-spinner fa-spin"></i>
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