<?php 

  namespace App\Http;

  use \Closure;
  use \Exception;
  use \ReflectionFunction;

  class Routes {
    /**
     * URL completo
     * @var string
     */
    private $url = '';

    /**
     * Prefixo
     * @var string
     */
    private $prefix = '';

    /**
     * Index de rotas
     * @var array
     */
    private $routes = [];

    /**
     * Request
     * @var Request
     */
    private $request;

    /**
     * CONSTRUTOR
     * #param string
     */
    public function __construct($url) {
      $this->request = new Request();
      $this->$url    = $url;
      $this->setPrefix();
    }

    /** PREFIX DAS ROTAS */
    private function setPrefix() {
      // INFOR URL
      $parseUrl = parse_url($this->url);

      // DEFINE PREFIX
      $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Método add route a classe
     * @param string
     * @param string
     * @param array
     */
    private function addRoutes($method, $routes, $params) {
      // Validação do paramentros
      foreach($params as $key=>$value) {
        if($value instanceof Closure) {
          $params['controller'] = $value;
          unset($params[$key]);
          continue;
        }
      }

      // VARIÁVEIS DA ROTA
      $params['variables'] = [];

      // PADRÃO VAR DAS ROTAS
      $patternVariable = '/{(.*?)}/';
      if(preg_match_all($patternVariable,$routes,$matches)) {
        $routes = preg_replace($patternVariable,'(.*?)',$routes);
        $params['variables'] = $matches[1];
      }

      // PADRÃO URL
      $patterRoute = '/^'.str_replace('/','\/',$routes).'$/';

      // ADD Rotas na Classe
      $this->routes[$patterRoute][$method] = $params;
    }

    /**
     * Método definir rota de GET
     * @param string
     * @param array
     */
    public function get($routes, $params = []) {
      return $this->addRoutes('GET', $routes, $params);
    }

    /**
     * Método definir rota de POST
     * @param string
     * @param array
     */
    public function post($routes, $params = []) {
      return $this->addRoutes('POST', $routes, $params);
    }

    /**
     * Método definir rota de PUT
     * @param string
     * @param array
     */
    public function put($routes, $params = []) {
      return $this->addRoutes('PUT', $routes, $params);
    }

    /**
     * Método definir rota de DELETE
     * @param string
     * @param array
     */
    public function delete($routes, $params = []) {
      return $this->addRoutes('DELETE', $routes, $params);
    }

    /**
     * Retornar paramentros sem prefixo
     * @return string
     */
    private function getUri() {
      // URI DA REQUEST
      $uri = $this->request->getUri();

      // Removendo prefix
      $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];

      return end($xUri);
    }

    /**
     * Rertonar paramentros
     * @return array
     */
    private function getRoute() {
      //URI
      $uri = $this->getUri();

      // Método
      $httpMethod = $this->request->getHttpMethod();

      // Validação de rota
      foreach($this->routes as $patterRoute=>$method) {

        // Verificação de igualdade da URI
        if(preg_match($patterRoute, $uri,$matches)) {

          // Verificar Método
          if(isset($method[$httpMethod])) {
            // REMOVE A PRIMEIRA POSIÇÃO DA URI
            unset($matches[0]);

            //CHAVES 
            $keys = $method[$httpMethod]['variables'];
            $method[$httpMethod]['variables'] = array_combine($keys, $matches);
            $method[$httpMethod]['variables']['request'] = $this->request;

            return $method[$httpMethod];
          }
          throw new Exception("Erro", 405);
        }
      }
      // URL 404
      throw new Exception("Erro 404", 404);
    }

    /**
     * Método executar rota
     * @return Response
     */
    public function run() {
      try {
        // ROTA ATUAL
        $routes = $this->getRoute();

        // VERIFICAR O CONTROLADOR
        if(!isset($routes['controller'])) {
          throw new Exception("A URL não exite",500);
        }
        
        // ARGUMENTOS DA FUNÇÃO
        $args = [];

        // REFLECTION
        $reflection = new ReflectionFunction($routes['controller']);
        foreach($reflection->getParameters() as $parameter) {
          $name = $parameter->getName();
          $args[$name] = $routes['variables'][$name] ?? '';
        }

        // RETORUNO DA FUNÇÃO
        return call_user_func_array($routes['controller'],$args);

      } catch (Exception $err) {
        return new Response($err->getCode(),$err->getMessage());
      }
    }
  }