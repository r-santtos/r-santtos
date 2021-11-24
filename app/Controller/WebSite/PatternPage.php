<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;

  class PatternPage {
    // Método responsável por retornar view Pattern
    public static function getPatternPage($header, $content) {
      return View::render('website/pattern_page', [
        /**
         * Dados para as tags dentro de head html
         * $header[0] = pageTitle 
         * $header[1] = canonical
         * $header[2] = description
         * $header[3] = secure_url
         * $header[4] = twitter_creator
         * $header[5] = og_url
         * $header[6] = or_image
         * $header[7] = or_image_width
         * $header[8] = or_image_height
         * $header[9] = or_image_alt
         * $header[10] = or_image_secure_url
         */ 

        'pageTitle' => $header[0],
        'canonical' => $header[1],
        'description' => $header[2],
        'secure_url' => $header[3],
        'twitter_creator' => $header[4],
        'og_url' => $header[5],
        'or_image' => $header[6],
        'or_image_width' => $header[7],
        'or_image_height' => $header[8],
        'or_image_alt' => $header[9],
        'or_image_secure_url' => $header[10],

        // retorna o conteúdo da página
        'content' => $content,
      ]);
    }

    // Método responsável por retornar view 404
    public static function getErr404() {
      return View::render('website/404', []);
    }
  }