<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

    $sales_u = $_GET['u'];

    /* function */
    function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

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
    $chk = array_search($sales_u,$loop);

    if(!empty($chk)){

        $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
        $db->where("a.agen_parent", $sales_u);
        $member = $db->get("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id");
    
        foreach ($member as $value) {
            $thai_id = 'xxxxxxxx'.substr($value['agen_people_id'],8);
            $api['data'][] = array($value['agen_id'],$value['agen_first_name'],$value['agen_last_name'],$thai_id,$value['name_in_thai'],$value['agen_status'],DateThai($value['agen_datetime']));
        }
    
        $sales_data = $db_nms->where('id',$sales_u)->getOne("db_member");
        $agent_all = $db->where('agen_parent',$sales_u)->getValue('a77_agent',"count(*)");
        $agent_upload = $db->where('agen_parent',$sales_u)->where('agen_status',0)->getValue('a77_agent',"count(*)");
        $agent_wait = $db->where('agen_parent',$sales_u)->where('agen_status',1)->getValue('a77_agent',"count(*)");
        $agent_active = $db->where('agen_parent',$sales_u)->where('agen_status',2)->getValue('a77_agent',"count(*)");
        $agent_reject = $db->where('agen_parent',$sales_u)->where('agen_status',10)->getValue('a77_agent',"count(*)");
    
        $api['counter'] = array('name' => $sales_data['first_name'].' '.$sales_data['last_name'],'all' => $agent_all, 'upload' => $agent_upload, 'active' => $agent_active, 'pending' => $agent_wait, 'reject' => $agent_reject);
    

    }  else {
        $api = array('status' => 404);
    }



   
    print_r(json_encode($api));