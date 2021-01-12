<?php
header('Access-Control-Allow-Origin:*');
$session=new Session();
$session=$session->getValue('links__id_user');

$links=new short_links(new Connexion);
$links->setuser_id($session);
$links=$links->getAllByuser_id();

    while($row = $links->fetch_array(MYSQLI_ASSOC))
    {
    $rows[] = $row;
    }
    if(isset($rows))
    {
        print json_encode($rows,JSON_UNESCAPED_UNICODE);
    }
    

    
