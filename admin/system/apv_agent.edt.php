<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $request = json_decode(file_get_contents('php://input'));
    $checked = $request->checkedAgent;
    $action = $request->action;

    if(isset($checked) && isset($action)){

        foreach ($checked as $value) {
            $data = Array (
                'agen_status' => $action
            );
            $db->where ('agen_id', $value);
            if ($db->update ('a77_agent', $data)){
                $api = array('status' => 200);
            } else {
                $api = array('status' => 505);
            }
        }
    
    } else {
        echo json_encode(array('status' => 404));
        exit();
    }

    echo json_encode($api);