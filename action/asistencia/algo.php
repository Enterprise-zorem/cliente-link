<?php
$date=new DateTime();
$datetime=$date->format('Y-m-d');
$date="2020-12-05";
if($datetime>$date)
{
    echo "actual es mayor";
}
else
{
    echo "es menor";
}

