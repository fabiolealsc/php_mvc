<?php

namespace App\Http;

class Response{


    /**
     * Codigo HTTP do response
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Header do response
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteudo do response
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteudo do response
     * @var string
     */
    private $content;
    

    /**
     * Método construto da resposta
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this->httpCode     = $httpCode;
        $this->content      = $content;
        $this->setContentType($contentType);
    }
    
    /**
     * Método responsável por alterar o content type do response
     *
     * @param  string $contentType
     * @return void
     */
    public function setContentType($contentType): void{
        $this->contentType  = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }
        
        
    /**
     * addHeader
     *
     * @param  string $key
     * @param  string $value
     * @return void
     */
    public function addHeader(string $key, string $value): void{
        $this->headers[$key] = $value;
    }
    
    /**
     * Imprime o conteúdo conforme o tipo dele
     *
     * @return void
     */
    public function sendResponse():void{
        //Envia headers
        $this->sendHeaders();
        
        //Imprime o conteúdo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
                
            default:
                # code...
                break;
        }
    }
    
    /**
     * Envia os headers para aplicação
     *
     * @return void
     */
    private function sendHeaders(): void{
        // DEFINE STATUS
        http_response_code($this->httpCode);

        //enviar headers
        foreach ($this->headers as $key => $value) {
            header($key.': '.$value);
        }
    }
    
    /**
     * Método reponsável por retornar http code da response
     * @return integer
     */
    public function getHttpCode(): int{
        return $this->httpCode;
    }

    /**
     * Método reponsável por retornar os headers da response
     * @return array
     */
    public function getHeaders(): array{
        return $this->headers;
    }

    /**
     * Método reponsável por retornar o tipo do conteudo da response
     * @return string
     */
    public function getContentType(): string{
        return $this->contentType;
    }
    
    /**
     * Método reponsável por retornar o conteudo da response
     * @return string
     */
    public  function getContent(): string{
        return $this->content;
    }
}