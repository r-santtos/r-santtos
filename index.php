<?php
  /* Informa o nível dos erros que serão exibidos */
  /* Habilita a exibição de erros */
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  require __DIR__.'/vendor/autoload.php';

  use \App\Http\Routes;
  use \App\Utils\View;

  define('URL', 'http://localhost');

  // DEFINE O PADRÃO DAS VARIÁVEIS
  View::init([
    'URL' => URL
  ]);

  // INICIA O ROUTER
  $objectRouter = new Routes(URL);

  // INCLUDE ROUTES
  include __DIR__.'/routes/website.php';

  // Imprime rota 
  $objectRouter->run()->sendResponse();