<?php

use entity\User\User;
use model\User\User as UserModel;
use model\Database\Database;

require_once ('src/entity/User.php');
require_once ('src/model/User.php');
require_once ('src/model/Database.php');


class UserController
{

    public function regAction()
    {
        require_once('app/Resources/view/registrationTemplate.php');
    }

    public function authAction()
    {
        require_once('app/Resources/view/authTemplate.php');
    }

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
        header('location: authAction');
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
//            session_start();
//            $_SESSION['id'] = $userData['id'];
//            header('location: ../PageController/commentsAction');
            echo "ok";
        } else {
            echo "no ok";
        }
        $database->closeDB($connect);
    }
}