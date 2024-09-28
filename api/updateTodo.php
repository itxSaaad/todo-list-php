<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method == "PUT") {
    include "./config/database.php";
    include "./model/Todo.php";

    $database = new Database();
    $db = $database->connectDB();

    $todo = new Todo($db);

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (!empty($inputData["id"])) {
        $todo->id = $inputData["id"];
        $todo->completed = $inputData["completed"];

        $todo->update();
    } else {
        $data = array("status" => 400, "message" => "ID, Task and completed fields are required");
        header("HTTP/1.1 400 Bad Request");

        echo json_encode($data);
    }
} else {
    $data = array("status" => 405, "message" => "Method Not Allowed");
    header("HTTP/1.1 405 Method Not Allowed");

    echo json_encode($data);
}
