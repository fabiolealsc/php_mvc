<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use App\Utils\View;

define('URL', 'http://localhost:8000/projeto_padrao');

View::init([
    'URL' => URL
    ]);
    
$obRouter = new Router(URL);
//Inicia o router

include __DIR__.'/routes/pages.php';

//Imprime a response da rota
$obRouter->run()
         ->sendResponse();