<?php
    require_once '../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $agent = $db->where('agen_status', '10')->get('a77_agent',1);
?>
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" type="text/css" />
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ชื่อลูกค้า</th>
                <th>ผู้ดูแล</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agent as $value) { ?>
                <tr>
                    <td><?php echo $value['agen_first_name'].' '.$value['agen_last_name']; ?></td>
                    <?php $parent = $db_nms->where('id', $value['agen_parent'])->getOne('db_member'); ?>
                    <td><?php echo $parent['first_name'];?></td>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>