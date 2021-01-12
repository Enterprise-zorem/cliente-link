
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <?php 
        include "view/body_header.php";
        ?>

        
<div class="page-title dashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-title-content">
                            <p>Bienvenido de nuevo,
                                <span><?php echo $cliente['nombres']; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="card settings_menu">
                            <div class="card-header">
                                <h4 class="card-title">Configuraciones</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li class="nav-item">
                                        <a href="<?php echo RUTA ?>cuenta" class="nav-link active">
                                            <i class="la la-user"></i>
                                            <span>Editar Perfil</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Perfil del usuario</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="form-cuenta-name" name="form-cuenta-name" action="<?php echo RUTA ?>process.php/cuenta/updaten" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Tu Nombre</label>
                                                    <input name="cuenta__nombres" type="text" class="form-control" placeholder="Name" value="<?php echo $cliente['nombres']; ?>">
                                                </div>                                                    
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Numero de Celular</label>
                                                    <input type="text" name="cuenta__telefono" class="form-control" placeholder="Celular" value="<?php echo $cliente['telefono']; ?>">
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary waves-effect">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Perfil del usuario</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="form-cuenta-email" name="form-cuenta-email" action="<?php echo RUTA ?>process.php/cuenta/updatee" method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Nuevo Correo</label>
                                                    <input name="cuenta__email" type="email" class="form-control" placeholder="Email" value="<?php echo $cliente['email']; ?>">
                                                </div>
                                                <div class="form-group col-xl-12">
                                                    <label class="mr-sm-2">Nueva contraseña</label>
                                                    <input name="cuenta__password" type="password" class="form-control"
                                                        placeholder="**********">
                                                    <p class="mt-2 mb-0">Si no desea cambiarlo, dejarlo vacio
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary waves-effect">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include "view/footer.php";
        ?>

    </div>
