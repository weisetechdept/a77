<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
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
 
    $db->join("a77_agent_img i", "i.aimg_parent=a.agen_id", "RIGHT");
    $db->where('aimg_group',1)->where("a.agen_id",$_GET['u']);
    $img = $db->get("a77_agent a", null, "i.aimg_img_id, i.aimg_link , i.aimg_link_500, i.aimg_group, i.aimg_parent, i.aimg_status, i.aimg_datetime, a.agen_parent");

    foreach ($img as $value) {
        $chk = array_search($value['agen_parent'],$loop);
        if(!empty($chk)){
            $api['img'][] = array('link' => $value['aimg_link'],
                'link_500' => $value['aimg_link_500'],
                'datetime' => DateThai($value['aimg_datetime']));
        }
    }


    print_r(json_encode($api));