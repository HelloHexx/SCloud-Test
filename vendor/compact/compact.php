<?php

namespace Compact;

define("VIEW", "./views/");

class Compact{
    public $_GLOBAL = NULL;
    
    public function view($view,$data){
        return require VIEW . $view.'.php';
    }
}

?>