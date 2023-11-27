<?php
      session_start();
      require_once '../../db-conn.php';

      $id = $_GET['id'];

      if(empty($id)){
        $api['docs'] = array('status'=>'404','msg'=>'ไม่พบข้อมูล');
      } else {
        $veri = $db->where('aimg_parent',$id)->where('aimg_group',2)->where('aimg_status',1)->getOne('a77_agent_img');
        $agent_status = $db->where('agen_id',$veri['aimg_parent'])->getOne('a77_agent','agen_status');

        if($veri['aimg_group'] !== '2'){
          $api['docs'] = array('status'=>'404','msg'=>'ไม่พบข้อมูล');
        } else {
          $api['docs'] = array('id' => $veri['aimg_img_id'],'img_path' => $veri['aimg_link'],'datetime' => $veri['aimg_datetime'],'status' => '1','agent_status' => $agent_status['agen_status']);
        }

      }
      

      echo json_encode($api);