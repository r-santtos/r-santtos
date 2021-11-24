<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;
  use \App\Model\WebSite\SelectDocs;

  class Doc extends PatternPage {
    private static function getAside() {
      return View::render('_components/aside');
    }

    /**
     * Método responsável por retornar view
     * @return string
     */
    public static function getPageDoc($programmingLanguage,$pageTitle) {
      // Classe que retorna os dados do database 
      $doc = SelectDocs::getDocs();

      // Classe que retorna os dados do database 
      if ($programmingLanguage == $doc[0]->programmingLanguage && 
          $pageTitle == $doc[0]->pageTitle) {

        $header = [
          // Conteúdo da tag <head>
          $doc[0]->pageTitle,
          $doc[0]->canonical,
          $doc[0]->description,
          
          // Conteúdo das tags sociais
          $doc[0]->secure_url,
          $doc[0]->twitter_creator,
          $doc[0]->og_url,
          $doc[0]->or_image,
          $doc[0]->or_image_width,
          $doc[0]->or_image_height,
          $doc[0]->or_image_alt,
          $doc[0]->or_image_secure_url,
        ];

        // Retorna a view
        $content = View::render('website/doc', [
          'title' => $doc[0]->pageTitle,
          'caption' => $doc[0]->description,
          'text' => $doc[0]->text,
          'aside'=> self::getAside(),
        ]);

        // retorna a view page
        return parent::getPatternPage($header, $content);
      } else {
        // Método responsável por retornar view 404
        return View::render('website/404');
      }
    }
  }