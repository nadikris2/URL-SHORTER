<?php

define('VERSION','0.1.1');
$timestart=microtime(TRUE);
$GLOBALS['status']=array();

$unzipper = new Unzipper;
if(isset($_POST['dounzip'])){
    $archive= isset($_POST['zipfile']) ? 
    $destination = isset($_POST['extpath']) ? 
    $unzipper -> prepareExtraction($archive,$destination)
}

if(isset($_POST['dozip'])) { 
    $zippath = !empty ($_POST['zipfile']) ?
    $zipfile='zipper-' . date("Y-m-d-h-i") .'zip';
    Zipper::zipDir($zippath,$zipfile);
    
}