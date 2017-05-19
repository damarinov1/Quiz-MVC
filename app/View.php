<?php

class View
{

    public static function render($template, Array $data = [])
    {
        ob_start();
        include "views/" . $template . ".tpl.php";
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
