<?php

namespace model\Comment;


use entity\Comment\Comment as Com;
use mysqli;
use mysqli_result;

class Comment
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
     * @param Com|Comment $comment
     * @return bool|mysqli_result
     */
    public function create(Com $comment)
    {
        $expression = "INSERT INTO `Comment-system_DB`.`Comment` (`content`, `parent_id`, `user_id`) VALUES ('".$comment->getContent()."', '".$comment->getParent()."', '".$comment->getUser()."');";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function read($id)
    {
        $expression = "SELECT * FROM `Comment-system_DB`.Comment WHERE id = '".$id."';";
        $query = mysqli_query($this->connect, $expression);
        $result = mysqli_fetch_assoc($query);
        return $result;
    }

    public function update($id, Com $comment)
    {
        $expression = "UPDATE `Comment-system_DB`.`Comment` SET `content`='".$comment->getContent()."' WHERE `id`='".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    public function delete($id)
    {
        $expression = "DELETE FROM `Comment-system_DB`.Comment WHERE id = '".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    public function getAllComments()
    {
        $expression = "SELECT * FROM `Comment-system_DB`.Comment ORDER BY id DESC;";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

}