<?php

$extensions_allowed = array();
$extensions_allowed [] = 'php';
$extensions_allowed [] = 'html';
$extensions_allowed [] = 'phtml';
$extensions_allowed [] = 'js';
$extensions_allowed [] = 'css';
$extensions_allowed [] = 'ini';

function listeFichiers($dir){
 
 global $extensions_allowed;
 if ($handle = opendir($dir)) {

  /* Ceci est la façon correcte de traverser un dossier. */
 
  while (false !== ($file = readdir($handle))) {
   if (($file <>'.') && ($file<>'..')) {
    if (is_file($dir.'/'.$file)){
      $extension = pathinfo($dir.'/'.$file, PATHINFO_EXTENSION);
      if (in_array($extension,$extensions_allowed)){
       $fileHandle = fopen($dir.'/'.$file, "r");
       $intro = fread($fileHandle, 3);
       fclose($fileHandle);
       if ($intro == "\xEF\xBB\xBF"){  
        echo "$dir/$file\n";
        file_put_contents($dir.'/'.$file, str_replace("\xEF\xBB\xBF", "", file_get_contents($dir.'/'.$file)));
        flush();
       }
      }
     } else {
     if (is_dir($dir.'/'.$file)){
      listeFichiers($dir.'/'.$file);
     } 
    }
   }
  }
 closedir($handle);
 }
}

header("Content-type: text/plain\n\n");

set_time_limit(3600);

$path = 'C:/wamp/www/pgroupe_091006_refonte/trunk/platform';
if (substr($path,-1)=='/'){
$path =  substr($path,0,-1);
}
listeFichiers($path);
