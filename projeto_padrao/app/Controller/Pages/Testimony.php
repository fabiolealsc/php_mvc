<?php

namespace App\Controller\Pages;

use App\Model\Entity\Organization;
use App\Utils\View;

class Testimony extends Page
{
    /**
     * Método responsável por retornar o conteúdo(view) da nossa Depoimentos
     * @return string
     */
    public static function getTestimonies(): string
    {
        $obOrganization = new Organization;
        // VIEW TESTIMONU
        $content = View::render('pages/testimonies');

        // RETORNA A VIEW DA PAGINA
        return parent::getPage('TESTIMONY', $content);
    }
}
