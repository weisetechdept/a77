<?php
    session_start();
    require_once 'db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    $req = json_decode(file_get_contents('php://input'), true);
    $request = $req['strthai_id'];

    $chk = $db->where('agen_people_id',$request)->getOne('a77_agent');

    $sale = $db_nms->where('id',$chk['agen_parent'])->getOne('db_member');

    if(!empty($chk['agen_id'])){

        if($chk['agen_status'] == '2'){
            $s_status = 'approve';
        } else {
            $s_status = 'reject';
        }

        $api = array('name' => $chk['agen_first_name'].' '.$chk['agen_last_name'], 'status' => $s_status, 'regis_date' => $chk['agen_datetime'], 'memo' => null, 'sale_owner' => $sale['first_name'].' '.$sale['last_name']);

        echo json_encode(array('status' => '200', 'message' => 'success', 'data' => $api));
    } else {
        echo json_encode(array('status' => '404', 'message' => 'data not found'));
    }