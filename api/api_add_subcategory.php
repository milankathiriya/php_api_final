<?php

    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");

    include('../config/config.php');

    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $cat_id = $_POST['cat_id'];
        
        $res = $config->add_subcategory($name, $cat_id);

        if($res) {
            $arr['data'] = "Subcategory inserted successfully...";
            http_response_code(201);
        } else {
            $arr['data'] = "Subcategory insertion failed...";
        }

    } else {
        $arr['data'] = "only POST request is allowed...";
    }

    echo json_encode($arr);

?>