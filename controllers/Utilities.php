<?php

namespace Controllers;

/**
 * Classe utilitaire pour les fonctions communes.
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
     * @return void
     */
    public static function renderPage(array $datas_page): void
    {
        extract($datas_page);

        ob_start();
        require($views);
        $content = ob_get_clean();

        require_once($layout);
    }
}
