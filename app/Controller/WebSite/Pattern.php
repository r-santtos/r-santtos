<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;

  class Pattern {
    /**
     * RETURN HEADER
     * @return string
     */
    private static function getHeader() {
      return View::render('_components/header');
    }

    /**
     * RETURN FOOTER
     * @return string
     */
    private static function getFooter() {
      return View::render('_components/footer');
    }

    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getPattern($header, $content) {
      return View::render('website/pattern', [
        'title' => $header[0],
        'description' => $header[1],
        'header'=> self::getHeader(),
        'content' => $content,
        'footer'=> self::getFooter()
      ]);
    }

  }