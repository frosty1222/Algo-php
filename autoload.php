<?php 
spl_autoload_register(function($className){
    $baseDir= __DIR__;
    $baseDir= str_replace("vendor","",$baseDir);
    $pathFile = $baseDir. str_replace("\\","/",$className) . ".php";
    if(file_exists($pathFile))
    {
        include $pathFile;
    }

});