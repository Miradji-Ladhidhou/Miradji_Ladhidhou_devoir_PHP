<?php

namespace Controllers;

/**
 * Classe utilitaire pour le rendu des pages.
 */
class Utilities
{
    /**
     * Rend une page en extrayant les données passées, puis en incluant la vue et le layout.
     *
     * @param array<string, mixed> $datas_page Tableau associatif contenant :
     *                                         - 'views' (string) : chemin de la vue
     *                                         - 'layout' (string) : chemin du layout
     *                                         - autres clés à extraire en variables pour la vue
     *
     * @throws \InvalidArgumentException Si les clés 'views' ou 'layout' sont absentes dans $datas_page
     *
     * @return void
     */
    public static function renderPage(array $datas_page): void
    {
        extract($datas_page);

        if (!isset($views) || !isset($layout)) {
            throw new \InvalidArgumentException('Les clés "views" et "layout" doivent être présentes dans le tableau $datas_page.');
        }

        ob_start();
        require($views);
        $content = ob_get_clean();

        require_once($layout);
    }
}
