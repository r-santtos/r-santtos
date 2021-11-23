<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\Entity\ReturnDB;

  class About extends Pattern {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getAbout() {
      // Classe que retorna os dados do database 
      $database = new ReturnDB;

      // Dados para as tags dentro de head html
      $header = ["About", "description"];

      // Retorna a view home
      $content = View::render('website/about', [
        'title' => $database->title,
        'description' => 'Texto vem aqui'
      ]);

      // retorna a view page
      return parent::getPattern($header, $content);
    }

  }