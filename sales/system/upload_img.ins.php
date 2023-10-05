<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } else {
        if($_SESSION['a77permission'] != 'user'){
            header("Location: /404");
        }
    }
    $userid = $_SESSION['a77usrid'];

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->aimg_img_id)){
        $img_id = $data->aimg_img_id;
        $img_link = $data->aimg_link;
        $img_link_500 = $data->aimg_link_500;
        $agrnt_id = $data->aimg_parent;
    
        $data = Array (
            "aimg_img_id" => $img_id,
            "aimg_link" => $img_link,
            "aimg_link_500" => $img_link_500,
            "aimg_group" => "1",
            "aimg_parent" => $agrnt_id,
            "aimg_status" => "1",
            "aimg_datetime" => date("Y-m-d H:i:s")
        );
        
        $id = $db->insert ('a77_agent_img', $data);
        if ($id){

            $chk = $db->where('agen_id',$agrnt_id)->getOne('a77_agent');
            //Update Status
            if($chk['agen_status'] == '0'){
                $data = Array (
                    'agen_status' => '1',
                );
                $db->where ('agen_id', $agrnt_id);
                if ($db->update ('a77_agent', $data)){
                    echo json_encode(array('status' => '200'));
                } else {
                    echo json_encode(array('status' => '400'));
                }

            } else {
                echo json_encode(array('status' => '200'));
            }
            
        } else {
            echo json_encode(array('status' => '400'));
        }
    }