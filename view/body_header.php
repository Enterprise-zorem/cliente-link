
        <?php 
                        $session=new Session(new Connexion);
                        if($session->issetValue('links__id_user'))
                        {
                        $session=$session->getValue('links__id_user');
                        $cliente=new clientes(new Connexion);
                        $cliente->setpk($session);
                        $cliente=$cliente->getAllById();
                        $cliente=$cliente->fetch_array(MYSQLI_ASSOC);
                        }
                        ?>

        <div class="header dashboard">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg navbar-light px-0 justify-content-between">
                            <!--<a class="navbar-brand" href="index.html"><img src="<?php echo RUTA;?>res/images/logo.png" alt="">
                            </a>-->
                            <h2>Links.pe</h2>

                            <div class="dashboard_log my-2">
                                <div class="d-flex align-items-center">
                                    <div class="account_money">
                                    <?php
                                    $ruta=View::ID();
                                    if($ruta=="home"){
                                        ?> 
                                         <ul>
                                            <li class="crypto">
                                                <a @click="btnNuevoLink()"><span>CREAR LINK</span></a>
                                            </li>
                                            <li class="usd">
                                            <a @click="btnNuevoWsp()"><span>WHATSAPP</span></a>
                                            </li>
                                        </ul> 
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="profile_log dropdown">
                                        <div class="user" data-toggle="dropdown">
                                            <span class="thumb"><i class="la la-user"></i></span>
                                            <span class="name"><?php echo $cliente['nombres']; ?></span>
                                            <span class="arrow"><i class="la la-angle-down"></i></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="<?php echo RUTA ?>cuenta" class="dropdown-item">
                                                <i class="la la-user"></i> Cuenta
                                            </a>
                                            <a href="history.html" class="dropdown-item">
                                                <i class="la la-book"></i> History
                                            </a>
                                            <a href="<?php echo RUTA; ?>process.php/home/mode" class="dropdown-item">
                                            <i class="la la-cog"></i>
                                            <?php $session=new Session();
                                                if($session->issetValue('links__mode'))
                                                { echo "Modo Dia"; }else{ echo "Modo Noche";}?>
                                            </a>
                                            <a href="<?php echo RUTA; ?>process.php/login/logout" class="dropdown-item logout">
                                                <i class="la la-sign-out"></i> Logout
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <div class="menu">
                <ul>
                    <li>
                        <a href="<?php echo RUTA ?>home" data-toggle="tooltip" data-placement="right" title="Home">
                            <span><i class="la la-igloo"></i></span>
                        </a>
                    </li>
                    <li><a href="buy-sell.html" data-toggle="tooltip" data-placement="right" title="Exchange">
                            <span><i class="la la-exchange-alt"></i></span>
                        </a>
                    </li>
                    <li><a href="<?php echo RUTA ?>cuenta" data-toggle="tooltip" data-placement="right" title="Cuenta">
                            <span><i class="la la-user"></i></span>
                        </a>
                    </li>
                    <li><a href="<?php echo RUTA ?>suscripcion" data-toggle="tooltip" data-placement="right" title="Suscripcion">
                            <span><i class="la la-shopping-cart"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>