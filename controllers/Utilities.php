<?php

class Utilities {

    public static function renderPage($datas_page){

        extract($datas_page);
        ob_start();
        require($views);
        $content = ob_get_clean();
        require_once($layout);
    }

    public static function showArray($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}