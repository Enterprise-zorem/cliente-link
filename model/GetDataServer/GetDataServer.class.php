<?php

class GetDataServer
{
    public function getShortCode($db){
    $i = 0;
    do{
      $code = generateRandomString();
      $i++;
      if($i>100){
        die("No se puede generar código corto. Incrementar $shortCodeLength");
      }
    } while (array_key_exists($code,$db));
    return $code;
    }


    public function generateRandomString() {

    global $shortCodeLength;
    $shortCodeLength = $shortCodeLength< 4 ? 4 : $shortCodeLength;
    return substr(str_shuffle(str_repeat(
      $x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
      ceil($shortCodeLength/strlen($x)))),
      1,
      $shortCodeLength);
     }

     public function getIPv4()
        {
            if (getenv('HTTP_CLIENT_IP')) {
                $IP = getenv('HTTP_CLIENT_IP');
            } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
                $IP = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_X_FORWARDED')) {
                $IP = getenv('HTTP_X_FORWARDED');
            } elseif (getenv('HTTP_X_CLUSTER_CLIENT_IP')) {
                $IP = getenv('HTTP_X_CLUSTER_CLIENT_IP');
            } elseif (getenv('HTTP_FORWARDED_FOR')) {
                $IP = getenv('HTTP_FORWARDED_FOR');
            } elseif (getenv('HTTP_FORWARDED')) {
                $IP = getenv('HTTP_FORWARDED');
            } else {
                $IP = $_SERVER['REMOTE_ADDR'];
            }

            return $IP;
        }
        
  public function geoLocation($ipv4)
        {
            $geoip = (object) unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ipv4));
        
            $location = [
                'ipv4' => $ipv4,
                'city' => $geoip->geoplugin_city,
                'region' => $geoip->geoplugin_region,
                'country' => $geoip->geoplugin_countryName,
                'continent' => $geoip->geoplugin_continentName,
                'timezone' => $geoip->geoplugin_timezone
            ];

            return $location;

        }


 public function getPlatform() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
       $plataformas = array(
          'Windows 10' => 'Windows NT 10.0+',
          'Windows 8.1' => 'Windows NT 6.3+',
          'Windows 8' => 'Windows NT 6.2+',
          'Windows 7' => 'Windows NT 6.1+',
          'Windows Vista' => 'Windows NT 6.0+',
          'Windows XP' => 'Windows NT 5.1+',
          'Windows 2003' => 'Windows NT 5.2+',
          'Windows' => 'Windows otros',
          'iPhone' => 'iPhone',
          'iPad' => 'iPad',
          'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
          'Mac otros' => 'Macintosh',
          'Android' => 'Android',
          'BlackBerry' => 'BlackBerry',
          'Linux' => 'Linux',
       );
       foreach($plataformas as $plataforma=>$pattern){
          if (preg_match('/(?i)'.$pattern.'/', $user_agent))
             return $plataforma;
       }
       return 'Otras';
    }

    public function getBrowser()
    {   $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($user_agent, 'MSIE') !== FALSE)
            return $user_agent;
            elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return $user_agent;
            elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return $user_agent;
            elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
            return $user_agent;
            elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return $user_agent;
            elseif(strpos($user_agent, 'Firefox') !== FALSE)
            return $user_agent;
            elseif(strpos($user_agent, 'Chrome') !== FALSE)
            return $user_agent;
            elseif(strpos($user_agent, 'Safari') !== FALSE)
            return $user_agent;
            else
            return 'No se pudo detectar el navegador';

    }


}