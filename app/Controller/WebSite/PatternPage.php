<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;

  class PatternPage {
    // Método responsável por retornar view Pattern
    public static function getPatternPage($header, $content) {
      return View::render('website/pattern_page', [
        // retorna o head da página
        'title' => $header[0],
        'description' => $header[1],

        // retorna o conteúdo da página
        'content' => $content,
      ]);
    }

    // Método responsável por retornar view 404
    public static function getErr404() {
      return View::render('website/404', []);
    }
  }