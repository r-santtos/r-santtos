<?php

  use \App\Http\Response;
  use \App\Controller\WebSite;

    /** ROTA HOME */
    $objectRouter->get('/', [
      function() {
        return new Response(200,WebSite\Home::getHome());
      }
    ]);

    /** ROTA ARTICLES */
    $objectRouter->get('/artigos/{idPage}', [
      function($idPage) {
        return new Response(200,WebSite\Articles::getArticles($idPage));
      }
    ]);
    
    /** ROTA 404 */
    $objectRouter->get('/404', [
      function() {
        return new Response(200,WebSite\Err404::getErr404());
      }
    ]);
