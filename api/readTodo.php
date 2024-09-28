<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method == "GET") {
    include "./config/database.php";
    include "./model/Todo.php";

    $database = new Database();
    $db = $database->connectDB();

    $todo = new Todo($db);

    $todo->read();
} else {
    $data =  array("status" => 405, "message" => $request_method . " method not allowed");

    header("HTTP/1.1 405 Method Not Allowed");

    echo json_encode($data);
}
