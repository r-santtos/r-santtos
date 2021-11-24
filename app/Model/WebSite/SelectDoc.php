<?php
  
  namespace App\Model\WebSite\SelectDoc;

  use \App\Model\Connection\WebSite\Database;
  use \PDO;

  class Lista {
    /**
     * Método lista dados do banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVacancies($where = null, $order = null, $limit = null) {
      return (new Database('vacancies'))
      ->select($where,$order,$limit)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
  }
