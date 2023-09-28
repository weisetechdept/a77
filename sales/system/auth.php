<?php
    session_start();
    require_once '../../db-conn.php';
    
    $request = json_decode(file_get_contents('php://input'));
    $userId = $request->userId;

        $profile = $db_nms->where('line_usrid',$userId)->getOne('db_member');
        //echo json_encode($profile);
        if(isset($profile['id'])) {
            //$_SESSION['line_id'] = $profile['memb_id'];
            echo json_encode(array('status' => '200'));
        } else {
            echo json_encode(array('status' => '400'));
        }
    
    //$db->join("tpf_point_trans p", "c.camp_id=p.poit_campaign", "LEFT");
	//$db->where("p.poit_parent", $profile['memb_id']);
	//$products = $db->get("tpf_campaign c", null, "c.camp_topic, c.camp_point ,p.poit_datetime");
?>