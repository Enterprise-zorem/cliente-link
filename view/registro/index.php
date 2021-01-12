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
                            <a href="<?php echo RUTA?>"><img src="<?php echo RUTA?>res/img/logotipo-links-otykufyt3eygrl1ctbyr72f9s1kgflk66crddt2szg.png" alt=""></a>
                        </div>
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Registre una cuenta</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="form-registro" name="form-registro" action="<?php echo RUTA; ?>process.php/registro/insert" class="signup_validate">
                                    <div class="form-group">
                                        <label>Nombres</label>
                                       
                                        <input type="text" class="form-control" placeholder="username" name="registro__nombre">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="hello@example.com"
                                            name="registro__email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="registro__password">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>¿Ya tienes una cuenta? <a class="text-primary" href="<?php echo RUTA; ?>login">Inicia sesión</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
