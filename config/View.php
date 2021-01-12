<?php

define("RUTA", "http://localhost/cliente-link/");
define("RUTA_TOKEN", "links.pe/");
define("RUTA_TOKEN2", "ln.pe/");

date_default_timezone_set('America/Lima');


spl_autoload_register(function ($class) {
	if (file_exists("model/$class/$class.class.php")) {
		include_once "model/$class/$class.class.php";
	}
});

class View
{

	public static function load($view)
	{

		$url = isset($_GET['view']) ? $_GET['view'] : "home";
		$url = explode("/", rtrim($url, "/"));

		$longitud = count($url);
		$file = "view/";

		$ficheros  = scandir($file); //obtenemos un array de los ficheros de view 
		
			for ($i = 0; $i < $longitud; $i++) {
				if (file_exists($file . $url[$i] . "/index.php")) {
					$file = $file . $url[$i] . "/";
				} else {
					break;
				}
			}
			return $file;
	}

	public static function script($view)
	{

		$url = isset($_GET['view']) ? $_GET['view'] : "home";
		$url = explode("/", rtrim($url, "/"));

		$longitud = count($url);
		$file = "action/";

		for ($i = 0; $i < $longitud; $i++) {
			if (file_exists($file . $url[$i] . "/index.js")) {
				$file = $file . $url[$i] . "/";
			} else {
				break;
			}
		}
		if (file_exists($file . "index.js")) {
			return $file;
		} else {
			return $file;
		}
	}

	public static function ID()
	{
		$url = isset($_GET['view']) ? $_GET['view'] : "home";
		$url = explode("/", rtrim($url, "/"));

		$longitud = count($url);
		$i = $longitud - 1;

		return $url[$i];
	}

	public static function device()
	{

		//START DEVICE
		//codigo para detectar si es un movil
		$tablet_browser = 0;
		$mobile_browser = 0;
		$body_class = 'desktop';

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
			$body_class = "tablet";
		}

		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
			$body_class = "mobile";
		}

		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
			$body_class = "mobile";
		}

		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
			'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
			'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
			'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
			'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
			'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
			'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
			'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
			'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
			'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
		);

		if (in_array($mobile_ua, $mobile_agents)) {
			$mobile_browser++;
		}

		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
			$mobile_browser++;
			//Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}
		if ($tablet_browser > 0) {
			// Si es tablet has lo que necesites
			return "mobil";
		} else if ($mobile_browser > 0) {
			// Si es dispositivo mobil has lo que necesites
			return "mobil";
		} else {
			// Si es ordenador de escritorio has lo que necesites
			return "ordenador";
		}

		//END DEVICE
	}
}