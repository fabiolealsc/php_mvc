<?php

namespace App\Http;

use Closure;
use Exception;

class Router
{    
    /**
     * URL completa do projeto
     *
     * @var string
     */
    private $url = '';
        
    /**
     * Prefixo de todas as rotas
     *
     * @var string
     */
    private $prefix = '';
        
    /**
     * Índice de rotas
     *
     * @var array
     */
    private $routes = [];
    
    /**
     * Instancia de Request
     *
     * @var Request
     */
    private $request;
    
    /**
     * Método construtor da Classe
     *
     * @param  string $url
     * @param  string $prefix
     * @param  array $routes
     * @param  Request $request
     * @return void
     */
    public function __construct(string $url)
    {
        $this->request  = new Request();
        $this->url      = $url;
        $this->setPrefix();
    }


    /**
     * Set prefixo de todas as rotas
     *
     * @param  string  $prefix  Prefixo de todas as rotas
     *
     * @return  self
     */ 
    private function setPrefix()
    {
        //INFO URL ATUAL
        $parseUrl = parse_url($this->url);

        //DEFINE O PREFIX
        $this->prefix = $parseUrl['path'] ?? '';
    }  

    /**
     * Método responsável por adicionar um rota na classe
     *
     * @param  string $method
     * @param  string $route
     * @param  array $params
     * @return void
     */
    private function addRoute(string $method, string $route, array $params = []): void
    {
        //Validação dos params
        foreach ($params as $key => $value) {
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }
        // Padrão de vaçidação da URL
        $patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

        //ADD rota na classe
        $this->routes[$patternRoute][$method] = $params;
        

    }
    
    /**
     * Método responsável por definir uma rota de get
     *
     * @param  string $route
     * @param  array $params
     * @return mixed
     */
    public function get(string $route, array $params = []): mixed
    {
        return $this->addRoute('GET', $route, $params);
    }
    /**
     * Método responsável por definir uma rota de post
     *
     * @param  string $route
     * @param  array $params
     * @return mixed
     */
    public function post(string $route, array $params = []): mixed
    {
        return $this->addRoute('POST', $route, $params);
    } 
    /**
     * Método responsável por definir uma rota de PUT
     *
     * @param  string $route
     * @param  array $params
     * @return mixed
     */
    public function put(string $route, array $params = []): mixed
    {
        return $this->addRoute('PUT', $route, $params);
    } 
    /**
     * Método responsável por definir uma rota de delete
     *
     * @param  string $route
     * @param  array $params
     * @return mixed
     */
    public function delete(string $route, array $params = []): mixed
    {
        return $this->addRoute('DELETE', $route, $params);
    } 

    /**
     * Método responsávelpor retornar a uri sem o prefix
     *
     * @return mixed
     */
    private function getUri( ): mixed
    {
        //URI da resquest
        $uri = $this->request->getUri();
        
        // Fatia a URI com prefix
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        return end($xUri);
    }
    /**
     * Método responsável por retornar os dados da rota atual
     *
     * @return array
     */
    private function getRoute()
    {
        //URI
        $uri = $this->getUri();
        

        //METODO
        $httpMethod = $this->request->getHttpMethod();
        
        //VALIDADE as ROTAS
        foreach ($this->routes as $patternRoute => $methods) {
            // VERIFICA SE A URI BAATE O PADRÃO
            if(preg_match($patternRoute, $uri)){
                //VERIFICA O MÉTODO
                if($methods[$httpMethod]){
                    // RETORNO DOS PARÂMETROS
                    return $methods[$httpMethod];
                }
                throw new Exception("Método não permitido", 405);
            }
        } throw new Exception("URL não encontrada", 404);
    }

    /**
     * Método responsável por executar a rota atual
     *
     * @return Response
     */
    public function run(): Response
    {
        try {
            $route = $this->getRoute();
            
            //verifica controlador
            if(!isset($route['controller'])){
                throw new Exception("URL não pode ser processada", 500);
            }
            $args = [];
            return call_user_func_array($route['controller'], $args);

        } catch (\Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}