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

        $chk = $db->where('aimg_parent',$agrnt_id)->where('aimg_group',2)->where('aimg_status',1)->get('a77_agent_img');

        if(count($chk) == 0){

            $data = Array (
                "aimg_img_id" => $img_id,
                "aimg_link" => $img_link,
                "aimg_link_500" => $img_link_500,
                "aimg_group" => "2",
                "aimg_parent" => $agrnt_id,
                "aimg_status" => "1",
                "aimg_datetime" => date("Y-m-d H:i:s")
            );
            
            $id = $db->insert ('a77_agent_img', $data);
            if ($id){
                $db->where('agen_id',$agrnt_id);
                $db->update('a77_agent', array('agen_status' => '1'));
                if($db->count > 0){
                    echo json_encode(array('status' => '200'));
                }
            } else {

                echo json_encode(array('status' => '400'));
            }

        } else {
            echo json_encode(array('status' => '400'));
        }
    
        
    }