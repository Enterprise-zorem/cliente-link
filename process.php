<?php
define("RUTA", "http://localhost/cliente-link/");

date_default_timezone_set('America/Lima');


spl_autoload_register(function ($class) {
	if (file_exists("model/$class/$class.class.php")) {
		include_once "model/$class/$class.class.php";
	}
});

$url = $_SERVER["REQUEST_URI"]; //obtenemos la url
$url = explode("/", rtrim($url, "/")); //convertimos array manejable
$url = array_filter($url); //elimna los espacios
unset($url[1]); //elimina la url usuario 
unset($url[2]); //elimina la url process.php
$url = array_values($url); //reiniciamos el contador del array

$longitud = count($url);
$file = "action/";
for ($i = 0; $i < $longitud; $i++) {
	if (file_exists($file . $url[$i] . ".php")) {
		$file = $file . $url[$i] . ".php";
		break;
	} else {
		$file = $file . $url[$i] . "/";
	}
}

if (file_exists($file."index.php")) {
	include $file."index.php";
} 
else if(file_exists($file))
{
	include $file;
}
else {
	echo "RUTA NO ACEPTADA";
}