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
        $comment->setParent($_POST['parentId']);
        $comment->setUser($_SESSION['id']);
        $commentModel->create($comment);
        $record = $commentModel->getLastComment();
        $database->closeDB($connect);
        require_once 'app/Resources/view/commentTemplate.php';
    }

    public function readAction($id)
    {
//        if (empty($id)) {
            $id = $_POST['id'];
//        }
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $record = $commentModel->read($id);
        $database->closeDB($connect);
        echo "<textarea name='editArea'>".$record['content']."</textarea>
            <input type='button' class='sendEdit' value='send'>";
    }

    public function updateAction()
    {
        $id = $_POST['id'];
        $database = new Database();
        $connect = $database->connectDB();
        $comment = new Comment();
        $comment->setContent($_POST['content']);
        $commentModel = new CommentModel($connect);
        $commentModel->update($id, $comment);
        $record = $commentModel->read($id);
        $database->closeDB($connect);
        require_once 'app/Resources/view/commentTemplate.php';
    }

    public function deleteAction()
    {
        $id = $_POST['id'];
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->delete($id);
        $database->closeDB($connect);
//        if ($result) echo "ok";
    }

    public function getAllAction() {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->getAllComments();
        require_once 'app/Resources/view/commentsTemplate.php';
        $database->closeDB($connect);
    }

    public function getAllChildAction() {
        $database = new Database();
        $connect = $database->connectDB();
        $commentModel = new CommentModel($connect);
        $result = $commentModel->getCommentsByParent($_POST['parentId']);
        while ($record = mysqli_fetch_array($result)) {
            require 'app/Resources/view/commentTemplate.php';
        }
        $database->closeDB($connect);
    }
}