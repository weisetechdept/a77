<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $id = $_GET['id'];

    $sales = $db_nms->where('id',$id)->getOne('db_member');

    /* find team */
    function find_team($id){
        global $db_nms;
        $team = $db_nms->get('db_user_group');
        foreach ($team as $val) {
            $se = array_search($id,json_decode($val['detail']));
            if($se !== false){
                $sale_team = $val['name'];
            }
        }
        return $sale_team;
    }

    $total = $db->where('agen_parent',$id)->getValue('a77_agent','count(*)');
    $approve_count = $db->where('agen_parent',$id)->where('agen_status',2)->getValue('a77_agent','count(*)');
    $pending_count = $db->where('agen_parent',$id)->where('agen_status',1)->getValue('a77_agent','count(*)');
    $docs_count = $db->where('agen_parent',$id)->where('agen_status',0)->getValue('a77_agent','count(*)');
    $reject_count = $db->where('agen_parent',$id)->where('agen_status',10)->getValue('a77_agent','count(*)');

    $agen_pv = $db->where('agen_parent',$id)->where('agen_status',2)->get('a77_agent');
    foreach ($agen_pv as $value) {
        $pv[] = $value['agen_province'];
    }
    $pvu = array_unique($pv);

    $api['sales'] = array('id' => $sales['id'], 'name' => $sales['first_name'].' '.$sales['last_name'],'team' => find_team($id));
    $api['agent'] = array('total' => $total,'approve' => $approve_count,'pending' => $pending_count,'docs' => $docs_count,'reject' => $reject_count,'pv' => count($pvu));

    $db->join('a77_agent a','a.agen_province=p.code','LEFT');
    $db->where('a.agen_parent',$id);
    $agent = $db->get('a77_provinces p',null,'agen_id,agen_first_name,agen_last_name,name_in_thai,agen_gender,agen_people_id,agen_tel,agen_status,agen_datetime');
    foreach ($agent as $value) {

        $api['data'][] = array($value['agen_id'],
            $value['agen_first_name'].' '.$value['agen_last_name'],
            $value['name_in_thai'],
            $value['agen_gender'],
            'xxxxxxxx'.substr($value['agen_people_id'],8),
            'xxxxxx'.substr($value['agen_tel'],5),
            $value['agen_status'],
            $value['agen_datetime']
        );
    }
    

    echo json_encode($api);