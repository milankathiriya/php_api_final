<?php

    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json");

    include('../config/config.php');

    $config = new Config();

    if($_SERVER['REQUEST_METHOD'] == 'DELETE') {

        $input = file_get_contents('php://input');

        parse_str($input, $_DELETE);

        $res = $config->delete_student($_DELETE['id']);

        if($res == 1) {
            $arr['data'] = 'Record deleted successfully...';
        } else {
            $arr['data'] = 'Record deletion failed...';
        }

    } else {
        $arr['data'] = 'Only DELETE method is allowed...'; 
    }

    echo json_encode($arr);

?>