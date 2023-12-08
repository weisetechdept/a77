<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } else {
        if($_SESSION['a77permission'] != 'user'){
            header("Location: /404");
        }
    }
    $userid = $_SESSION['a77usrid'];
    $request = json_decode(file_get_contents('php://input'));

    $id = $request->id;
    $spv = $request->spv;

    $chk = $db->where('agen_id', $id)->getOne('a77_agent');

    if($chk['agen_parent'] == $userid){
        if(empty($chk['agen_livein'])){
            $data = Array (
                'agen_livein' => $spv
            );
        
            $db->where ('agen_id', $id);
            if ($db->update ('a77_agent', $data))
                $api = Array (
                    'status' => '200',
                    'message' => 'อัพเดทข้อมูลสำเร็จ'
                );
            else
                $api = Array (
                    'status' => '400',
                    'message' => 'อัพเดทข้อมูลไม่สำเร็จ'
                );
        } else {
            $api = Array (
                'status' => '400',
                'message' => 'ไม่สามารถอัพเดทข้อมูลได้'
            );
        }
        
    } else {
        $api = Array (
            'status' => '400',
            'message' => 'ไม่สามารถอัพเดทข้อมูลได้'
        );
    }
    

    echo json_encode($api);
      
