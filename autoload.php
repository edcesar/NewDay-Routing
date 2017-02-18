<?php

function NewDayRoutingAutoload($class)
{
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $class = str_replace('NewDay\\Routing', '', $class);
    require_once __DIR__ . '/src/' . $class . '.php';
}

spl_autoload_register('NewDayRoutingAutoload');
