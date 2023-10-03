<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

    $province = $db->orderBy('name_in_thai','ASC')->get('a77_provinces');
    foreach ($province as $value) {
        $api['province'][] = array('code' => $value['code'],'name' => $value['name_in_thai']);
    }

    print_r(json_encode($api));