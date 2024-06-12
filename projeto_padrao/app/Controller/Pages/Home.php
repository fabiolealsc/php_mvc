<?php

namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\Utils\View;

class Home extends Page{
    /**
     * Método responsável por retornar o conteúdo(view) da nossa home
     * @return string
     */
    public static function getHome(): string{
        $obOrganization = new Organization;
        // VIEW HOME
        $content = View::render('pages/home', [
            'name' => $obOrganization->name,
        ]);
        
        // RETORNA A VIEW DA PAGINA
        return parent::getPage('HOME', $content);
    }

}