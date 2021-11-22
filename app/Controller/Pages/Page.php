<?php 

  namespace App\Controller\Pages;

  use \App\Utils\View;

  class Page {
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
    public static function getPage($header, $content) {
      return View::render('pages/page', [
        'title' => $header[0],
        'description' => $header[1],
        'header'=> self::getHeader(),
        'content' => $content,
        'footer'=> self::getFooter()
      ]);
    }

  }