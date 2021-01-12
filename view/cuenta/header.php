

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo RUTA ?>res/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo RUTA ?>res/vendor/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo RUTA ?>res/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo RUTA ?>res/vendor/toastr/toastr.min.css">
    <?php
    $session=new Session();
    if($session->issetValue('links__mode'))
    {
    ?>
    <link rel="stylesheet" href="<?php echo RUTA ?>res/css/style.dark.css">
    <link rel="stylesheet" href="<?php echo RUTA ?>res/css/style_zorem.dark.css">
    <?php 
    }
    else
    {
        ?>
     <link rel="stylesheet" href="<?php echo RUTA ?>res/css/style.white.css">
    <link rel="stylesheet" href="<?php echo RUTA ?>res/css/style_zorem.white.css">
        <?php
    }

    ?>