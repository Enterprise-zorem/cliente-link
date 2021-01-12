<?php
$fechaActual = date('Y-m-d H:i:s'); 

$short=new short_links(new Connexion);
$short=$short->getAll();
while($row=$short->fetch_array(MYSQLI_ASSOC))
{
    //recorremos cada uno
    $datetime1 = date_create($row['created_at']);
    $datetime2 = date_create($fechaActual);
    $contador = date_diff($datetime1, $datetime2);
    $differenceFormat = '%a';
    $diferencia=$contador->format($differenceFormat);
    if($diferencia>=30)
    {   
        //borrar de la base de datos
        $delete=new short_links(new Connexion);
        $delete->setpk($row['id']);
        $delete->delete();
        //borrar los registros de clicks
        $links=new links_counters(new Connexion);
        $links->setshort_link_id($row['id']);
        $links->delete_link_id();

        echo "Eliminado";
        
    }
}
