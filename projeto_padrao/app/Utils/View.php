<?php

namespace App\Utils;

/**
 * Classe responsável por controlar e renderizar as views
 */
class View{
        
    /**
     * Variáveis padrões da View
     *
     * @var array
     */
    private static $vars = [];
        
    /**
     * Método reponsável por definir os dados iniciais da classe
     *
     * @param  array $vars
     */
    public static function init(array $vars = []): void
    {
        self::$vars = $vars;
    }
    /**
     * Método responsável por retornar o centeúdo de uma view
     * @param string $view
     * @return string
     */

    private static function getContentView(string $view): string{
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }
    
    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render(string $view, array $vars = []): string{
        
        // CONTEÚDO DA VIEW
        $contentView = self::getContentView($view);

        //Une as variaveis da view
        $vars = array_merge(self::$vars, $vars);

        //CHAVES DO ARRAY DE VARIÁVEIS
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{ '.$item.' }}';
        }, $keys);
        
        // RETORNA O CONTEÚDO RENDERIZADO
        return str_replace($keys, array_values($vars), $contentView);
    }

}