<?php 
$session=new Session();
$session=$session->getValue('links__id_user');
if($session)
{
    header("Location: ".RUTA);
}
?>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                            <div class="mini-logo text-center my-5">
                                <a href="<?php echo RUTA; ?>"><img src="<?php echo RUTA; ?>res/img/logotipo-links-otykufyt3eygrl1ctbyr72f9s1kgflk66crddt2szg.png" alt=""></a>
                            </div>
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Inicia sesión</h4>
                                
                            </div>
                            <?php 
                                include_once "./config/google.php";
                                $login_url=$google_client->createAuthUrl();
                            ?>
                            <?php 
                                 include_once "./config/facebook.php";
                            ?>
                             <a href="<?php echo $login_url; ?>" class="btn btn-success btn-block"><i  class="fa fa-google "></i> Inicia sesión con Google</a>
                            <a href="<?php echo $facebook_login_url; ?>" class="btn btn-success btn-block"><i  class="fa fa-facebook-square "></i> Inicia sesión con Facebook</a>

                            <div class="card-body">
                                <form method="post" name="form-login" id="form-login" class="signin_validate" action="<?php echo RUTA ?>process.php/login/login">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="hello@example.com"
                                            name="login__email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="login__password">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group mb-0">
                                            <label class="toggle">
                                               <!-- <input class="toggle-checkbox" type="checkbox">
                                                <span class="toggle-switch"></span>
                                                <span class="toggle-label">Remember me</span>
                                                -->
                                            </label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <a href="reset.html">¿Se te olvidó tu contraseña?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>¿No tienes una cuenta? <a class="text-primary" href="<?php echo RUTA ?>registro">Regístrate</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

    