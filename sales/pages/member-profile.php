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
        <title>A77 Map</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="A77" name="description" />
        <meta content="A77" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="/sales/assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="/sales/assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/sales/assets/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/sales/assets/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
        <link href="/sales/assets/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

        <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@100;200;300;400;500;600;700;800&family=Kanit:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- App css -->
        <link href="/sales/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/sales/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/sales/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
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
            <header id="page-topbar">
                <div class="navbar-header" id="nav">
                    <div class="d-flex align-items-left">
                        <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <div class="dropdown d-none d-sm-inline-block"></div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown d-none d-sm-inline-block ml-2">
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown"></div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <div class="dropdown-menu dropdown-menu-right"></div>
                        </div>
                        <div class="dropdown d-inline-block">
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown"></div>
                        </div>
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img :src="sales_photo" class="rounded-circle header-profile-user" alt="Header Avatar">
                                <span class="d-none d-sm-inline-block ml-1">{{ sales_name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    <span>ออกจากระบบ</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <div class="navbar-brand-box">
                        <a href="/home" class="logo">
                            <span>
                                Alpha 77
                            </span>
                        </a>
                    </div>

            
                    <div id="sidebar-menu">
                    
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">เมนู</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="fas fa-address-book"></i><span>สมาชิก</span></a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="/home">รายชื่อสมาชิก</a></li>
                                    <li><a href="/register">เพิ่มสมาชิกใหม่</a></li>
                                    <li><a href="/map">แผนที่</a></li>
                                </ul>
                            </li>
                        </ul>

                        
                    </div>
            
                </div>
            </div>

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                      <div id="agent">
                        <div class="row">
                            <div class="col-12" >
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">คุณ {{ af_name }}</h4>

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
                                                        <td>{{ af_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>เพศ</td>
                                                        <td>{{ gender }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>เลขบัตรประชาชน</td>
                                                        <td>{{ thai_id }}</td>
                                                    <tr>
                                                        <td>จังหวัด</td>
                                                        <td>{{ province }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>สถานะ</td>
                                                        <td v-if="status == '0'"><span class="badge badge-soft-warning">อัพโหลดเอกสาร</span></td>
                                                        <td v-else-if="status == '1'"><span class="badge badge-soft-secondary">รอตรวจสอบ</span></td>
                                                        <td v-else-if="status == '2'"><span class="badge badge-soft-success">อนุมัติ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่สมัคร</td>
                                                        <td>{{ datetime }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                      </div>


                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">อัพโหลดเอกสาร</h4>
                                        <div id="form">
                                          <form @submit.prevent="sendData">
                                                <div class="form-group">
                                                    <input type="file" name="file_upload" id="file_upload" @change="onFileChange">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">อัพโหลด</button>
                                                </div>
                                          </form>
                                      </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="docs">
                            <div class="row" v-for="docs in img">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <img :src="docs.link" width="100%">
                                            <p>อัพโหลดเมื่อ : {{ docs.datetime }}</p>
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
        <script src="/sales/assets/js/jquery.min.js"></script>
        <script src="/sales/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/sales/assets/js/metismenu.min.js"></script>
        <script src="/sales/assets/js/waves.js"></script>
        <script src="/sales/assets/js/simplebar.min.js"></script>

        <!-- third party js -->
        <script src="/sales/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/sales/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
        <script src="/sales/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="/sales/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="/sales/assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="/sales/assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="/sales/assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="/sales/assets/plugins/datatables/buttons.flash.min.js"></script>
        <script src="/sales/assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="/sales/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="/sales/assets/plugins/datatables/dataTables.select.min.js"></script>
        <script src="/sales/assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="/sales/assets/plugins/datatables/vfs_fonts.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


        <script>

                var upload = new Vue({
                    el: '#form',
                    data () {
                        return {
                            file_upload: null
                        }
                    },
                    methods: {
                        onFileChange(e) {
                            this.file_upload = e.target.files[0];
                        },
                        sendData() {
                            var a = this.file_upload;
                            if ((a == null || a == "")) {
                                swal("ไม่สามารถทำรายการได้", "โปรดเลือกไฟล์เอกสารที่ต้องการทำรายการ", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );
                            } else {
                                var formData = new FormData();
                                formData.append('file_upload', this.file_upload);

                                swal({
                                    title: "กำลังอัพโหลด...",
                                    text: "โปรดรอสักครู่ ระบบกำลังอัพโหลดเอกสารของคุณ",
                                    icon: "info",
                                    buttons: false,
                                    closeOnClickOutside: false,
                                    closeOnEsc: false
                                });

                                axios.post('/sales/system/cfimg.api.php', formData, {
                                    headers: {
                                        'Content-Type': 'multipart/form-data'
                                    }
                                }).then(res => {
                                var cfimg_id =  res.data.result.id;
                                var cfimg_link =  res.data.result.variants[1];

                                if(res.data.success == true) 
                                    axios.post('/sales/system/upload_img.ins.php',{
                                        aimg_img_id: cfimg_id,
                                        aimg_link:  cfimg_link,
                                        aimg_parent: <?php echo $m_id; ?>
                                    }).then(res => {
                                        if(res.data.status == 200) 
                                            swal("สำเร็จ", "อัพโหลดเอกสารสำเร็จ", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });
                                        if(res.data.status == 400) 
                                            swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                                button: "ตกลง"
                                            }
                                        );
                                    });

                                if(res.data.success == false) 
                                    swal("ทำรายการไม่สำเร็จ", "อัพโหลดเอกสารไม่สำเร็จ อาจมีบางอย่างผิดปกติ", "warning",{ 
                                        button: "ตกลง"
                                    }
                                );

                                });
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
                            af_name: '',
                            gender: '',
                            province: '',
                            thai_id: '',
                            status: '',
                            datetime: ''
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/agent.api.php?u=<?php echo $m_id; ?>')
                          .then(response => (
                              this.af_name = response.data.agent.name,
                              this.gender = response.data.agent.gender,
                              this.province = response.data.agent.province,
                              this.thai_id = response.data.agent.thai_id,
                              this.status = response.data.agent.status,
                              this.datetime = response.data.agent.datetime
                          ))
                    }
                });

                var docs = new Vue({
                    el: '#docs',
                    data () {
                        return {
                            img: null
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/docs.api.php?u=<?php echo $m_id; ?>')
                          .then(response => (
                            console.log(response.data),
                              this.img = response.data.img
                          ))
                    }
                });
        </script>

              <!-- App js -->
              <script src="/sales/assets/js/theme.js"></script>

    </body>
</html>