<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\View;
use \WilliamCosta\DotEnv\Environment;

// Variaveis de ambiente
Environment::load(__DIR__);

define('URL', getenv('URL'));

View::init([
    'URL' => URL
    ]);
    
$obRouter = new Router(URL);
//Inicia o router

include __DIR__.'/routes/pages.php';

//Imprime a response da rota
$obRouter->run()
         ->sendResponse();