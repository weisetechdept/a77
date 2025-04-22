<?php
    session_start();
    require_once 'db-conn.php';
    date_default_timezone_set("Asia/Bangkok");


    $req = json_decode(file_get_contents('php://input'), true);
    $request = $req['strthai_id'];

    //$chk = $db->where('agen_people_id',$request)->getOne('a77_agent');

    if($request == ''){
        $api = array('status' => '404', 'message' => 'data not found');
    } else {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://family-ms.toyotaparagon.com/api/family-qms-check");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('strthai_id' => $request)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if($response_data == null){

            $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
            $db->where("a.agen_people_id", $request);
            $chk = $db->getOne ("a77_provinces p", null, "a.agen_id,a.agen_first_name, a.agen_last_name, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_gender, a.agen_parent, a.agen_tel");

            $sale = $db_nms->where('id',$chk['agen_parent'])->getOne('db_member');

            $agt = $db->where('agen_parent', $chk['agen_parent'])->where('agen_status',2)->get('a77_agent');
            foreach ($agt as $value) {
                $pv[] = $value['agen_province'];
            }
            $pv_uni = array_unique($pv);

            if(!empty($chk['agen_id'])){

                if($chk['agen_status'] == '2'){
                    $s_status = 'approve';

                    $img = $db->where('aimg_parent',$chk['agen_id'])->get('a77_agent_img');
                    foreach($img as $i){
                        $img_arr[] = $i['aimg_link'];
                    }
                    $api_data = array('first_name' => $chk['agen_first_name'],'last_name' => $chk['agen_last_name'],'gender' => $chk['agen_gender'],'province' => $chk['name_in_thai'],'livein' => null, 'status' => $s_status, 'regis_date' => $chk['agen_datetime'], 'memo' => array(array('campaign' => 'A77-'.count($pv_uni), 'end_date' => '2012-12-31 23:59:59')), 'docs_img' => null,'sale_owner' => $sale['first_name'].' '.$sale['last_name']);
                    $api = array('status' => '200', 'message' => 'success', 'data' => $api_data);
                    
                } else {
                    $api = array('status' => '404', 'message' => 'data not found');
                }

            } else {
                $api = array('status' => '404', 'message' => 'data not found');
            }

        } else {
            $api_data = array(
                'first_name' => $response_data['data']['name'],
                'last_name' => $response_data['data']['lastname'],
                'gender' => null,
                'province' => null,
                'livein' => null,
                'status' => "approve",
                'regis_date' => $response_data['data']['regis_date'],
                'memo' => array(array('campaign' => 'T.Family',
                        'end_date' => date('Y-m-d H:i:s', strtotime('+1 month'))
                    )),
                'docs_img' => null,
                'sale_owner' => $response_data['data']['sale_owner']
            );

            $api = array('status' => '200', 'message' => 'success', 'data' => $api_data);
        }

        

    }

        

    echo json_encode($api);