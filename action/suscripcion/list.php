<?php
header('Access-Control-Allow-Origin:*');

$plan=new plan(new Connexion);
$plan=$plan->getAllisActive();


    while($row = $plan->fetch_array(MYSQLI_ASSOC))
    {
    $rows[] = $row;
    }
    if(isset($rows))
    {
        print json_encode($rows,JSON_UNESCAPED_UNICODE);
    }
    

    
