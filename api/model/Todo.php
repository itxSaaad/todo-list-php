<?php

class Todo
{
    private $connection;
    private $table_name = "tasks";

    public $id;
    public $task;
    public $completed;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function read()
    {
        $sql_query = "SELECT * FROM " . $this->table_name;
        $result = mysqli_query($this->connection, $sql_query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $tasks = array();

                while ($row = mysqli_fetch_assoc($result)) {
                    extract($row);

                    $task = array(
                        'id' => $id,
                        'task' => $task,
                        'completed' => $completed
                    );

                    array_push($tasks, $task);
                }

                $data = array('status' => 200, 'message' => 'Tasks found', 'data' => $tasks);
                header("HTTP/1.1 200 OK");

                echo json_encode($data);
            } else {
                $data = array("status" => 404, "message" => "No tasks found");
                header("HTTP/1.1 404 Not Found");

                echo json_encode($data);
            }
        } else {
            $data =  array("status" => 500, "message" => "Internal Server Error");
            header("HTTP/1.1 500 Internal Server Error");

            echo json_encode($data);
        }
    }

    public function create()
    {
        $task = mysqli_real_escape_string($this->connection, $this->task);
        $completed = mysqli_real_escape_string($this->connection, $this->completed);

        if (empty(trim($task))) {
            $data = array("status" => 400, "message" => "Task and Completed fields are required");

            header("HTTP/1.1 400 Bad Request");

            echo json_encode($data);
        } else {
            $sql_query = "INSERT INTO " . $this->table_name . " (task, completed) VALUES ('$task', '$completed')";
            $result = mysqli_query($this->connection, $sql_query);


            if ($result) {
                $data = array("status" => 201, "message" => "Task created");

                header("HTTP/1.1 201 Created");

                $sql_query = "SELECT * FROM " . $this->table_name;
                $result = mysqli_query($this->connection, $sql_query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $tasks = array();

                        while ($row = mysqli_fetch_assoc($result)) {
                            extract($row);

                            $task = array(
                                'id' => $id,
                                'task' => $task,
                                'completed' => $completed
                            );

                            array_push($tasks, $task);
                        }

                        $data['data'] = $tasks;
                    }
                }

                echo json_encode($data);
            } else {
                $data =  array("status" => 500, "message" => "Internal Server Error");

                header("HTTP/1.1 500 Internal Server Error");

                echo json_encode($data);
            }
        }
    }

    public function update()
    {
        $completed = mysqli_real_escape_string($this->connection, $this->completed);


        $sql_query = "UPDATE " . $this->table_name . " SET completed = '$completed' WHERE id = " . $this->id;
        $result = mysqli_query($this->connection, $sql_query);

        if ($result) {
            $data = array("status" => 200, "message" => "Task updated");

            header("HTTP/1.1 200 OK");

            $sql_query = "SELECT * FROM " . $this->table_name;
            $result = mysqli_query($this->connection, $sql_query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $tasks = array();

                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);

                        $task = array(
                            'id' => $id,
                            'task' => $task,
                            'completed' => $completed
                        );

                        array_push($tasks, $task);
                    }

                    $data['data'] = $tasks;
                }
            }

            echo json_encode($data);
        } else {
            $data =  array("status" => 500, "message" => "Internal Server Error");

            header("HTTP/1.1 500 Internal Server Error");

            echo json_encode($data);
        }
    }

    public function delete()
    {
        $sql_query = "DELETE FROM " . $this->table_name . " WHERE id = " . $this->id;
        $result = mysqli_query($this->connection, $sql_query);

        if ($result) {
            $data = array("status" => 200, "message" => "Task deleted");

            header("HTTP/1.1 200 OK");

            $sql_query = "SELECT * FROM " . $this->table_name;
            $result = mysqli_query($this->connection, $sql_query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $tasks = array();

                    while ($row = mysqli_fetch_assoc($result)) {
                        extract($row);

                        $task = array(
                            'id' => $id,
                            'task' => $task,
                            'completed' => $completed
                        );

                        array_push($tasks, $task);
                    }

                    $data['data'] = $tasks;
                }
            }

            echo json_encode($data);
        } else {
            $data =  array("status" => 500, "message" => "Internal Server Error");

            header("HTTP/1.1 500 Internal Server Error");

            echo json_encode($data);
        }
    }
}
