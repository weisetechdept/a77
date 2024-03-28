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

    $leader = $teams[$userid];
    $member = $db_nms->where('id',$leader,'IN')->get("db_user_group");
    $loop = array();
    foreach ($member as $value) {
        $loop = array_merge($loop, json_decode($value['detail'], true));
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

    /* todo api */
    //print_r(array_unique($loop));
    foreach (mgr($userid) as $value) {

        $sales = $db_nms->where('id',$value)->where('verify',1)->getOne("db_member");
        if($sales){

            $count_all = $db->where('agen_parent',$value)->getValue("a77_agent","count(*)");
            $count_upload = $db->where('agen_parent',$value)->where('agen_status',0)->getValue("a77_agent","count(*)");
            $count_wait = $db->where('agen_parent',$value)->where('agen_status',1)->getValue("a77_agent","count(*)");
            $count_active = $db->where('agen_parent',$value)->where('agen_status',2)->getValue("a77_agent","count(*)");
            $count_reject = $db->where('agen_parent',$value)->where('agen_status',10)->getValue("a77_agent","count(*)");

            $amout += $count_all;
            $all_upload += $count_upload;
            $all_wait += $count_wait;
            $all_active += $count_active;
            $all_reject += $count_reject;

            $chk_p = $db->where('agen_parent',$value)->where('agen_status',2)->get("a77_agent");
            foreach ($chk_p as $p) {
                $pv[] = $p['agen_province'];
            }
            $pv = array_unique($pv);

            $api['sales'][] = array('id' => $sales['id'],'name' => $sales['first_name'].' '.$sales['last_name'],'count_all' => $count_all,'count_upload' => $count_upload,'count_wait' => $count_wait,'count_active' => $count_active,'count_reject' => $count_reject, 'province' => count($pv));
            $pv = array();
        }
        
/*
        $db->join("a77_agent a", "a.agen_province=p.code", "RIGHT");
        $db->where("a.agen_parent",$value);
        $member_raw = $db->get("a77_provinces p", null, "a.agen_first_name, a.agen_last_name, a.agen_people_id, p.name_in_thai, a.agen_status, a.agen_datetime,a.agen_id,a.agen_gender, a.agen_parent");

        foreach ($member_raw as $member) {
            
            $thai_id = 'xxxxxxxx'.substr($member['agen_people_id'],8);
      
            $api['data'][] = array($member['agen_id'],
                $member['agen_first_name'].' '.$member['agen_last_name'],
                $sales['first_name'],
                $thai_id,
                $member['name_in_thai'],
                $member['agen_status'],
                DateThai($member['agen_datetime']
            ));
            
        }
*/
    }
    $api['counter'] = array('all' => $amout,'upload' => $all_upload,'pending' => $all_wait,'active' => $all_active,'reject' => $all_reject);
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