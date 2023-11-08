<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    if($_SESSION['a77in_admin'] !== true){
        header('Location: /404');
    }

    $strsearch = $_GET['strsearch'];

    if($strsearch == ''){

        $api['data'] = array();

    } else {

        $db->where("agen_first_name", '%'.$strsearch.'%', 'like')->orWhere("agen_last_name", '%'.$strsearch.'%', 'like');
        $search = $db->get("a77_agent");

        /* find team */
        function find_team($id){
            global $db_nms;
            $team = $db_nms->get('db_user_group');
            foreach ($team as $val) {
                $se = array_search($id,json_decode($val['detail']));
                if($se !== false){
                    $sale_team[] = $val['name'];
                }
            }
            return $sale_team;
        }

        if($search == null){
            $api['data'] = array();
        } else {

            foreach ($search as $value) {
                if($value['agen_gender'] == 'female'){
                    $gender = 'หญิง';
                } else {
                    $gender = 'ชาย';
                }
                $pv = $db->where('code',$value['agen_province'])->getOne('a77_provinces');
                $sales = $db_nms->where('id', $value['agen_parent'])->getOne('db_member');
    
                $api['data'][] = array($value['agen_id'],
                    $value['agen_first_name'].' '.$value['agen_last_name'],
                    $gender,
                    'xxxxxx'.substr($value['agen_tel'],5),
                    'xxxxxxxx'.substr($value['agen_people_id'],8),
                    $pv['name_in_thai'],
                    $sales['first_name'].' '.$sales['last_name'],
                    find_team($value['agen_parent']),
                    $value['agen_status'],
                    $value['agen_datetime'],
                    $sales['id']
                );
            }

        }

        

    }

    

    echo json_encode($api);

