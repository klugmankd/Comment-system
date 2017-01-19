<?php

namespace model\Comment;


use entity\Comment\Comment as CommentEntity;
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
     * @param CommentEntity $comment
     * @return bool|mysqli_result
     */
    public function create(CommentEntity $comment)
    {
        $expression = "INSERT INTO `Comment-system_DB`.`Comment` (`content`, `parent_id`, `user_id`) 
                      VALUES ('".$comment->getContent()."', 
                      '".$comment->getParent()."', 
                      '".$comment->getUser()."'
                      );";
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

    /**
     * @param int $id
     * @param CommentEntity $comment
     * @return bool|mysqli_result
     */
    public function update($id, CommentEntity $comment)
    {
        $expression = "UPDATE `Comment-system_DB`.`Comment` 
                      SET `content`='".$comment->getContent()."' WHERE `id`='".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    /**
     * @param int $id
     * @return bool|mysqli_result
     */
    public function delete($id)
    {
        $expression = "DELETE FROM `Comment-system_DB`.Comment WHERE parent_id = '".$id."';";
        $query = mysqli_query($this->connect, $expression);
        $expression = "DELETE FROM `Comment-system_DB`.Comment WHERE id = '".$id."';";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    /**
     * @return bool|mysqli_result
     */
    public function getAllComments()
    {
        $expression = "SELECT Comment.id, Comment.content, Comment.create_date, Comment.parent_id, Comment.user_id, User.username  
                      FROM User, Comment WHERE Comment.user_id = User.id  ORDER BY id DESC;";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

    /**
     * @return array|null
     */
    public function getLastComment()
    {
        $expression = "SELECT Comment.id, Comment.content, Comment.create_date, Comment.parent_id, Comment.user_id, User.username  
                      FROM User, Comment WHERE Comment.user_id = User.id ORDER BY id DESC LIMIT 1;";
        $query = mysqli_query($this->connect, $expression);
        $result = mysqli_fetch_assoc($query);
        return $result;
    }

    public function getCommentsByParent($parentId) {
        $expression = "SELECT Comment.id, Comment.content, Comment.create_date, Comment.parent_id, Comment.user_id, User.username  
                      FROM User, Comment WHERE parent_id = '".$parentId."' AND Comment.user_id = User.id 
                      ORDER BY id DESC;";
        $query = mysqli_query($this->connect, $expression);
        return $query;
    }

}