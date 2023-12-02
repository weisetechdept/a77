<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['a77in_admin'] !== true){
        header('Location: /404');
    }

    $db->join('a77_provinces p','p.code=a.agen_province','LEFT');
    $db->where('a.agen_status',2)->OrderBy('a.agen_datetime','DESC');
    $agent = $db->get('a77_agent a',15,'agen_id,agen_first_name,agen_last_name,name_in_thai,agen_people_id');

    foreach ($agent as $value) {

        $img = $db->where('aimg_parent',$value['agen_id'])->get('a77_agent_img');
        foreach ($img as $img_row) {
            $docs[] = array('id' => $img_row['aimg_id'],'link' => $img_row['aimg_link'],'date' => $img_row['aimg_datetime']);
        }

        $api['agent'][] = array('id' => $value['agen_id'],
            'name' => $value['agen_first_name'].' '.$value['agen_last_name'],
            'province' => $value['name_in_thai'],
            'thai_id' => $value['agen_people_id'],
            'docs' => $docs
        );
        $docs = array();
    }

    echo json_encode($api);