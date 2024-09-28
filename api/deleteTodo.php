<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method == "DELETE") {
    include "./config/database.php";
    include "./model/Todo.php";

    $database = new Database();
    $db = $database->connectDB();

    $todo = new Todo($db);

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (!empty($inputData["id"])) {
        $todo->id = $inputData["id"];

        $todo->delete();
        $data = array("status" => 200, "message" => "Task Deleted");
        header("HTTP/1.1 200 OK");

        return;
    } else {
        $data = array("status" => 400, "message" => "Invalid Data");
        header("HTTP/1.1 400 Bad Request");
        return;
    }
} else {
    $data = array("status" => 405, "message" => "Method Not Allowed");
    header("HTTP/1.1 405 Method Not Allowed");

    echo json_encode($data);
    return;
}
