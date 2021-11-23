<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\Entity\ReturnDB;

  class Articles extends Pattern {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getArticles($idPage) {
      // Classe que retorna os dados do database 
      $database = new ReturnDB;

      // Dados para as tags dentro de head html
      $header = ["Articles", "description"];

      // Retorna a view home
      $content = View::render('website/artigos', [
        'title' => $database->title,
        'description' => 'Texto vem aqui',
        'idPage' => $idPage
      ]);

      // retorna a view page
      return parent::getPattern($header, $content);
    }

  }