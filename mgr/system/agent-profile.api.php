<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_SESSION['a77permission'] != 'leader') {
        header("Location: /404");
    }
    
    $userid = $_SESSION['a77usrid'];

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

    /*
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
    */

    function mgr($data){
        global $db_nms;
        $group = $db_nms->get('db_user_group');
        foreach($group as $value){
            $chk = in_array($data, json_decode($value['leader']));
            if($chk){
                foreach(json_decode($value['detail']) as $emp){
                    $team[] = $emp;
                }
            }
        }
        return array_unique($team);
    }
    /*
    $leader = mgr($userid);
    $member = $db_nms->where('id',$leader,'IN')->get("db_user_group");
    $loop = array();
    foreach ($member as $value) {
        $loop = array_merge($loop, json_decode($value['detail'], true));
    }
    */

    /* todo api */
    $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
    $db->where("a.agen_id",$_GET['u']);
    $member = $db->getOne ("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender, a.agen_parent");

    $chk = array_search($member['agen_parent'],mgr($userid));

    if(!empty($chk)){
        $thai_id = 'xxxxxxxx'.substr($member['agen_people_id'],8);
        if($member['agen_gender'] == 'male'){
            $g = 'ชาย';
        } else {
            $g = 'หญิง';
        }
        $api['agent'] = array('id' => $member['agen_id'],
            'name' => $member['agen_first_name'].' '.$member['agen_last_name'],
            'province' => $member['name_in_thai'],
            'thai_id' => $thai_id,
            'gender' => $g,
            'status' => $member['agen_status'],
            'datetime' => DateThai($member['agen_datetime']
        ));
    } else {
        $api = array('status' => 404);
    }

    print_r(json_encode($api));