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
        #overlay{
            border:1px solid black;
            width:350px;
            height:200px;
            display:inline-block;
            background-repeat:no-repeat;
        }
        
        .zoom-overlay {
            position: absolute;
            border: 1px solid black;
            width: 350px;
            height: 200px;
            background-repeat: no-repeat;
            display: none;
        }
        .zoom-image {
            object-fit: cover;
        }
        .zoom-container {
            position: relative;
            display: block;
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
                                        <li class="breadcrumb-item active">ตรวจสอบ</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>    


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th width="190px">ชื่อ-นามสกุล</th>
                                                <th width="150px">เลขบัตร ปชช.</th>
                                                <th width="150px">จังหวัด</th>
                                                <th>เอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="agn in agent">
                                                <td>{{ agn.name }}</td>
                                                <td>{{ agn.thai_id }}</td>
                                                <td>{{ agn.province }}</td>
                                                <td>
                                                    <div v-for="img in agn.docs" class="zoom-container">
                                                        <img class="zoom-image mb-3" :id="'imgZoom_' + img.id" width="300px" height="200px" :onmousemove="'zoomIn(event, ' + img.id + ')'" :onmouseout="'zoomOut(' + img.id +')'" :src="img.link">
                                                        <div class="zoom-overlay" :id="'overlay_' + img.id" v-bind:style="{ backgroundImage: 'url(' + img.link + ')' }"></div>
                                                        <p>วันที่อัพโหลด {{ img.date }}</p>
                                                    </div>
                                                </td>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="https://unpkg.com/js-image-zoom/js-image-zoom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-image-zoom/js-image-zoom.min.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script>
        var chk_agent = new Vue({
            el: '#chk',
            data () {
                return {
                    agent: [],
                    checkedAgent: [],
                    action: '0'
                }
            },
            mounted() {
                swal({
                    title: "กำลังดาวน์โหลดข้อมูล",
                    text: "โปรดรอสักครู่ ระบบกำลังดาวน์โหลดข้อมูลสำหรับคุณ",
                    icon: "info",
                    buttons: false,
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
                axios.get('/admin/system/rand_check_agent.api.php').then(response => {
                    this.agent = response.data.agent
                    swal.close();
                })
            },
            methods: {
                sendData() {
                    if(this.checkedAgent.length == 0) {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            text: "โปรดเลือกข้อมูลที่ต้องการบันทึก",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                        return false;
                    } else if(this.action == '0') {
                        swal({
                            title: "เกิดข้อผิดพลาด",
                            text: "โปรดเลือกสถานะที่ต้องการบันทึก",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false
                        });
                        return false;
                    } else {
                        axios.post('/admin/system/apv_agent.edt.php', {
                            checkedAgent: this.checkedAgent,
                            action: this.action
                        }).then(response => {
                            console.log(response.data);
                            if(response.data.status == 200) {
                                swal({
                                    title: "บันทึกข้อมูลสำเร็จ",
                                    text: "ระบบได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว",
                                    icon: "success",
                                    buttons: false,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });
                                setTimeout(function(){ location.reload(); }, 2000);
                            } else {
                                swal({
                                    title: "เกิดข้อผิดพลาด",
                                    text: "ระบบไม่สามารถบันทึกข้อมูลได้ โปรดลองใหม่อีกครั้ง",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });
                            }
                            
                        })
                    }
                    
                }
            }
            
        });

        function zoomIn(event, index) {
            var element = document.getElementById("overlay_" + index);
            element.style.display = "inline-block";
            var img = document.getElementById("imgZoom_" + index);
            var posX = event.offsetX ? (event.offsetX) : event.pageX - img.offsetLeft;
            var posY = event.offsetY ? (event.offsetY) : event.pageY - img.offsetTop;
            element.style.backgroundPosition=(-posX*2)+"px "+(-posY*4)+"px";
        }

        function zoomOut(index) {
            var element = document.getElementById("overlay_" + index);
            element.style.display = "none";
        }
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>