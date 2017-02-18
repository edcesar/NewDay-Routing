<?php
require_once __DIR__ . '/autoload.php';
# OR
# require_once __DIR__ . '/vendor/autoload.php';

use NewDay\Routing\Router;

$app = new Router();

$app->route('/hello', function(){
    echo 'Hello New Day Routing!';
});

$app->route('/helloclass', 'NewDay\Routing\Tests\Hello:say');

$app->run();



