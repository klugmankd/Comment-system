<?php
    session_start();

    if(empty(isset($_GET['route']))) {
        require_once 'app/Resources/view/linksTemplate.php';
        require_once 'app/Resources/view/homeTemplate.php';
    } else {
        require_once 'app/Resources/view/headTemplate.php';
        if ($_GET['route'] == 'PageController/commentsAction') {
            require_once 'app/Resources/view/logoutTemplate.php';
        }
    }

    if (isset($_GET['route'])) {
        $url = $_GET['route'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        require 'src/controller/'.$url[0].'.php';
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
