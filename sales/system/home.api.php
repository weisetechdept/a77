<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
    $userid = $_SESSION['a77usrid'];

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

    $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
    $db->where("a.agen_parent", $userid);
    $member = $db->get ("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id");

    foreach ($member as $value) {
        $thai_id = 'xxxxxxxx'.substr($value['agen_people_id'],8);
        $api['data'][] = array($value['agen_id'],$value['agen_first_name'],$value['agen_last_name'],$thai_id,$value['name_in_thai'],$value['agen_status'],DateThai($value['agen_datetime']));
    }

    $profile = $db_nms->where('id',$userid)->getOne('db_member');
    $api['sales'] = array('name' => $profile['first_name'].' '.$profile['last_name'],'photo' => $profile['line_usrphoto']);

    print_r(json_encode($api));