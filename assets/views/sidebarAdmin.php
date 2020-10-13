<div class="app-header header py-1 d-flex">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand changePanel" data-panel="homeLogo" href="#">
                <img src="assets/img/logo.png" class="header-brand-img" alt="___APPNAME___">
            </a>
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
            <div>
                <div class="searching">
                    <a href="javascript:void(0)" class="search-open searching1">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="search-inline">
                        <form>
                            <input type="text" class="form-control" placeholder="Ingrese el valor a buscar... " id="navbarSearch">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="javascript:void(0)" class="search-close">
                                <i class="fa fa-times"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex order-lg-2 ml-auto">

                <!-- <div class="pull-right">
                    <label class="custom-switch marg15">
                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="themeSwitch">
                        <span class="custom-switch-indicator"></span>
                        <span class="custom-switch-description text-white themePanelDesc">Modo Noche</span>
                    </label>
                </div> -->
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon" data-toggle="dropdown">
                        <i class="fa fa-bell-o floating"></i>
                        <!-- <span class=" nav-unread badge badge-danger  badge-pill">4</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a href="#" class="dropdown-item text-center">Tienes 0 notificaciones</a>
                        <div class="dropdown-divider"></div>
                        <!-- <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div>
                                <strong>2 mensajes</strong>
                                <div class="small text-muted">17:50 Pm</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div>
                                <strong> 1 Evento</strong>
                                <div class="small text-muted">2019-11-02</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg">
                                <i class="fa fa-comment-o"></i>
                            </div>
                            <div>
                                <strong> 3 comentarios</strong>
                                <div class="small text-muted">05:34 Am</div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item d-flex pb-3">
                            <div class="notifyimg">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <div>
                                <strong> Alerta de app</strong>
                                <div class="small text-muted">13:45 Pm</div>
                            </div>
                        </a> -->
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item text-center">Ver todas las notificaciones</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                        <img src="___PATHTOPROFILEPIC___" alt="profile-img" class="avatar avatar-md brround">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon si si-user"></i> Mi perfil
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                            <i class="dropdown-icon si si-envelope"></i> Inbox
                        </a> -->
                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon  si si-settings"></i> Configurar
                        </a>
                        <a class="dropdown-item logOutBtn" href="#">
                            <i class="dropdown-icon si si-power"></i> Salir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user clearfix" id="sidebarUserInfo">
        <div class="dropdown user-pro-body">
            <div>
                <img src="___PATHTOPROFILEPIC___" alt="user-img" class="avatar avatar-lg brround">
                <a href="#" class="profile-img">
                    <span class="fa fa-pencil" aria-hidden="true"></span>
                </a>
            </div>
            <div class="user-info">
                <h2>___NOMBRESUSUARIO___</h2>
                <span>___ROLUSUARIO___</span>
            </div>
        </div>
    </div>

    <ul class="side-menu" id="sidebarLoaded" userIdPanel="___IDUSUARIO___">
        <li>
            <a class="side-menu__item changePanel" data-panel="home" href="#"><i class="si si-speedometer"></i>&nbsp;<span class="side-menu__label">Inicio</span></a>
        </li> 
        <li class="slide ">
            <a class="side-menu__item" data-toggle="slide" href="#"><i class="mdi mdi-archive"></i><span class="side-menu__label">Inventario</span><i class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item changePanel" data-panel="tomas" href="#"><i class="mdi mdi-barcode-scan"></i>&nbsp;<span>Nueva Toma</span></a></li>
            </ul>
            <ul class="slide-menu">
                <li><a class="slide-item changePanel" data-panel="vertomas" href="#"><i class="si si-magnifier" ></i>&nbsp;<span>Ver Tomas Físicas</span></a></li>
            </ul>
        </li> 
        <li>
            <a class="side-menu__item changePanel" data-panel="devols" href="#"><i class="fa fa-undo"></i>&nbsp;<span class="side-menu__label">Devoluciones</span></a>
        </li>
        <li>
            <a class="side-menu__item changePanel" data-panel="receps" href="#"><i class="fa fa-sign-in"></i>&nbsp;<span class="side-menu__label">Recepciones</span></a>
        </li>
        <li>
            <a class="side-menu__item changePanel" data-panel="trasl" href="#"><i class="fa fa-share-square-o"></i>&nbsp;<span class="side-menu__label">Reubicaciones</span></a>
        </li>
        <li>
            <a class="side-menu__item changePanel" data-panel="traslados" href="#"><i class="fa fa-linode"></i>&nbsp;<span class="side-menu__label">Traslados</span></a>
        </li>
        <li>
            <a class="side-menu__item changePanel" data-panel="userconfig" href="#"><i class="side-menu__icon si si-settings"></i>&nbsp;<span class="side-menu__label">Ajustes</span></a>
        </li>

    </ul>
    <div class="app-sidebar-footer">
        <a href="#">
            <span class="si si-envelope" aria-hidden="true"></span>
        </a>
        <a href="#">
            <span class="si si-user" aria-hidden="true"></span>
        </a>
        <a href="#">
            <span class="si si-settings" aria-hidden="true"></span>
        </a>
        <a href="#" class="logOutBtn">
            <span class="si si-login" aria-hidden="true"></span>
        </a>
        <a href="#">
            <span class="si si-bubble" aria-hidden="true"></span>
        </a>
    </div>
</aside>