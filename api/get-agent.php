<?php
    session_start();
    require_once 'db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    $req = json_decode(file_get_contents('php://input'), true);
    $request = $req['strthai_id'];

    //$chk = $db->where('agen_people_id',$request)->getOne('a77_agent');

    $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
    $db->where("a.agen_people_id", $request);
    $chk = $db->getOne ("a77_provinces p", null, "a.agen_id,a.agen_first_name, a.agen_last_name, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_gender, a.agen_parent, a.agen_tel");


    $sale = $db_nms->where('id',$chk['agen_parent'])->getOne('db_member');

    if(!empty($chk['agen_id'])){

        if($chk['agen_status'] == '2'){
            $s_status = 'approve';
        } else {
            $s_status = 'reject';
        }

        $img = $db->where('aimg_parent',$chk['agen_id'])->get('a77_agent_img');
        foreach($img as $i){
            $img_arr = array($i['aimg_link']);
        }

        $api = array('name' => $chk['agen_first_name'].' '.$chk['agen_last_name'],'gender' => $chk['agen_gender'],'province' => $chk['$name_in_thai'],'livein' => null, 'status' => $s_status, 'regis_date' => $chk['agen_datetime'], 'memo' => array(array('campaign' => null, 'end_date' => null)), 'docs_img' => $img_arr,'sale_owner' => $sale['first_name'].' '.$sale['last_name']);

        echo json_encode(array('status' => '200', 'message' => 'success', 'data' => $api));
    } else {
        echo json_encode(array('status' => '404', 'message' => 'data not found'));
    }