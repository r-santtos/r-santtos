<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\WebSite\SelectArticles;

  class Articles extends PatternPage {
    private static function getAsideArticles() {
      return View::render('_components/aside_articles');
    }

    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getPageArticle($pageTitle,$category) {
      // Classe que retorna os dados do database 
      $articles = SelectArticles::getArticles();

      if ($category == $articles[0]->category && 
          $pageTitle == $articles[0]->pageTitle) {

        // Dados para as tags dentro de head html 
        $header = [
          // Conteúdo da tag <head>
          $articles[0]->pageTitle,
          $articles[0]->canonical,
          $articles[0]->description,
          
          // Conteúdo das tags sociais
          $articles[0]->secure_url,
          $articles[0]->twitter_creator,
          $articles[0]->og_url,
          $articles[0]->or_image,
          $articles[0]->or_image_width,
          $articles[0]->or_image_height,
          $articles[0]->or_image_alt,
          $articles[0]->or_image_secure_url,
        ];

        // Retorna a view
        $content = View::render('website/artigos', [
          'title' => $articles[0]->pageTitle,
          'caption' => $articles[0]->description,
          'dates' => $articles[0]->dates,
          'datesBR' => date('M d, Y à\s H:i:s', strtotime($articles[0]->dates)),
          'text' => $articles[0]->text,
          'aside'=> self::getAsideArticles(),
        ]);

        // retorna a view page
        return parent::getPatternPage($header, $content);
      } else {
        // Método responsável por retornar view 404
        return View::render('website/404');
      }
    }
  }