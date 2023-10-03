<?php 
    /* permission */
    session_start();
    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>A77 Register</title>
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
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php 
                include_once('ins-pages/nav.php');
                include_once('ins-pages/sidebar.php');
        ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">เพิ่มสมาชิกใหม่</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">A77</a></li>
                                        <li class="breadcrumb-item active">เพิ่มสมาชิกใหม่</li>
                                    </ol>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row" id="form">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-body">
                                    <h4 class="card-title">ข้อมูลสมาชิกใหม่</h4>
                                    <form>
                                        <div class="form-group">
                                            <label for="simpleinput">ชื่อ (ไม่ต้องใส่คำนำหน้า)</label>
                                            <input type="text" v-model="profile.f_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="simpleinput">นามสกุล</label>
                                            <input type="text" v-model="profile.l_name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>เพศ</label>
                                            <div class="mt-2 mb-2">
                                                <div class="radio-control">
                                                    <input type="radio" v-model="profile.gender" value="male">
                                                    <label>ชาย</label>
                                                </div>
                                                <div class="radio-control">
                                                    <input type="radio" v-model="profile.gender" value="female">
                                                    <label>หญิง</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                        <div class="form-group">
                                            <label for="simpleinput">เลขบัตรประชาชน</label>
                                            <input type="text" v-model="profile.p_id" v-on:keypress="NumbersOnly" class="form-control" maxlength="13">
                                        </div>

                                        <div class="form-group">
                                            <label for="simpleinput">เบอร์โทรศัพท์</label>
                                            <input type="text" v-model="profile.tel" v-on:keypress="NumbersOnly" class="form-control" maxlength="10">
                                        </div>

                                        <div class="form-group">
                                            <label for="simpleinput">จังหวัด (ตามบัตรประชาชน)</label>
                                            <select v-model="profile.prov" class="form-control mb-3">
                                                <option value="0"> = โปรดเลือกจังหวัด =</option>
                                                <option  v-for="p in province" :value="p.code">{{ p.name }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" @click="sendData" class="btn btn-primary waves-effect waves-light">บันทึก</button>
                                        </div>
                                        
                                    </form>
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
        var form = new Vue({
            el: '#form',
            data () {
                return {
                    province: null,
                    profile: {
                        f_name: '',
                        l_name: '',
                        gender: '',
                        p_id: '',
                        tel: '',
                        prov: '0'
                    }
                }
            },
            mounted () {
                axios.get('/sales/system/register.api.php')
                    .then(response => (this.province = response.data.province
                ))
            },
            methods: {
                sendData(e) {
                    e.preventDefault();
                        var a = this.profile.f_name;
                        var b = this.profile.l_name;
                        var c = this.profile.gender;
                        var t = this.profile.tel;
                        var d = this.profile.p_id;
                        var dl = this.profile.p_id.length;
                        var e = this.profile.prov;
                        if ((a == null || a == "") || (b == null || b == "") || (c == null || c == "") || (d == null || d == "" || dl != '13') || (e == null || e == "0") || (t == null || t == "0")) {
                            swal("ไม่สามารถทำรายการได้", "โปรดตรวจสอบเงื่อนไขการสมัครสมาชิกให้ถูกต้อง และครบถ้วน", "warning",{ 
                                    button: "ตกลง"
                                }
                            );
                        } else {
                            swal({
                                title: "กำลังสร้างสมาชิกใหม่",
                                text: "โปรดรอสักครู่ ระบบกำลังกำลังสร้างสมาชิกใหม่ของคุณ",
                                icon: "info",
                                buttons: false,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                            axios.post('/sales/system/register.ins.php', {
                                firstName: this.profile.f_name,
                                lastName: this.profile.l_name,
                                gender: this.profile.gender,
                                peopleId: this.profile.p_id,
                                tel: this.profile.tel,
                                province: this.profile.prov
                            }).then(res => {
                                //console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/home";
                                    });

                                if(res.data.status == 505) 
                                    swal("ทำรายการไม่สำเร็จ", "อาจมีบางอย่างผิดปกติ โปรดตรวจสอบเงื่อนไขการสมัครสมาชิกให้ถูกต้อง และครบถ้วน หรือติดต่อเจ้าหน้าที่", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                                if(res.data.status == 400) 
                                    swal("ทำรายการไม่สำเร็จ", "สมาชิกไม่เข้าเงื่อนใขการสมัคร โปรดตรวจสอบคุณสมบัติอีกครั้ง (เป็นสมาชิก Paragon Family)", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                            });
                        }
                    
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
        
    </script>

    <!-- App js -->
    <script src="/assets/js/theme.js"></script>

</body>

</html>