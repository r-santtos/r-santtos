<?php
  
  namespace App\Model\WebSite;

  use \App\Model\WebSite\Connection;
  use \PDO;

  class SelectDocs {
    /**
     * Método lista dados do banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getDocs($where = null, $order = null, $limit = null) {
      return (new Connection('docs'))
      ->select($where,$order,$limit)
      ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
  }
