<?php 

  namespace App\Utils;

  class View {
    /**
     * Variáveis default da View
     * @var []
     */
    private static $vars = [];

    /**
     * Método definir dados iniciais da classe
     * @param array
     */
    public static function init($vars = []) {
      self::$vars = $vars;
    }

    /**
     * Método responsável por retornar conteúdo da view
     * @param string
     * @return string
     */
    private static function getContentView($view) {
      $file = __DIR__.'/../../resources/view/'.$view.'.html';
      $files = __DIR__.'/../../resources/view/website/404.html';
      
      return file_exists($file) ? file_get_contents($file) : file_get_contents($files);
    }

    /**
     * Método responsável por retornar conteúdo renderizado da view
     * @param string $view
     * @param array $vars
     * @return string
     */
    public static function render($view, $vars = []) {
      // CONTEÚDO DA VIEW
      $contentView = self::getContentView($view);

      // MERGE DE VARIÁVEIS
      $vars = array_merge(self::$vars,$vars);

      // CHAVES DO ARRAY
      $keys = array_keys($vars);
      $keys = array_map(function($item) {
        return '{{'.$item.'}}';
      },$keys);

      // RETORNA O CONTEÚDO RENDERIZADO
      return str_replace($keys, array_values($vars),$contentView);
    }

  }