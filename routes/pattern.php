<?php

  use \App\Http\Response;
  use \App\Controller\WebSite;

    /** ROTA HOME */
    $objectRouter->get('/', [
      function() {
        return new Response(200,WebSite\Home::getHome());
      }
    ]);

  /** ROTA SOBRE */
  $objectRouter->get('/about', [
    function() {
      return new Response(200,WebSite\About::getAbout());
    }
  ]);

  /** ROTA 404 */
  $objectRouter->get('/404', [
    function() {
      return new Response(200,WebSite\Err404::getErr404());
    }
  ]);

  /** ROTA DINÂMICAS */
  // $objectRouter->get('/pagina/{idPage}/{idName}', [
  //   function($idPage,$idName) {
  //     return new Response(200, 'Pagina '.$idPage. ' - ' .$idName);
  //   }
  // ]);
