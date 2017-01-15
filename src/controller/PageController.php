<?php


class PageController
{
    public function regAction()
    {
        require_once('app/Resources/view/registrationTemplate.php');
    }

    public function authAction()
    {
        require_once('app/Resources/view/authTemplate.php');
    }
}