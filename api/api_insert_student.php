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
        $image = $_FILES['image'];     // a.array

        $filename = $image['name'];
        $temp_path = $image['tmp_name'];

        $uid = uniqid();

        $img_name = $uid . "-" . $filename;

        $destination_path = "../uploads/" . $img_name;

        $isFileUpload = move_uploaded_file($temp_path, $destination_path);  // returns bool

        if($isFileUpload) {
            $res = $config->insert_student($name, $age, $course, $img_name);

            if($res) {
                $arr['data'] = "Student inserted successfully...";
                http_response_code(201);
            } else {
                $arr['data'] = "Student insertion failed...";
            }
        } else {
            $arr['data'] = "Student insertion failed...";
        }        

    } else {
        $arr['data'] = "only POST request is allowed...";
    }

    echo json_encode($arr);

?>