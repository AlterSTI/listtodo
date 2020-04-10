<?php
//declare(strict_types=1);
/** ***********************************************************************************************
 * AVMG classes autoloader.
 *
 * @author  Barabash
 *************************************************************************************************/
spl_autoload_register(function($className) {
    $classPath      = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $classFilePath  = __DIR__.DIRECTORY_SEPARATOR.$classPath.'.php';
    $classFile      = new SplFileInfo($classFilePath);

    if ($classFile->isFile()) {
        require_once $classFile->getPathname();
    }
});