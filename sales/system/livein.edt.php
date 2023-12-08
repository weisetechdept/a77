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

    
                
      
