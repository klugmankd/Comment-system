<?php

use entity\User\User;
use model\User\User as UserModel;
use model\Database\Database;

require_once ('src/entity/User.php');
require_once ('src/model/User.php');
require_once ('src/model/Database.php');


class UserController
{

    public function createAction()
    {
        $database = new Database();
        $connect = $database->connectDB();
        $userModel = new UserModel($connect);
        $user = new User();
        $user->setUsername($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $result = $userModel->create($user);
        $database->closeDB($connect);
        header('location: ../PageController/authAction');
    }

    public function checkAction()
    {
        $user = array(
            "username" => trim($_POST['username']),
            "password" => trim($_POST['password'])
        );
        $database = new Database();
        $connect = $database->connectDB();
        $userModel = new UserModel($connect);
        $userData = $userModel->read($user['username']);
        if ($user['username'] == $userData['username']
            && $user['password'] == $userData['password']) {
            $_SESSION['id'] = $userData['id'];
            header('location: ../PageController/commentsAction');
        } else header("Location: ../PageController/authAction");
        $database->closeDB($connect);
    }
}