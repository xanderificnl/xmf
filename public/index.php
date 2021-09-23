<?php

use Xmf\Core\Router;

define("APP_PATH", dirname(__FILE__, 2));

require('../vendor/Xmf/Core/Autoloader.php');

try {
    new Router();
} catch (Exception $e) {
    echo "Something went wrong, i.e.:";
    var_dump($e);
}