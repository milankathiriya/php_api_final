<?php

    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");

    include('../config/config.php');

    $config = new Config();

    $arr = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $age = $_POST['age'];
        $course = $_POST['course'];
        
        $res = $config->insert_student($name, $age, $course);

        if($res) {
            $arr['data'] = "Student inserted successfully...";
            http_response_code(201);
        } else {
            $arr['data'] = "Student insertion failed...";
        }

    } else {
        $arr['data'] = "only POST request is allowed...";
    }

    echo json_encode($arr);

?>