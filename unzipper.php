<?php

define('VERSION','0.1.1');
$timestart=microtime(TRUE);
$GLOBALS['status']=array();

$unzipper = new Unzipper;
if(isset($_POST['dounzip'])){
    $archive= isset($_POST['zipfile']) ? strip_tags($_POST['zipfile']) : '';
    $destination = isset($_POST['extpath']) ? strip_tags($_POST['extpath']) : '';
    $unzipper -> prepareExtraction($archive,$destination)
}

if(isset($_POST['dozip'])) { 
    $zippath = !empty ($_POST['zipfile']) ?
    $zipfile='zipper-' . date("Y-m-d-h-i") .'zip';
    Zipper::zipDir($zippath,$zipfile);
}

$timeend=microtime(TRUE);
$time=round($timeend - $timestart,4);

class Unzipper{
    public $localdir=".";
    public $zipfile = array();

    public function __construct(){
        if($dh = opendir($this ->localdir))
        while (($file = readdir($dh)) !== False){
            if (pathinfo($file , PATHINFO_EXTENSION))=== 'zip' 
            || pathinfo($file, PATHINFO_EXTENSION) === 'gz'
            || pathinfo($file, PATHINFO_EXTENSION) === 'rar'
        } { this ->zipfiles[] = $file ; 
        }
    }
    closedir($dh)

    if (!empty($this -> zipfiles))
    {
        $GLOBALS['status']=array('info'=> '.zip or .gz or .rar files found, ready for extraction');
    }
    else {
        $GLOBALS['status'] = array('info' => 'No .zip or .gz or rar files found. So only zipping functionality available.');
}