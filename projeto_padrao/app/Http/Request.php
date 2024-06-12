<?php

namespace App\Http;

class Request{
    
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
     * Variáveis recebidades do POST da página($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da request
     * @var array
     */
    private $headers = [];

    /**
     * Contrutor da class
     */
    public function __construct(){
        $this->queryParams  = $_GET ?? [];
        $this->postVars     = $_POST ?? [];
        $this->headers      = getallheaders();
        $this->httpMethod   = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri          = $_SERVER['REQUEST_URI'] ?? '';
    }
    /**
     * Método reponsável por retornar o Método HTTP da request
     * @return string
     */
    public function getHttpMethod(): string{
        return $this->httpMethod;
    }
    /**
     * Método reponsável por retornar a URI da request
     * @return string
     */
    public function getUri(): string{
        return $this->uri;
    }
    /**
     * Método reponsável por retornar os headers da request
     * @return array
     */
    public function getHeader(): array{
        return $this->headers;
    }
    /**
     * Método reponsável por retornar as querys da request
     * @return array
     */
    public function getQueryParams(): array{
        return $this->queryParams;
    }
    /**
     * Método reponsável por retornar as variaveis Posts da request
     * @return array
     */
    public function getPostVars(): array{
        return $this->postVars;
    }
}