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
    $request = json_decode(file_get_contents('php://input'));

    $first_name = $request->firstName;
    $last_name = $request->lastName;
    $gender = $request->gender;
    $peopleId = $request->peopleId;
    $province = $request->province;
    $tel = $request->tel;

    $u = $_GET['u'];

    $chk = $db->where('agen_id', $u)->where('agen_status', '10')->getOne('a77_agent');
    if($chk['agen_parent'] == $userid){

        $data = Array (
            'agen_first_name' => $first_name,
            'agen_last_name' => $last_name,
            'agen_gender' =>  $gender,
            'agen_people_id' => $peopleId,
            'agen_tel' => $tel,
            'agen_province' => $province
        );

        $db->where ('agen_id', $u);
        if ($db->update ('a77_agent', $data)){
            echo json_encode(array('status' => '200'));
        } else {
            echo json_encode(array('status' => '505'));
        }
    } else {
        echo json_encode(array('status' => '404'));
    }
                
      
