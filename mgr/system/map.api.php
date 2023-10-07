<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } elseif($_SESSION['a77permission'] != 'leader') {
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

    /* find member of group */ 

    $team = $db_nms->get("db_user_group");
    $b = array(); // initialize the array
    foreach ($team as $value) {
        $a = json_decode($value['leader']);
        foreach ($a as $key => $group) {
            if (!isset($b[$group])) {
                $b[$group] = array(); // initialize the array for the group if it doesn't exist
            }
            $teams[$group][] = $value['id']; // append the value to the end of the array
        }
    }
    $leader = $teams[$userid];
    $member = $db_nms->where('id',$leader,'IN')->get("db_user_group");
    $loop = array();
    foreach ($member as $value) {
        $loop = array_merge($loop, json_decode($value['detail'], true));
    }

    /* todo api */
    foreach (array_unique($loop) as $value) {

        $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
        //$db->where("a.agen_parent", $value);
        $db->where("a.agen_parent", $value)->where("a.agen_status", 2);
        $member = $db->get ("a77_provinces p", null, "p.code, p.name_in_thai, p.map_code");

        foreach ($member as $value) {
            $count[$value['name_in_thai']]++;
        }

        $prov = $db->get('a77_provinces');
        foreach ($prov as $value) {
            $api['map_data'][] = array('hc-key' => $value['map_code'], 'value' => ((int) $count[$value['name_in_thai']]));
        }

    }

    foreach ($count as $key => $value) {
        $total +=  (int) $value;
        $api['province'][] = array('name' => $key, 'value' => (int) $value);
        $api['counter'] = array('total' => $total);
    }

    print_r(json_encode($api));