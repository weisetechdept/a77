<?php 
    /* permission */
    session_start();

    /*
    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
    */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>A77 Member List</title>
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
        .icon-status {
            font-size: 20px;
            text-align: center;
        }
        .s-docs {
            color: #f8ac5a;
        }
        .s-active {
            color: #2ac14e;
        }
        .s-wait {
            color: #23b5e2;
        }
        .s-reject {
            color: #f15050;
        }
        .table > thead tr th {
            vertical-align: middle;
        }
        .table tbody tr > .v-center, .oct {
            text-align: center;
        }
        @media only screen and (max-width: 600px) {
            .table th, .table td {
                padding: 0.75rem 0.15rem;
            }
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

            <div class="page-content" id="member">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">สมาชิก</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">A77</a></li>
                                        <li class="breadcrumb-item active">รายชื่อสมาชิก</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>    
                    
                    <div class="row mb-1">
                        <div class="col-6" style="padding-right: 5px;">
                            <div class="card bg-primary border-primary">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0 text-white">สมาชิกทั้งหมด</h5>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0 text-white">
                                                {{ all }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-6" style="padding-left: 5px;">
                            <div class="card bg-success border-success">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0 text-white">อนุมัติ</h5>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                {{ active }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-4" style="padding-right: 5px;">
                            <div class="card bg-warning border-warning">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0 text-white">อัพโหลด</h5>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                {{ upload }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-4" style="padding-right: 5px;padding-left: 5px;">
                            <div class="card bg-info border-info">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0 text-white">ตรวจสอบ</h5>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                {{ pending }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-4" style="padding-left: 5px;">
                            <div class="card bg-danger border-danger">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0 text-white">ไม่อนุมัติ</h5>
                                    </div>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center text-white mb-0">
                                                {{ reject }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ตารางรายชื่อสมาชิกทีม</h4>
                                    <table class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>เซลล์</th>
                                                <th class="oct"><i class="mdi mdi-file-document-box-check-outline icon-status s-active"></i></th>
                                                <th class="oct"><i class="mdi mdi-file-document-box-plus-outline icon-status s-docs"></i></th>
                                                <th class="oct"><i class="mdi mdi-file-document-box-search-outline icon-status s-wait"></i></th>
                                                <th class="oct"><i class="mdi mdi-file-document-box-remove-outline icon-status s-reject"></i></th>
                                                <th class="oct">รวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="memb in member">
                                                <td>{{ memb.name }}</td>
                                                <td class="v-center">{{ memb.count_active }}</td>
                                                <td class="v-center">{{ memb.count_upload }}</td>
                                                <td class="v-center">{{ memb.count_wait }}</td>
                                                <td class="v-center">{{ memb.count_reject }}</td>
                                                <td class="v-center">{{ memb.count_all }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

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
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        
        var member = new Vue({
            el: '#member',
            data () {
                return {
                    member: null,
                    all: '',
                    upload: '',
                    active: '',
                    pending: '',
                    reject: ''
                }
            },
            mounted () {
                axios.get('/mgr/system/team_agent.api.php')
                    .then(response => (
                        console.log(response.data),
                        this.member = response.data.sales,
                        this.all = response.data.counter.all,
                        this.upload = response.data.counter.upload,
                        this.active = response.data.counter.active,
                        this.pending = response.data.counter.pending,
                        this.reject = response.data.counter.reject
                ))
            }
        });

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
                    .then(response => (
                        this.sales_name = response.data.sales.name,
                        this.sales_photo = response.data.sales.photo
                ))
            }
        });
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>