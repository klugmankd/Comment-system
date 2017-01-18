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

    public function commentsAction()
    {
        require_once('app/Resources/view/baseTemplate.php');
    }
}