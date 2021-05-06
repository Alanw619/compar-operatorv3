<?php
include ('../process/db.php');
include ('../process/autoload.php');

$manager = new Manager($db);

$id = $_GET['id'];

$destination = new Destination(['id_tour_operator'=>$id]);

    
$deleteDestination = $manager->deleteDestination($destination);


header("Location:gestionAdmin.php");