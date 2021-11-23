<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\Entity\ReturnDB;

  class Articles extends PatternPage {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getPageArticle($category,$pageTitle) {
      // Classe que retorna os dados do database 
      $database = new ReturnDB;

      if ($pageTitle == 1) {
        /**
         * Dados para as tags dentro de head html
         * $header[0] = title 
         * $header[1] = description
         */ 
        $header = [
          "Articles", 
          "description"
        ];

        // Retorna a view
        $content = View::render('website/artigos', [
          'title' => $database->title,
          'description' => 'Texto vem aqui',
          'category' => $category,
          'pageTitle' => $pageTitle
        ]);

        // retorna a view page
        return parent::getPatternPage($header, $content);
      } else {
        // Método responsável por retornar view 404
        return View::render('website/404');
      }
    }

  }