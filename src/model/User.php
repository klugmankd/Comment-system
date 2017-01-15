<?php

namespace model\User;

use entity\User\User as Us;
use mysqli;
use mysqli_result;

class User
{

    /**
     * @var mysqli
     */
    private $connect;

    /**
     * Comment constructor.
     * @param mysqli $connect
     */
    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    /**
     * @param Us|User $user
     * @return bool|mysqli_result
     */
    public function create(Us $user)
    {
        $expression = "INSERT INTO `Comment-system_DB`.`User` (`username`, `email`, `password`, `first_name`, `last_name`) VALUES ('".$user->getUsername()."', '".$user->getEmail()."', '".$user->getPassword()."', '".$user->getFirstName()."', '".$user->getLastName()."');";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    /**
     * @param $username
     * @return array|null
     */
    public function read($username)
    {
        $expression = "SELECT * FROM `Comment-system_DB`.`User` WHERE username = '".$username."';";
        $query = mysqli_query($this->connect, $expression);
        $result = mysqli_fetch_assoc($query);
        return $result;
    }

    public function update($id, $comment)
    {
        $expression = "UPDATE `Comment-system_DB`.`Comment` SET `content`='".$comment->getContent()."' WHERE `id`='".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    public function delete($id)
    {
        $expression = "DELETE FROM `Comment-system_DB`.`User` WHERE id = '".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }
}