<?php 
    /* permission */
    session_start();
    if(!isset($_SESSION['a77usrid'])){
        header("Location: /404");
    } else {
        if($_SESSION['a77permission'] != 'user'){
            header("Location: /404");
        }
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
            .edit-warning {
                border: 1pt solid #FF0000;
                color: #FF0000;
                padding: 10px;
                border-style: dashed;
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
                      <div id="agent">

                        <div class="row">
                            <div class="col-12" >
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">คุณ {{ f_name }} {{ l_name }}</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">A77</a></li>
                                            <li class="breadcrumb-item active">สมาชิก</li>
                                        </ol>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">ข้อมูลสมาชิก</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>ชื่อ</td>
                                                        <td><input type="text" id="simpleinput" class="form-control" v-model="f_name" :value="f_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>นามสกุล</td>
                                                        <td><input type="text" id="simpleinput" class="form-control" v-model="l_name" :value="l_name"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เพศ</td>
                                                        <td>
                                                            <select v-model="gender" class="form-control">
                                                                <option value="male">ชาย</option>
                                                                <option value="female">หญิง</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>เลขบัตร ปชช.</td>
                                                        <td><input v-on:keypress="NumbersOnly" v-model="thai_id" maxlength="13" type="text" id="simpleinput" class="form-control" :value="thai_id"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เบอร์โทรศัพท์</td>
                                                        <td><input v-on:keypress="NumbersOnly" v-model="tel" maxlength="10" type="text" id="simpleinput" class="form-control" value=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td>จังหวัด</td>
                                                        <td>
                                                            <select v-model="province" class="form-control">
                                                                <option v-for="item in items" :value="item.id">{{ item.name }}</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-1">
                                                <button type="submit" @click="sendData" class="btn btn-success waves-effect waves-light">บันทึก</button>
                                            </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


        <script>

                var navigation = new Vue({
                    el: '#nav',
                    data () {
                        return {
                            sales_name: 'sales_name',
                            sales_photo: 'sales_photo'
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/nav.api.php')
                          .then(response => (
                            
                              this.sales_name = response.data.sales.name,
                              this.sales_photo = response.data.sales.photo
                        ))
                    }
                });

                var agent_detail = new Vue({
                    el: '#agent',
                    data () {
                        return {
                            f_name: '',
                            l_name: '',
                            gender: '',
                            province: '',
                            thai_id: '',
                            tel: '',
                            status: '',
                            datetime: '',
                            items: [],
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/agent-edit.api.php?u=<?php echo $m_id; ?>')
                            .then(response => {
                                console.log(response.data);
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/home";
                                    });

                                this.f_name = response.data.agent.f_name;
                                this.l_name = response.data.agent.l_name;
                                this.gender = response.data.agent.gender;
                                this.province = response.data.agent.province_id;
                                this.thai_id = response.data.agent.thai_id;
                                this.status = response.data.agent.status;
                                this.datetime = response.data.agent.datetime;
                                this.items = response.data.provinces;
                                this.tel = response.data.agent.phone
                            })
                    },
                    methods: {
                        sendData(e) {
                            e.preventDefault();
                            swal({
                                title: "กำลังสร้างสมาชิกใหม่",
                                text: "โปรดรอสักครู่ ระบบกำลังกำลังสร้างสมาชิกใหม่ของคุณ",
                                icon: "info",
                                buttons: false,
                                closeOnClickOutside: false,
                                closeOnEsc: false
                            });
                            axios.post('/sales/system/agent.edt.php?u=<?php echo $m_id;?>', {
                                firstName: this.f_name,
                                lastName: this.l_name,
                                gender: this.gender,
                                peopleId: this.thai_id,
                                province: this.province,
                                tel: this.tel
                            }).then(res => {
                                //console.log(res);
                                if(res.data.status == 200) 
                                    swal("สำเร็จ", "เพิ่มสมาชิกเรียบร้อย", "success",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/profile/<?php echo $m_id; ?>";
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