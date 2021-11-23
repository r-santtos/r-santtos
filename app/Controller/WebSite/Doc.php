<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\Entity\ReturnDB;

  class Doc extends PatternPage {
    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getPageDoc($programmingLanguage,$pageTitle) {
      // Classe que retorna os dados do database 
      $database = new ReturnDB;

      if ($pageTitle == 1) {
        /**
         * Dados para as tags dentro de head html
         * $header[0] = title 
         * $header[1] = description
         */ 
        $header = [
          "Doc", 
          "description"
        ];

        // Retorna a view
        $content = View::render('website/doc', [
          'title' => $database->title,
          'description' => 'Texto vem aqui',
          'programmingLanguage' => $programmingLanguage,
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