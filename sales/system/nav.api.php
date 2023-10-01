<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    $profile = $db_nms->where('id','271')->getOne('db_member');
    $api['sales'] = array('name' => $profile['first_name'].' '.$profile['last_name'],'photo' => $profile['line_usrphoto']);

    print_r(json_encode($api));