<div class="page">
    <div class="page-main">
        <div class="app-content  my-3 my-md-5" id="appContent">
            <div class="side-app">
                <div class="page-header">
                    <h4 class="page-title">Toma Física</h4>
                    <a id="updateCharts" class="btn btn-outline-primary btn-pill "><i class="fa fa-refresh"></i></a>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">___APPNAME___</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nueva toma de Inventario</li>
                    </ol>
                </div>
                <div class="row waitPls">
                    <div class="col-lg-12">
                        <div class="alert alert-primary d-none d-lg-block" role="alert">
                            <strong>Actualizando...</strong> <i class="fa fa-refresh fa-2x fa-spin"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 ">
                    <div class="card m-b-20 anim">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="mdi mdi-barcode-scan"></i> Lectura de datos</h3>
                            <div class="card-options">
                                <!--  <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <label class="form-label">Bodega</label>
                                <select id="selectBodegaPls" class="form-control btn btn-primary " data-placeholder="Seleccione">
                                    <option value="21">21</option>
                                    <option value="01">01</option>
                                    <option value="20">20</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary" type="button">Ubicación</button>
                                    </span>
                                    <input type="number" class="form-control locationBoxInp" id="locationBox" placeholder="Ingresar">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-radio ">
                                    <input type="radio" class="custom-control-input" name="caja-radios" value="cajamaster" checked>
                                    <span class="custom-control-label">Caja Master</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="caja-radios" value="sincajamaster">
                                    <span class="custom-control-label">Solo Ubicación</span>
                                </label>
                                <div class="input-group cajamasterBoxInpG">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary" type="button">Caja Master</button>
                                    </span>
                                    <input type="text" class="form-control cajamasterBoxInp" id="cajamasterBox" placeholder="Ingresar Código">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary" type="button">Producto</button>
                                    </span>
                                    <input type="text" class="form-control productoBoxInp" id="productoBox" placeholder="Ingresar Código">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-info " id="addNewLecturaPistola"><i class="fa fa-plus"></i>Registrar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="card anim">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-list"></i> Productos Registrados</h3>
                            <div class="card-options">
                                <span class="badge badge-primary float-right pull-right totalProdsBox">Total <i class="fa fa-check-square"></i> <strong class="totalRead">0</strong></span>
                                <!-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
											<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap table-primary listadoTomaFisica">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-white">Bodega</th>
                                        <th class="text-white">Ubicación</th>
                                        <th class="text-white">Caja Master</th>
                                        <th class="text-white">Producto</th>
                                        <th class="text-white">Cantidad</th>
                                        <th class="text-white">Borrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive -->

                        <div class="card-footer ">
                            <div class="d-flex">
                                <div class="input-group gondolaBoxInpG">
                                    <span class="input-group-append">
                                        <button class="btn btn-primary" type="button">Góndola</button>
                                    </span>
                                    <input type="number" class="form-control gondolaBoxInp" id="gondolaBox" placeholder="Ingresar Código">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <div class="d-flex">
                                <button class="btn btn-primary ml-auto" id="saveTomaLecturas"><i class="fa fa-save"></i>Guardar Datos</button>
                                <button class="btn btn-primary ml-auto offscreen" id="saveTomaLecturasFake"><i class="fa fa-refresh fa-spin"></i> Guardando</button>
                            </div>
                        </div>
                    </div>
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