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
    $db->where("a.agen_id",$_GET['u']);
    $member = $db->getOne ("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender, a.agen_parent, a.agen_tel");

    if($userid == $member['agen_parent']){
        $thai_id = 'xxxxxxxx'.substr($member['agen_people_id'],8);
        if($member['agen_gender'] == 'male'){
            $g = 'ชาย';
        } else {
            $g = 'หญิง';
        }
        if(empty($member['agen_livein'])){
            $livepv = 0;
        } else {
            $lv_data = $db->where('code', $member['agen_livein'])->getOne('a77_provinces', null, 'name_in_thai');
            $livepv = $lv_data['name_in_thai'];
        }

        $api['agent'] = array('id' => $member['agen_id'],
            'name' => $member['agen_first_name'].' '.$member['agen_last_name'],
            'province' => $member['name_in_thai'],
            'livein' => $livepv,
            'thai_id' => $thai_id,
            'gender' => $g,
            'phone' => '0'.$member['agen_tel'],
            'status' => $member['agen_status'],
            'datetime' => DateThai($member['agen_datetime']
        ));
    } else {
        $api = array('status' => 404);
    }

    print_r(json_encode($api));