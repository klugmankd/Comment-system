<?php

use model\Comment\Comment as CommentModel;
use model\Database\Database;

require_once ('src/model/Comment.php');
require_once ('src/model/Database.php');

class PageController
{
    public function homeAction()
    {
        if(isset($_SESSION["id"]) && !empty($_SESSION["id"]))
            header("Location: commentsAction");
        else
            header("Location: ../");
    }

    public function regAction()
    {
        if(isset($_SESSION["id"]) && !empty($_SESSION["id"]))
            header("Location: commentsAction");
        else
            require_once('app/Resources/view/registrationTemplate.php');
    }

    public function authAction()
    {
        if(isset($_SESSION["id"]) && !empty($_SESSION["id"]))
            header("Location: commentsAction");
        else
            require_once('app/Resources/view/authTemplate.php');
    }

    public function commentsAction()
    {
        if(empty($_SESSION["id"]))
            header("Location: homeAction");
        require_once('app/Resources/view/baseTemplate.php');
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->getAllComments();
        require_once 'app/Resources/view/commentsTemplate.php';
        $database->closeDB($connect);
        echo "User(session) id - ".$_SESSION['id'];
    }

    public function logoutAction() {
        session_start();
        unset($_SESSION['id']);
        session_destroy();
        header("Location: ../");
    }
}