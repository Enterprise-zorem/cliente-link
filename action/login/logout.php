<?php

$session = new Session();
if ($session->validateSession('dashboard_id')) {
    header("location: " . RUTA);
}

$session->destroySession();
header('location: ' . RUTA);