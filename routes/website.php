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
    $objectRouter->get('/artigos/{category}/{pageTitle}', [
      function($category,$pageTitle) {
        return new Response(200,WebSite\Articles::getPageArticle($category,$pageTitle));
      }
    ]);

    /** ROTA DOC */
    $objectRouter->get('/doc/{programmingLanguage}/{pageTitle}', [
      function($programmingLanguage,$pageTitle) {
        return new Response(200,WebSite\Doc::getPageDoc($programmingLanguage,$pageTitle));
      }
    ]);
    
    /** ROTA 404 */
    $objectRouter->get('/404', [
      function() {
        return new Response(200,WebSite\Err404::getErr404());
      }
    ]);
