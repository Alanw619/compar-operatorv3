<?php
include ('../process/db.php');
include ('../process/autoload.php');

$manager = new Manager($db);

$id = $_GET['id'];

$operator = new TourOperator(['id'=>$id]);


$deleteOperator = $manager->deleteTourOperator($operator);


header("Location:gestionAdmin.php");