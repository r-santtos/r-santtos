<?php 

  namespace App\Controller\WebSite;

  use \App\Utils\View;

  class Home {
    public static function getHome() {
      // Dados para as tags dentro de head html
      return View::render('website/home',[
        "style" => "home",
        "date" => date('Y')
      ]);
    }
  }