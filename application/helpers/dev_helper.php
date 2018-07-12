<?php

defined('BASEPATH') OR exit('No direct script access allowed');



if (!function_exists('print_pre')) {

    function print_pre($array, $exit = false, $__FILE__ = NULL, $__LINE__ = NULL, $__METHOD__ = NULL) {
        echo "<pre>";
        echo $__FILE__ . '<br>';
        print_r($array);
        echo $__FILE__ . '<br>';
        echo $__LINE__ . '<br>';
        echo $__METHOD__ . '<br>';
        ;

        if ($exit) {
            exit("</pre>");
        } else {
            echo "</pre>";
        }
    }

}




