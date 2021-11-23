<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;

  class Err404 extends Pattern {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getErr404() {

      // retorna a view page
      return parent::getErr404();
    }

  }