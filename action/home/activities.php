<?php
$_POST = json_decode(file_get_contents("php://input"), true);
header('Access-Control-Allow-Origin:*');
$link=new links_counters(new Connexion);
$link->setshort_link_id($_POST['id']);
$link=$link->getAllByShortLinkId();

    while($row = $link->fetch_array(MYSQLI_ASSOC))
    {
    $rows[] = $row;
    }
    if(isset($rows))
    {
        print json_encode($rows,JSON_UNESCAPED_UNICODE);
    }
