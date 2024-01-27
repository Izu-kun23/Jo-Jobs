<?php
function autoload($className)
{
    $file = '../Controllers/' .str_replace('\\', '/', $className) . '.php';
    require $file;
}

spl_autoload_register('autoload');