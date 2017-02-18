#Readme

composer require newday/routing:@dev

"require": {
    "newday/routing": "@dev"
}

index.php

require_once __DIR__ . '/vendor/autoload.php';

use NewDay\Routing\Router;

$app = new Router();

$app->route('/hello', function(){
    echo 'Hello New Day Routing!';
});

$app->route('/helloclass', 'Vendor\Controllers\Hello:say');
Cria uma instancia de Hello e executa o metodo say

$app->run();
