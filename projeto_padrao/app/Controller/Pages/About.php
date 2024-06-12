<?php

namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\Utils\View;

class About extends Page{
    /**
     * Método responsável por retornar o conteúdo(view) da nossa home
     * @return string
     */
    public static function getHome(): string{
        $obOrganization = new Organization;
        // VIEW HOME
        $content = View::render('pages/about', [
            'name' => $obOrganization->name,
            'description' => $obOrganization->description,
            'site' => $obOrganization->site
        ]);
        
        // RETORNA A VIEW DA PAGINA
        return parent::getPage('SOBRE', $content);
    }

}