<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

    $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
    $db->where("a.agen_parent", $userid)->where("a.agen_status", 2);
    $member = $db->get ("a77_provinces p", null, "p.code, p.name_in_thai, p.map_code,agen_province");


    foreach ($member as $value) {
        $count[$value['name_in_thai']]++;
        $pv[] = $value['agen_province'];
    }
    $pvu = array_unique($pv);
    $pvu_count = count($pvu);

    foreach ($count as $key => $value) {
        $api['province'][] = array('name' => $key, 'value' => (int) $value);
    }

    $prov = $db->get('a77_provinces');
    foreach ($prov as $value) {
        $api['map_data'][] = array('hc-key' => $value['map_code'], 'value' => ((int) $count[$value['name_in_thai']]));
    }

    $sale_data = $db_nms->where('id',$userid)->getOne('db_member');
    $api['sales'] = array('name' => $sale_data['first_name'].' '.$sale_data['last_name'],'count' => $pvu_count);
    
    print_r(json_encode($api));