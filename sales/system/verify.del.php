<?php
        session_start();
        require_once '../../db-conn.php';

        $data = json_decode(file_get_contents("php://input"));
        $img_id = $data->img_id;

        $db->join("a77_agent_img i", "i.aimg_parent=a.agen_id", "INNER");
        $db->where('aimg_group',2)->where('aimg_status',1)->where('i.aimg_img_id',$img_id);
        $chk = $db->get('a77_agent a', null, 'a.agen_id');

        if(count($chk) > 0){

            $data = Array (
                'aimg_status' => 0
            );
            $db->where ('aimg_img_id', $img_id);
            if ($db->update ('a77_agent_img', $data)){
                echo json_encode(array('status' => '200'));
            } else {
                echo json_encode(array('status' => '505'));
            }

        } else {
            echo json_encode(array('status' => '400'));
        }

      