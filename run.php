<?php
function __autoload($className)
{
//    $fileName = preg_replace('#_#', '/', $className);
    require_once $className . '.php';
}

require_once 'di.php';

$cli = $di->getCli();
$cli->run();
