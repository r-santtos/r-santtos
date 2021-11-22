<?php 

  namespace App\Http;

  class Request {
    /**
     * Método HTTP da requisição
     * @var string
     */
    private $httpMethod;

    /**
     * URI da página
     * @var string
     */
     private $uri;

     /**
      * Parâmetros da URL ($_GET)
      * @var array
      */
      private $queryParams = [];

      /**
       * Variáveis recebidas ($_POST)
       * @var array
       */
      private $postVars = [];

      /**
       * Cabeçalho
       * @var array
       */
      private $headers = [];

      /** 
       * Construtor da classe
       */
      public function __construct() {
        $this->queryParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];
        $this->headers     = getallheaders();
        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri         = $_SERVER['REQUEST_URI'] ?? ''; 
      }

      /**
       * Método Params
       * @return array
       */
      public function getQueryParams() {
        return $this->queryParams;
      }

      /**
       * Método Post Vars
       * @return array
       */
      public function getPostVar() {
        return $this->postVars;
      }

      /**
       * Método Headers
       * @return array
       */
      public function getHeaders() {
        return $this->headers;
      }

      /**
       * Método HTTP
       * @return string
       */
      public function getHttpMethod() {
        return $this->httpMethod;
      }

      /**
       * Método URI
       * @return string
       */
      public function getUri() {
        return $this->uri;
      }
  }