<?php  
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    if($_GET['s'] != '1474413'){
        header ("Location: /404");
    }


    $db->join("a77_agent a", "a.agen_id=d.aimg_parent", "LEFT")->join("a77_provinces p", "p.code=a.agen_province");
    $db->where("a.agen_status", "1")->orderBy("a.agen_id","asc");
    $member = $db->get ("a77_agent_img d", null, "a.agen_id,a.agen_province,a.agen_first_name, a.agen_last_name, a.agen_people_id,d.aimg_link,p.name_in_thai"); ?>
    <?php 
        $app = $_POST['approval'];
        if(isset($app)){
            foreach ($app as $value) {
                $data = Array (
                    'agen_status' => '2',
                );
                $db->where ('agen_id', $value);
                if ($db->update ('a77_agent', $data))
                    echo $db->count . ' records were updated';
                    header("Refresh:0; url=home.php?s=1474413");
            }
        }
    ?>
    <form action="" method="post">
    <button type="submit" class="btn btn-success">อนุมัติ</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>บัตรประชาชน</th>
                <th>จังหวัด</th>
                <th>รูป</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach ($member as $value) { ?>
                <tr>
                    <td><input name="approval[]" value="<?php echo $value['agen_id']; ?>" type="checkbox"></td>
                    <td><?php echo $value['agen_id']; ?></td>
                    <td><?php echo $value['agen_first_name']; ?></td>
                    <td><?php echo $value['agen_last_name']; ?></td>
                    <td><?php echo $value['agen_people_id']; ?></td>
                    <td><?php echo $value['name_in_thai']; ?></td>
                    <td><img src="<?php echo $value['aimg_link']; ?>" width="150px"></td>
                </tr>
            <?php $i++; } ?>
        </tbody>
    </form>
    
