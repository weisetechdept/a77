<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['user_id'])){
        header("Location: /404");
    }
    $userid = $_SESSION['user_id'];

    $request = json_decode(file_get_contents('php://input'));

    $first_name = $request->firstName;
    $last_name = $request->lastName;
    $gender = $request->gender;
    $peopleId = $request->peopleId;
    $province = $request->province;

    $chk_family = $db_family->where('memb_people_id', $peopleId)->getOne('tpf_member');

    if(!isset($chk_family)){
        $data = Array (
            "agen_first_name" => $first_name,
            "agen_last_name" => $last_name,
            "agen_gender" => $gender,
            "agen_people_id" => $peopleId,
            "agen_province" => $province,
            "agen_parent" => $userid,
            "agen_status" => '0',
            "agen_datetime" => date("Y-m-d H:i:s")
        );
        
        $id = $db->insert ('a77_agent', $data);
        if ($id){
            echo json_encode(array('status' => '200'));
        } else {
            echo json_encode(array('status' => '505'));
        }
    } else {
        echo json_encode(array('status' => '400'));
    }
                
      
