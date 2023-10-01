<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

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
    $member = $db->get ("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender");

    foreach ($member as $value) {
        $thai_id = 'xxxxxxxx'.substr($value['agen_people_id'],8);
        if($value['agen_gender'] == 'male'){
            $g = 'ชาย';
        } else {
            $g = 'หญิง';
        }
        $api['agent'] = array('id' => $value['agen_id'],
            'name' => $value['agen_first_name'].' '.$value['agen_last_name'],
            'province' => $value['name_in_thai'],
            'thai_id' => $thai_id,
            'gender' => $g,
            'status' => $value['agen_status'],
            'datetime' => DateThai($value['agen_datetime']
        ));
    }

    $db->join("a77_agent_img i", "i.aimg_parent=a.agen_id", "RIGHT");
    $db->where('aimg_group',1)->where("a.agen_id",$_GET['u']);
    $img = $db->get("a77_agent a", null, "i.aimg_img_id, i.aimg_link, i.aimg_group, i.aimg_parent, i.aimg_status, i.aimg_datetime");

    foreach ($img as $value) {
        $api['img'][] = array('link' => $value['aimg_link'],
            'datetime' => DateThai($value['aimg_datetime']
        ));
    }

    print_r(json_encode($api));