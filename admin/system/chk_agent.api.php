<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SESSION['a77in_admin'] !== true){
        header('Location: /404');
    }

    $request = json_decode(file_get_contents('php://input'));
    $people_id = $request->people_id;

    $agent = $db->where('agen_people_id',$people_id)->getOne('a77_agent');
    $sales_id = $agent['agen_parent'];

    if($agent['agen_gender'] == 'male'){
        $gender = 'ชาย';
    } else {
        $gender = 'หญิง';
    }

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

    /* check old cust */
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
        "strsearch" : '.$people_id.'
    }';
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);

    $results =json_decode($resp);
    $qm_status = $results[0]->salestatus;

    /* find sales */

    $sales = $db_nms->where('id', $sales_id)->getOne('db_member');
    $ct = $db->where('agen_parent', $sales_id)->where('agen_status',2)->get('a77_agent');
    foreach ($ct as $value) {
        $ct_id[] = $value['agen_province'];
        $agn = array_unique($ct_id);
    }

    /*  */
    if($qm_status == 'Sold'){
        $old_cust = 1;
    } else {
        $old_cust = 0;
    }

    $pv = $db->where('code',$agent['agen_province'])->getOne('a77_provinces');

    if($agent){
        
        $api = array('status' => 200);
        $api['sales'] = array('id' => $sales['id'],'name' => $sales['first_name'].' '.$sales['last_name'],'all_agent' => count($ct),'pv' => count($agn),'team' => find_team($sales_id));
        $api['agent'] = array('id' => $agent['agen_id'],'name' => $agent['agen_first_name'].' '.$agent['agen_last_name'],'gender' => $gender,'people_id' => $agent['agen_people_id'], 'tel' => '0'.$agent['agen_tel'],'province' => $pv['name_in_thai'],'check_qm' => $old_cust, 'status' => $agent['agen_status'],'date_reg' => date('d/m/Y',strtotime($agent['agen_datetime'])));

        $img = $db->where('aimg_parent',$agent['agen_id'])->get('a77_agent_img');
        foreach ($img as $img_value) {
            $api['img'][] = array('link' => $img_value['aimg_link']);
        }

        /* check invite */

        $url = "https://qms-toyotaparagon.com/api/sales/invite";
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
            "strsearch" : "'.$agent['agen_last_name'].'"
        }';
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
    
        $inv_results = json_decode($resp);
        if($inv_results){
            foreach ($inv_results as $inv_value) {
                $api['invite'][] = array('agent_name' => $inv_value->itemname,'cust_name' => $inv_value->customername, 'saleperson' => $inv_value->saleperson, 'saleteam' => $inv_value->saleteam, 'buydate' => $inv_value->buydate);
            }
        } else {
            $api['invite'] = array('status' => '404', 'message' => 'Not found');
        }

    } else {
        $api = array('status' => 404,'data' => 'ไม่พบข้อมูล');
    }

    echo json_encode($api);