<?php 
                        $session=new Session(new Connexion);
                        if($session->issetValue('status_paypal'))
                        {
                            $session=$session->getValue('status_paypal');
                        }
                        else
                        {
                            echo "<script>window.location.replace('".RUTA."'); </script>";
                        }
                        ?>

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

    <div class="verification section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="auth-form card">
                            <div class="card-body">
                                <form action="add-debit-card.html" class="identity-upload">
                                    <div class="identity-content">
                                        <?php 
                                        if($session="approved")
                                        {
                                            ?>
                                            <span class="icon"><i class="fa fa-check"></i></span>
                                            <h4>Pago Correcto</h4>
                                            <p>¡Felicidades! su pago se ha verificado correctamente. Seguir</p>
                                            <?php
                                            $session=new Session();
                                            $session->removeValue('status_paypal');
                                        }
                                        else
                                        {
                                            ?>
                                            <span class="icon"><i class="fa fa-close"></i></span>
                                            <h4>Ups..!</h4>
                                            <p><?php var_dump($session); ?></p>
                                            <?php
                                            $session=new Session();
                                            $session->removeValue('status_paypal');
                                        }
                                        ?>
                                    </div>

                                    <div class="text-center mb-4">
                                        <a href="<?php echo RUTA; ?>" class="btn btn-primary pl-5 pr-5">Regresar</a>
                                    </div>
                                </form>
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
