<?php 

  namespace App\Model\WebSite;

  use \PDO;
  use \PDOException;

  class Connection {
    /**
     * Host de conexão
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = "phpmvc";

    /**
     * Usuário do banco de dados
     * @var string
     */
    const USER = 'rsanttos';

    /**
     * Senha do banco de dados
     * @var string
     */
    const PASSWORD = '@B9118rss';

    /**
     * Nome da tabela no banco de dados
     * @var string
     */
    private $table;

    /**
     * Conexão usando PDO
     * @var PDO
     */
    private $connection;
    
    /**
     * Definindo a tabela e instanciar a conexão
     * @param string
     */
    public function __construct($table = null) {
      $this->table = $table;
      $this->setConnection();
    }

    /** 
     * Criando a conexão
     */
    private function setConnection() {
      try {
        // Realizando conexão
        $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASSWORD);

        // Tratando algum erro na hora do registro
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $err) {
        // Não faça isso em produção, crie uma mensagem personalizada para o usuário e salve o erro em um log.
        die('ERROR:'.$err->getMessage());
      }
    }

    /**
     * Método executar queries
     * @param string
     * @param array
     * @return PDOStatement
     */
    public function execute($query, $params = []) {
      try {

        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;

      } catch (PDOException $err) {
        // Não faça isso em produção, crie uma mensagem personalizada para o usuário e salve o erro em um log.
        die('ERROR:'.$err->getMessage());
      }
    }

    /**
     * Método inserir
     * @param array $values [ field => value ]
     * @return integer
     */
    public function insert($values) {
      // Dados da query
      $fields = array_keys($values);
      $binds = array_pad([], count($fields),'?');

      // Query SQL montada
      $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

      // Executa insert
      $this->execute($query, array_values($values));

      // RETORNAR O ÚLTIMO ID INSERIDO NO BANCO DE DADOS
      return $this->connection->lastInsertId();
    }

    /**
     * Método de consulta no banco de dados
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null) {
      // Dados da query
      $where = strlen($where) ? 'WHERE '.$where : '';
      $order = strlen($order) ? 'ORDER BY '.$order : '';
      $limit = strlen($limit) ? 'LIMIT '.$limit : '';

      // Montagem da query
      $query = 'SELECT * FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

      return $this->execute($query);
    }

    /**
     * Método atualizar banco de dados
     * @param string $where
     * @param array $values [ field => value ]
     * @return boolean
     */
    public function update($where, $values) {
      // Dados da query
      $fields = array_keys($values);

      // Montar a query
      $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

      //Executar a query
      $this->execute($query,array_values($values));

      return true;
    }

    /**
     * Método excluir
     * @param string $where
     * @return boolean
     */
    public function delete($where) {
      $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

      $this->execute($query);

      return true;
    }
  }