<?php

    require_once 'app/Resources/view/headerTemplate.php';
    if (isset($_GET['route'])) {
        $url = $_GET['route'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        require 'src/controller/'.$url[0].'.php';
    }

    if ((isset($_POST['auth']))) {
        require_once ('app/Resources/view/authTemplate.php');
    } else
    if ((isset($_POST['registration']))) {
        require_once('app/Resources/view/registrationTemplate.php');
    } else {
        require_once 'app/Resources/view/baseTemplate.php';
    }

    $controller = new $url[0];

    if(isset($url[2])) {
        $controller->$url[1]($url[2]);
    } else {
        if(isset($url[1])) {
          $controller->$url[1]();
        }
    }
    require_once 'app/Resources/view/footerTemplate.php';
