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

            <div class="page-content" id="chk">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">ตรวจสอบคุณสมบัติสมาชิก</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Alpha 77</a></li>
                                        <li class="breadcrumb-item active">การขอเบิก</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>    

                    <div class="row">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="mb-2 font-size-18">ตรวจสอบผู้แนะนำ</h4>
                                    <p class="card-subtitle mb-2">กรอกหมายเลขบัตรประชาชนเพื่อตรวจสอบรายละเอียดผู้แนะนำ</p>
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <input type="text" v-model="search_pid" v-on:keypress="NumbersOnly" class="form-control" maxlength="13" placeholder="หมายเลขบัตรประชาชน">
                                        </div>
                                        <button class="btn btn-primary waves-effect waves-light" @click="chkAgrnt">ค้นหา</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

<div id="detail" style="display: none;">

                    <div class="row">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">ข้อมูลเอเจน</h4>

                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" width="130px">ชื่อ - สกุล</th>
                                                    <td>{{ agent.name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">เพศ</th>
                                                    <td>{{ agent.gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">เลขบัตร ปชช.</th>
                                                    <td>{{ agent.people_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">เบอร์โทรศัพท์</th>
                                                    <td>{{ agent.tel }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">จังหวัด</th>
                                                    <td>{{ agent.province }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">สถานะลูกค้าเก่า</th>
                                                    <td>
                                                        <span v-if="agent.check_qm == '1'"><span class="badge badge-danger badge-pill">ลูกค้าเก่า</span></span>
                                                        <span v-if="agent.check_qm == '0'"><span class="badge badge-success badge-pill">ไม่ใช่ลูกค้าเก่า</span></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">ข้อมูลเซลล์</h4>

                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" width="185px">ชื่อ - สกุล</th>
                                                    <td>{{ sales.name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">ทีม</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">จำนวนเอเจน (อนุมัติแล้ว)</th>
                                                    <td>{{ sales.all_agent }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">จำนวนจังหวัด (อนุมัติแล้ว)</th>
                                                    <td>{{ sales.pv }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">เอกสารเอเจน</h4>
                                    <div  v-for="doce in img" class="col-6">
                                        <a :href="doce.link" target="_blank">
                                            <img :src="doce.link" style="height: 150px;width: 150px;object-fit: cover;">
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-2 font-size-18">ค้นข้อมูลผู้แนะนำ Quick (ค่าใกล้เคียง)</h4>

                                    <div v-if="invite.status !== '404'">
                                        <table v-for="inv in invite" class="table table-bordered mb-3">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">{{ inv.agent_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ inv.cust_name }}</td>
                                                    <td>{{ inv.saleperson }} - {{ inv.saleteam }}</td>
                                                    <td>{{ inv.buydate }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div v-if="invite.status == '404'" style="text-align: center; margin: 15px 0;">
                                        ไม่มีข้อมูล
                                    </div>


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
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        var chk_agent = new Vue({
            el: '#chk',
            data () {
                return {
                    agent: [],
                    sales: [],
                    invite: [],
                    img: [],
                    search_pid: '3670400496924',
                }
            },
            methods: {
                chkAgrnt(){
                    swal({
                        title: "กำลังค้นหาข้อมูล",
                        text: "โปรดรอสักครู่ ระบบกำลังค้นหาข้อมูลสำหรับคุณ",
                        icon: "info",
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    });
                    document.getElementById("detail").style.display = "none";
                    axios.post('/admin/system/chk_agent.api.php', {
                        people_id: this.search_pid
                    }).then(function (res) {
                        //console.log(res.data);
                        swal.close();
                        if(res.data.status == 200){
                            document.getElementById("detail").style.display = "block";
                            chk_agent.agent = res.data.agent;
                            chk_agent.sales = res.data.sales;
                            chk_agent.invite = res.data.invite;
                            chk_agent.img = res.data.img;
                        } else {
                            swal("ไม่พบข้อมูล", res.data.data, "error");
                        }
                    })
                },
                NumbersOnly(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                }
            }
        });

    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>