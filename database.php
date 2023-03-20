<?php
$con = new PDO('mysql:host=localhost;dbname=youtube_qcm','root','');
if(!isset($con)){
    echo "la connexion a echouee";
}