<?php 
    /* permission */
    session_start();
    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } elseif($_SESSION['a77permission'] != 'leader') {
        header("Location: /404");
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>A77 Map</title>
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
            .swal-text {
                text-align: center;
            }
            .swal-footer {
                text-align: center;
            }
            .radio-control{
                float: left;
                margin-right: 10px;
            }
            .swal-button, .swal-button:not([disabled]):hover {
                background-color: #7266bb;
            }
            .card-map {
                padding: 0.5rem 0.25rem 0.25rem 0.25rem;
            }
            .card-topic {
                padding: 0.5rem 0 0 1rem;
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
                                    <h4 class="mb-0 font-size-18">แผนที่</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">A77</a></li>
                                            <li class="breadcrumb-item active">แผนที่</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body card-map">
                                        <h4 class="mb-2 font-size-18 card-topic">แผนที่แสดงจำนวน</h4>
                                        <div id="map-container"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12" id="map">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">จำนวนสมาชิก จังหวัด</h4>
                                        <p class="card-subtitle mb-4">
                                            แสดงจำนวนสมาชิกทั้งหมดในแต่ละจังหวัดที่ผ่านการอนุมัติแล้ว
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="50%">จังหวัด</th>
                                                        <th>จำนวน</th>
                                                    </tr>
                                                    <tr v-for="item in agent_data">
                                                        <td>{{ item.name }}</td>
                                                        <td>{{ item.value }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>รวม</td>
                                                        <td>{{ agent_total }}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
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
        <script type="text/javascript">

            var navigation = new Vue({
                el: '#nav',
                data () {
                    return {
                        sales_name: 'sales_name',
                        sales_photo: 'sales_photo'
                    }
                },
                mounted () {
                    axios
                    .get('/sales/system/nav.api.php')
                    .then(response => (this.sales_name = response.data.sales.name,
                                        this.sales_photo = response.data.sales.photo
                        ))
                }
            });

            var map_data = new Vue({
                el: '#map',
                data() {
                    return {
                        agent_data: [],
                        agent_total: '0'
                    }
                },
                mounted() {
                    axios
                        .get('/mgr/system/map.api.php')
                        .then(response => {
                            this.agent_data = response.data.province;
                            this.agent_total = response.data.counter.total;

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

                // Initiate the chart
                
            
        </script>

        <!-- App js -->
        <script src="/assets/js/theme.js"></script>

    </body>

</html>

