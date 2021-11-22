<?php

  namespace App\Http;

  class Response {

    /** 
     * Código do status HTTP 
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     * @var array
     */
    private $headers = [];

    /**
     * Guarda conteúdo
     * @var mixed
     */
    private $content;

    /**
     * Tipo de conteúdo
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Método Construtor
     * @param integer
     * @param mixed
     * @param string
     */
    public function __construct($httpCode, $content, $contentType = 'text/html') {
      $this->$httpCode = $httpCode;
      $this->content  = $content;
      $this->setContentType($contentType);
    }

    /**
     * Método alterar o type do response
     * @param string
     */
    public function setContentType($contentType) {
      $this->$contentType = $contentType;
      $this->addHeader('Content-Type',$contentType);
    }

    /**
     * ADD registros no cabeçalho
     */
    public function addHeader($key,$value) {
      $this->headers[$key] = $value;
    }

    // Status
    public function sendHeaders() {
      http_response_code($this->httpCode);

      // Enviar Headers
      foreach($this->headers as $key=>$value) {
        header($key.': '.$value);
      }
    }

    // Método para enviar resposta
    public function sendResponse() {
      $this->sendHeaders();
      switch ($this->contentType) {
        case 'text/html';
        echo $this->content;
        exit;
      }
    }
  }