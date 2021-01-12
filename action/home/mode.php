<?php
$session=new Session();

if($session->issetValue('links__mode'))
{
    $session->removeValue('links__mode');
}
else
{
    $session->addValue('links__mode',"dark");
}

echo "<script>window.location.replace('".RUTA."');</script>";