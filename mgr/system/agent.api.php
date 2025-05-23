<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } elseif($_SESSION['a77permission'] != 'leader') {
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

    if($_GET['p'] == 'all') {
        $page = array('0','1','2','10');
    } elseif($_GET['p'] == 'docs') {
        $page = array('0');
    } elseif($_GET['p'] == 'pending') {
        $page = array('1');
    } elseif($_GET['p'] == 'active') {
        $page = array('2');
    } elseif($_GET['p'] == 'reject') {
        $page = array('10');
    } else {
        header("Location: /404");
    }

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

    foreach (array_unique($loop) as $value) {

        $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
        $db->where("a.agen_parent",$value)->where("a.agen_status",$page,"IN");
        $member_raw = $db->get("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender, a.agen_parent");
        
        $sales = $db_nms->where('id',$value)->getOne("db_member");

        foreach ($member_raw as $member) {
            
            $thai_id = 'xxxxxxxx'.substr($member['agen_people_id'],8);
      
            $api['data'][] = array($member['agen_id'],
                $member['agen_first_name'],
                $member['agen_last_name'],
                $thai_id,
                $member['name_in_thai'],
                $member['agen_status'],
                DateThai($member['agen_datetime']),
                $sales['first_name'],
            );
            $i++;
            
        }

    }
/*
    $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
    $db->where("a.agen_id",$_GET['u']);
    $member = $db->getOne ("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender, a.agen_parent");

    if($userid == $member['agen_parent']){
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
*/
    print_r(json_encode($api));