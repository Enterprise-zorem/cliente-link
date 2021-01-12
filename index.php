<?php
session_start();
include "config/View.php";
?>
<!doctype html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="./src/master.css">
        <link rel="manifest" href="manifest.json">
        <link rel="apple-touch-icon" href="./images/logo192.png">
<?php
    $file = View::load('index');

        if (file_exists($file . "head.php") && $file <> "view/") {
            include $file . "head.php";
        }
    
    ?>
    <?php
    $file = View::load('index');

        if (file_exists($file . "header.php") && $file <> "view/") {
            include $file . "header.php";
        }
    
?>
</head>

<body>

    <?php
    
    //START LOGIN - REGISTRO
    $file = View::load('index');
    if ($file == "view/login/" || $file == "view/registro/") {
        //no hace nda
    } else if (!isset($_SESSION['links__id_user'])) {
        echo "<script>window.location.replace('".RUTA."login'); </script>";
    }
    //END LOGIN - REGISTRO
    
    $file = View::load('index');
    if (file_exists($file . "index.php") && $file <> "view/") {
        include $file . "index.php";
    }
    else
    {
         //header("Location: 404");
         echo "<script>window.location.replace('".RUTA."404');</script>";
    }
    ?>
    <script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="<?php echo RUTA ?>res/js/sweetalert2.all.js"></script>
    <?php
    $file = View::load('index');
        if (file_exists($file . "footer.php") && $file <> "view/") {
            include $file . "footer.php";
        }
    
    ?>
    <?php
    //cargar archivo js de la vista
    $file = View::script('index');

        if (file_exists($file . "index.js") && $file <> "action/") {
            $file = RUTA . $file . "index.js";
            echo "<script type='text/javascript' src='" . $file . "'></script>";
        }
    
    ?>
</body>

</html>