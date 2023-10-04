<?php

require_once __DIR__.'/autoload.php';


try {
    (new \vendor\Env(__DIR__.'/.env'))->load();
  //  var_dump($_ENV);
    $controller = new \command\SbrCommand();
    $controller->run();
} catch (\Exception $e) {
    print '['.date('Y-m-d H:i:s').']'.$e->getMessage().' TRACE: '.$e->getTraceAsString().PHP_EOL;
}