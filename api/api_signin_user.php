<?php

    header('Access-Control-Allow-Methods: POST');
    header('Content-Type: application/json');

    include('../config/config.php');

    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $res = $config->signin_user($username, $password);

        if($res) {
            $arr['data'] = 'Sign in successfully...';
            $arr['signin_status'] = true;
        } else {
            $arr['data'] = 'Sign in failed...';
            $arr['signin_status'] = false;
        }

    } else {
        $arr['data'] = 'Only POST request method is allowed...';
    }

    echo json_encode($arr);

?>