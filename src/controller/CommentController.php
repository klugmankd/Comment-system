<?php

use entity\Comment\Comment;
use model\Comment\Comment as CommentModel;
use model\Database\Database;

require_once ('src/entity/Comment.php');
require_once ('src/model/Comment.php');
require_once ('src/model/Database.php');

class CommentController
{

    public function createAction()
    {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $comment = new Comment();
        $comment->setContent($_POST['content']);
        $comment->setParent(0);
        $comment->setUser($_SESSION['id']);
        $result = $commentModel->create($comment);
        $database->closeDB($connect);
        header("Location: ../PageController/commentsAction");
    }

    public function readAction($id)
    {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->read($id);
        $database->closeDB($connect);
        header("Location: ../PageController/commentsAction");
    }

    public function updateAction()
    {
        $database = new Database();
        $connect = $database->connectDB();
        $comment = new Comment();
        $comment->setContent($_POST['content']);
        $commentModel = new CommentModel($connect);
        $result = $commentModel->update($_POST['id'], $comment);
        if ($result)
            header("Location: readAction/".$_POST['id']);
        $database->closeDB($connect);
    }

    public function deleteAction($id)
    {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->delete($id);
        $database->closeDB($connect);
        if ($result) echo "ok";
    }

    public function getAllAction() {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->getAllComments();
        require_once 'app/Resources/view/commentsTemplate.php';
        $database->closeDB($connect);
    }

}