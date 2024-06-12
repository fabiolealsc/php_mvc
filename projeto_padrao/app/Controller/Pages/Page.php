<?php

namespace App\Controller\Pages;

use App\Utils\View;

class Page{
    /**
     * Método responsável por renderizar o TOPO da página
     * @return string
     */
    private static function getHeader(): string{
        return View::render('pages/header');
    }

    /**
     * Método responsável por retornar o conteúdo(view) da nossa página
     *  @param string $title
     *  @param string $content
     *  @return string
     */
    public static function getPage(string $title, string $content): string{
        return View::render('pages/page', [
                'title'   => $title,
                'header'  => self::getHeader(),
                'content' => $content,
                'footer'  => self::getFooter()
            ]);
    }

    /**
     * Método responsável por renderizar o RODAPÉ da página
     * @return string
     */
    private static function getFooter(): string{
        return View::render('pages/footer');
    }


}