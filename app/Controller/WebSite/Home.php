<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\Entity\ReturnDB;

  class Home extends Pattern {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getHome() {
      // Classe que retorna os dados do database 
      $database = new ReturnDB;

      // Dados para as tags dentro de head html
      $header = ["title", "description"];

      // Retorna a view home
      $content = View::render('website/home', [
        'title' => $database->title,
        'description' => 'Texto vem aqui'
      ]);

      // retorna a view Pattern
      return parent::getPattern($header, $content);
    }

  }