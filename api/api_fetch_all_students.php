<?php

    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: application/json');

    include('../config/config.php');

    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $res = $config->fetch_all_students();

        $allStudents = [];

        while($record = mysqli_fetch_assoc($res)) {
            // array_push(array_name, element);
            array_push($allStudents, $record);
        }

        $arr['data'] = $allStudents;

    } else {
        $arr['data'] = 'Only GET method is allowed...'; 
    }

    echo json_encode($arr);

?>