<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('../config/config.php');

    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $res = $config->signup_user($username, $email, $password);

        if($res) {
            $arr['data'] = 'User created successfully...';
            http_response_code(201);
        } else {
            $arr['data'] = 'User creation failed...';
        }
    } else {
        $arr['data'] = 'Only POST request method is allowed...';
    }

    echo json_encode($arr);

?>