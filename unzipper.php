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

  public static function extractGzipFile($archive, $destination) {

    if (!function_exists('gzopen')) {
      $GLOBALS['status'] = array('error' => 'Error: Your PHP has no zlib support enabled.');
      return;
    }

    $filename = pathinfo($archive, PATHINFO_FILENAME);
    $gzipped = gzopen($archive, "rb");
    $file = fopen($destination . '/' . $filename, "w");

    while ($string = gzread($gzipped, 4096)) {
      fwrite($file, $string, strlen($string));
    }
    gzclose($gzipped);
    fclose($file);
    if (file_exists($destination . '/' . $filename)) {
        $GLOBALS['status'] = array('success' => 'File unzipped successfully.');
  
       
        if (pathinfo($destination . '/' . $filename, PATHINFO_EXTENSION) == 'tar') {
          $phar = new PharData($destination . '/' . $filename);
          if ($phar->extractTo($destination)) {
            $GLOBALS['status'] = array('success' => 'Extracted tar.gz archive successfully.');
   
            unlink($destination . '/' . $filename);
          }
        }
      }
      else {
        $GLOBALS['status'] = array('error' => 'Error unzipping file.');
      }
  
    }
    public static function extractRarArchive($archive, $destination) {
        // Check if webserver supports unzipping.
        if (!class_exists('RarArchive')) {
          $GLOBALS['status'] = array('error' => 'Error: Your PHP version does not support .rar archive functionality. <a class="info" href="http://php.net/manual/en/rar.installation.php" target="_blank">How to install RarArchive</a>');
          return;
        }

        if ($rar = RarArchive::open($archive)) {

          if (is_writeable($destination . '/')) {
            $entries = $rar->getEntries();
            foreach ($entries as $entry) {
              $entry->extract($destination);
            }
            $rar->close();
            $GLOBALS['status'] = array('success' => 'Files extracted successfully.');
          }
          else {
            $GLOBALS['status'] = array('error' => 'Error: Directory not writeable by webserver.');
          }
        }
        else {
          $GLOBALS['status'] = array('error' => 'Error: Cannot read .rar archive.');
        }
      }
    
    }

    class Zipper {

        private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
            $handle = opendir($folder);
        
            while (FALSE !== $f = readdir($handle)) {
              if ($f != '.' && $f != '..' && $f != basename(__FILE__)) {
                $filePath = "$folder/$f";
                $localPath = substr($filePath, $exclusiveLength);
        
                if (is_file($filePath)) {
                  $zipFile->addFile($filePath, $localPath);
                }
                elseif (is_dir($filePath)) {
                  $zipFile->addEmptyDir($localPath);
                  self::folderToZip($filePath, $zipFile, $exclusiveLength);
                }
              }
            }
            closedir($handle);
          }
          public static function zipDir($sourcePath, $outZipPath) {
            $pathInfo = pathinfo($sourcePath);
            $parentPath = $pathInfo['dirname'];
            $dirName = $pathInfo['basename'];
        
            $z = new ZipArchive();
            $z->open($outZipPath, ZipArchive::CREATE);
            $z->addEmptyDir($dirName);
            if ($sourcePath == $dirName) {
              self::folderToZip($sourcePath, $z, 0);
            }
            else {
              self::folderToZip($sourcePath, $z, strlen("$parentPath/"));
            }
            $z->close();
        
            $GLOBALS['status'] = array('success' => 'Successfully created archive ' . $outZipPath);
          }
        }
        ?>
        <!DOCTYPE html>
<html>
<head>
  <title>File Unzipper + Zipper</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <style type="text/css">
    <!--
    body {
      font-family: Arial, sans-serif;
      line-height: 150%;
    }

    label {
      display: block;
      margin-top: 20px;
    }

    fieldset {
      border: 0;
      background-color: #EEE;
      margin: 10px 0 10px 0;
    }

    .select {
      padding: 5px;
      font-size: 110%;
    }

    .status {
      margin: 0;
      margin-bottom: 20px;
      padding: 10px;
      font-size: 80%;
      background: #EEE;
      border: 1px dotted #DDD;
    }

    .status--ERROR {
      background-color: red;
      color: white;
      font-size: 120%;
    }

    .status--SUCCESS {
      background-color: green;
      font-weight: bold;
      color: white;
      font-size: 120%
    }

    .small {
      font-size: 0.7rem;
      font-weight: normal;
    }

    .version {
      font-size: 80%;
    }

    .form-field {
      border: 1px solid #AAA;
      padding: 8px;
      width: 280px;
    }

    .info {
      margin-top: 0;
      font-size: 80%;
      color: #777;
    }

    .submit {
      background-color: #378de5;
      border: 0;
      color: #ffffff;
      font-size: 15px;
      padding: 10px 24px;
      margin: 20px 0 20px 0;
      text-decoration: none;
    }

    .submit:hover {
      background-color: #2c6db2;
      cursor: pointer;
    }
    -->
  </style>
</head>
<body>