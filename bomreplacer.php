<?php

$extensions_allowed = array();
$extensions_allowed [] = 'php';
$extensions_allowed [] = 'html';
$extensions_allowed [] = 'phtml';
$extensions_allowed [] = 'js';
$extensions_allowed [] = 'css';
$extensions_allowed [] = 'ini';

class Process
{
    var $sDirectory = '.';
    var $aAllowedExtensions = array();

    function setAllowedExtension(array $aAllowedExtension = array())
    {
        $this->aAllowedExtensions = $aAllowedExtension;
        return $this;
    }

    function setDirectory($sDirectory = '.')
    {
        if (substr($sDirectory, -1) == '/') {
            $sDirectory = substr($sDirectory, 0, -1);
        }
        $this->sDirectory = $sDirectory;
        return $this;
    }

    function run($dir = null)
    {
        if (is_null($dir)) {
            $dir = $this->sDirectory;
        }
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if (($file <> '.') && ($file <> '..')) {
                    if (is_file($dir . '/' . $file)) {
                        $extension = pathinfo($dir . '/' . $file, PATHINFO_EXTENSION);
                        if (in_array($extension, $this->aAllowedExtensions)) {
                            $fileHandle = fopen($dir . '/' . $file, "r");
                            $intro = fread($fileHandle, 3);
                            fclose($fileHandle);
                            if ($intro == "\xEF\xBB\xBF") {
                                echo "$dir/$file\n";
                                file_put_contents($dir . '/' . $file, str_replace("\xEF\xBB\xBF", "", file_get_contents($dir . '/' . $file)));
                            }
                        }
                    } else {
                        if (is_dir($dir . '/' . $file)) {
                            $this->run($dir . '/' . $file);
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
}

set_time_limit(0);

$obj = new Process();
$obj->setDirectory(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '.')
    ->setAllowedExtension(isset($_SERVER['argv'][2]) ? explode(',', $_SERVER['argv'][2]) : array())
    ->run();
