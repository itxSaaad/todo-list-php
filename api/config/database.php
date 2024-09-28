<?php

class Database
{
    private $host;
    private $dbusername;
    private $dbpassword;
    private $dbname;
    public $connection;

    public function connectDB()
    {
        $this->connection = null;

        try {
            $this->host = 'localhost';
            $this->dbusername = 'root';
            $this->dbpassword = '';
            $this->dbname = 'todo_crud';

            $this->connection = mysqli_connect($this->host, $this->dbusername, $this->dbpassword, $this->dbname);

            return $this->connection;
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }
    }
}
