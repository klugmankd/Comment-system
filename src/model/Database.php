<?php

namespace model\Database;

use mysqli;


class Database
{

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $database;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->host = DB_SERVER;
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->database = DB_NAME;
    }

    /**
     * @return mysqli
     */
    public function connectDB ()
    {
        $connect = mysqli_connect($this->host, $this->username, $this->password);
        if ($connect) {
            mysqli_select_db($connect, $this->database);
            mysqli_set_charset($connect, "utf8");
        }
        return $connect;
    }

    /**
     * @param mysqli $connect
     */
    public function closeDB ($connect)
    {
        mysqli_close($connect);
    }

}