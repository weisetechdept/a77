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
    $tel = $request->tel;
    $province = $request->province;

    $chk_family = $db_family->where('memb_people_id', $peopleId)->getOne('tpf_member');

    /* check agent */
    $url = "https://qms-toyotaparagon.com/api/prg_salecar_history";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '
    {
        "strsearch" : '.$peopleId.'
    }';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    $results =json_decode($resp);
    //print_r($resp);

    $qm_status = $results[0]->salestatus;
    //echo $qm_status;

    /* insert */
    if(!isset($chk_family) && $qm_status !== 'Sold'){
        $data = Array (
            "agen_first_name" => $first_name,
            "agen_last_name" => $last_name,
            "agen_gender" => $gender,
            "agen_people_id" => $peopleId,
            "agen_tel" => $tel,
            "agen_province" => $province,
            'agen_livein' => '',
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
                
      
