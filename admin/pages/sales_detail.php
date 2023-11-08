<?php
    session_start();
    if($_SESSION['a77in_admin'] !== true){
        header('Location: /404');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Alpha 77 Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="A77" name="description" />
    <meta content="A77" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- App css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Chakra Petch', sans-serif;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: 'Kanit', sans-serif;
            font-weight: 400;
        }
        .page-content {
            padding: calc(70px + 24px) calc(5px / 2) 70px calc(5px / 2);
        }
        .table {
            width: 100% !important;
        }
        .dtr-details {
            width: 100%;
        }
        .card-body {
            padding: 1rem;
        }
        .card {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
                include_once('inc-pages/nav.php');
                include_once('inc-pages/sidebar.php');
        ?>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">ข้อมูลเซลล์</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Alpha 77</a></li>
                                        <li class="breadcrumb-item active">ข้อมูลเซลล์</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>    

                    <div class="row" id="sales">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mb-2 font-size-18">รายละเอียด</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="120px">รหัส</td>
                                            <td>{{ sales.id }}</td>
                                        </tr>
                                        <tr>
                                            <td width="120px">ชื่อ - สกุล</td>
                                            <td>{{ sales.name }}</td>
                                        </tr>
                                        <tr>
                                            <td>ทีม</td>
                                            <td>{{ sales.team }}</td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-5 mb-1">
                            <div class="row">
                                <div class="col-4" style="padding-right: 5px;">
                                    <a href="#">
                                        <div class="card bg-primary border-primary">
                                            <div class="card-body">
                                                <div class="mb-2">
                                                    <h5 class="card-title mb-0 text-white">สมาชิกทั้งหมด</h5>
                                                </div>
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-8">
                                                        <h2 class="d-flex align-items-center mb-0 text-white">
                                                            {{ agent.total }}
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div> <!-- end col-->

                                <div class="col-4" style="padding-left: 5px;">
                                    <a href="#">
                                    <div class="card bg-success border-success">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">อนุมัติ</h5>
                                            </div>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ agent.approve }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div> <!-- end col-->

                                <div class="col-4" style="padding-left: 5px;">
                                    <a href="#">
                                    <div class="card bg-success" style="background-color: #1c8034 !important;">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">จังหวัด (ไม่ซ้ำ)</h5>
                                            </div>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ agent.pv }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div> <!-- end col-->


                                <div class="col-4" style="padding-right: 5px;">
                                    <a href="#">
                                    <div class="card bg-warning border-warning">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">อัพโหลด</h5>
                                            </div>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ agent.docs }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div> <!-- end col-->

                                <div class="col-4" style="padding-right: 5px;padding-left: 5px;">
                                    <a href="#">
                                    <div class="card bg-info border-info">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">ตรวจสอบ</h5>
                                            </div>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ agent.pending }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div> <!-- end col-->

                                <div class="col-4" style="padding-left: 5px;">
                                    <a href="#">
                                    <div class="card bg-danger border-danger">
                                        <div class="card-body">
                                            <div class="mb-2">
                                                <h5 class="card-title mb-0 text-white">ไม่อนุมัติ</h5>
                                            </div>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-8">
                                                    <h2 class="d-flex align-items-center text-white mb-0">
                                                        {{ agent.reject }}
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div> <!-- end col-->
                            </div>
                    </div>
                    </div>

                    

                    <div id="detail">
                        <div class="row mt-3">
                            <div class="col-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ข้อมูลเอเจนทั้งหมด</h4>

                                        <table id="datatable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>รหัส</th>
                                                    <th>ชื่อ - สกุล</th>
                                                    <th>เพศ</th>
                                                    <th>โทรศัพท์</th>
                                                    <th>เลขบัตร ปชช.</th>
                                                    <th>จังหวัด</th>
                                                    <th>เซลล์</th>
                                                    <th>ทีม</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    

                    <div class="row mt-3" id="map">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">แผนที่แสดงจำนวน</h4>
                                    <p>แสดงเฉพาะเอเจนที่ได้รับการอนุมัติแล้ว</p>
                                    <div id="map-container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">รายชื่อจังหวัดแสดงจำนวน</h4>
                                    <p>แสดงเฉพาะเอเจนที่ได้รับการอนุมัติแล้ว</p>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="50%">จังหวัด</th>
                                                    <th>จำนวน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in agent_data">
                                                    <td>{{ item.name }}</td>
                                                    <td>{{ item.value }}</td>
                                                </tr>
                                                <tr>
                                                    <td>รวม</td>
                                                    <td>{{ pv_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2023 © Weise Tech.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by Weise Tech
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
      

    </div>
 

  
    <div class="menu-overlay"></div>

    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metismenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/simplebar.min.js"></script>

    <!-- third party js -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
    <script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.select.min.js"></script>
    <script src="/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="/assets/js/th-th-all.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        var sales = new Vue({
            el: '#sales',
            data () {
                return {
                    sales: [],
                    agent: [],
                }
            },
            mounted () {
                axios.get('/admin/system/sales_detail.api.php?id=<?php echo $id; ?>')
                .then(response => (
                    this.sales = response.data.sales,
                    this.agent = response.data.agent
                ))
            }
            
        });

        var map_data = new Vue({
            el: '#map',
            data() {
                return {
                    agent_data: [],
                    sname: '',
                    pv_total: 0
                }
            },
            mounted() {
                axios
                    .get('/admin/system/sales_map.api.php?id=<?php echo $id; ?>')
                    .then(response => {
                        console.log(response.data);
                        this.agent_data = response.data.province;
                        this.sname = response.data.sales.name;
                        this.pv_total = response.data.province_total;

                        $('#map-container').highcharts('Map', {
                            chart: {
                                height: (16 / 9 * 100) + '%'
                            },
                            title: {
                                text: ''
                            },
                            colorAxis: {
                                min: 0
                            },
                            exporting: {
                                enabled: false
                            },
                            credits: {
                                enabled: false
                            },
                            legend: {
                                enabled: true,
                                title: {
                                    text: 'จำนวนประชากร',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'black',
                                        fontWeight: 'normal',
                                        fontSize: '14',
                                        fontFamily: 'Chakra Petch'
                                    }
                                },
                                symbolHeight: 10,
                                symbolWidth: 200
                            },
                            series: [{
                                data: response.data.map_data,
                                mapData: Highcharts.maps['countries/th/th-all'],
                                joinBy: 'hc-key',
                                name: 'จำนวนประชากร',
                                states: {
                                    hover: {
                                        color: '#FF0000',
                                        borderColor: '#9f9f9f',
                                        borderWidth: 1
                                    }
                                }
                            }]
                        });

                    })
            }
        });

        $('#datatable').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                },
                "lengthMenu": "แสดง _MENU_ รายชื่อ",
                "zeroRecords": "ขออภัย ไม่มีข้อมูล",
                "info": "หน้า _PAGE_ ของ _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "search": "ค้นหา:",
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
            ajax: '/admin/system/sales_detail.api.php?id=<?php echo $id; ?>',
            "columns" : [
                {'data':'0'},
                {'data':'1'},
                {'data':'2'},
                {'data':'3'},
                {'data':'4'},
                {'data':'5'},
                { 
                    'data': '6',
                    sortable: false,
                    "render": function ( data, type, full, meta ) {
                        if(data == '0'){
                            return '<span class="badge badge-soft-warning">ยังไม่ขออนุมัติ</span>';
                        } else if(data == '1'){
                            return '<span class="badge badge-soft-primary">รอตรวจสอบ</span>';
                        } else if(data == '2') {
                            return '<span class="badge badge-soft-success">อนุมัติ</span>';
                        } else if(data == '10') {
                            return '<span class="badge badge-soft-danger">ไม่อนุมัติ</span>';
                        } 
                    }
                },
                {'data':'7'}
            ],
        });
    </script>


    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>