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
            .swal-button--cancel {
                color: #555;
                background-color: #efefef;
            }
            .notice {
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

                            <div class="col-lg-6 col-md-12">
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
                                                        <td>ที่อยู่ปัจจุบัน</td>
                                                        <td>{{ livein }} <a :href="'/livein/'+id" type="button" class="btn btn-sm btn-light waves-effect waves-light">แก้ใข</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>เบอร์โทรศัพท์</td>
                                                        <td>{{ phone }} <a :href="'tel:'+phone" type="button" class="btn btn-sm btn-success waves-effect waves-light"> โทร</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>สถานะ</td>
                                                        <td v-if="status == '0'"><span class="badge badge-soft-warning">อัพโหลดเอกสาร</span></td>
                                                        <td v-else-if="status == '1'"><span class="badge badge-soft-secondary">รอตรวจสอบ</span></td>
                                                        <td v-else-if="status == '2'"><span class="badge badge-soft-success">อนุมัติ</span></td>
                                                        <td v-else-if="status == '10'"><span class="badge badge-soft-danger">ไม่อนุมัติ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>วันที่สมัคร</td>
                                                        <td>{{ datetime }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="form-group mt-3" v-if="status == '10'">
                                                <h4 class="mb-2 font-size-18">จัดการข้อมูล</h4>
                                                <div class="edit-warning mb-2">
                                                    โปรดตรวจสอบข้อมูลให้ถูกต้อง หรืออัพโหลดเอกสารที่ถูกต้อง ชัดเจนก่อนการขอตรวจสอบอีกครั้ง
                                                </div>
                                                <a :href="'/edit/'+id" type="submit" class="btn btn-outline-warning waves-effect waves-light mr-1">แก้ใข</a>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                        
                      </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="form">
                                            <div v-if="verify.status == '1'">
                                                <h4 class="mb-2 font-size-18">เอกสารยืนยันตัวตน</h4>
                                                <img :src="verify.img_path" style="width:100%; height:270px; object-fit: cover;">
                                                <p>อัพโหลดเมื่อ : {{ verify.datetime }}</p>
                                                <div class="mt-3" v-if="verify.agent_status !== '2'">
                                                    <button type="button" class="btn btn-success waves-effect waves-light mr-1" @click="sendStatus()" data-toggle="modal" data-target="#exampleModal">ตรวจสอบ</button> <button type="button" class="btn btn-outline-danger waves-effect waves-light mr-1" @click="sendDelete()" data-toggle="modal" data-target="#exampleModal">ลบ</button>
                                                </div>
                                            </div>
                                            <div v-else>
                                                <div v-if="verify.agent_status !== '2'">
                                                    <h4 class="mb-2 font-size-18">อัพโหลดเอกสารยืนยันเอเจน</h4>
                                                    <div class="notice mb-3">
                                                        <p>โปรดอัพโหลดเอกสารยืนยันตัวตนของเอเจนโดยอัพโหลดรุปบัตรประชาชนที่มีชื่อ นามสกุล เลขบัตร ปชช. และจังหวัดเดียวกับที่ลงทะเบียนไว้เท่านั้น</p>
                                                        <p class="mb-0"><b>หมายเหตุ :</b> ต้องเป็นรูปบัตร ปชช. เต็มรูป ด้านหน้าเท่านั้น รูปคมชัดไม่มีสิ่งบดบังตัวเลขและตัวอักษร</p>
                                                    </div>
                                                    <p><img src="/assets/images/license-card.png" style="width:100%; padding: 15px 30px;"></p>
                                                    <form @submit.prevent="verifyData">
                                                            <div class="form-group">
                                                                <input type="file" name="file_upload" id="file_upload" @change="onFileChange">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">อัพโหลด</button>
                                                            </div>
                                                    </form>
                                                </div>
                                                <div v-else>
                                                    <p class="mb-2 font-size-18">ยืนยันตัวตนเรียบร้อยแล้ว</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div id="form">
                                       
                                            <h4 class="mb-2 font-size-18">อัพโหลดเอกสารทั่วไป</h4>
                                          
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
                                <div class="col-lg-6 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <img :src="docs.link_500" width="100%">
                                            <a :href="docs.link_500" type="button" class="btn btn-sm btn-primary waves-effect waves-light mt-2" style="width: 100%; margin-top: 10px;">รูปขนาดเต็ม</a>
                                            <p class="mt-1">อัพโหลดเมื่อ : {{ docs.datetime }}</p>
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


        <script>

                var upload = new Vue({
                    el: '#form',
                    data () {
                        return {
                            file_upload: null,
                            verify: '',
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/verify.api.php?id=<?php echo $m_id; ?>')
                          .then(response => (
                            console.log(response.data.docs),
                            this.verify = response.data.docs
                        ))
                    },
                    methods: {
                        sendDelete() {
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการลบเอกสารยืนยันใช่หรือไม่ โปรดตรวจสอบข้อมูลให้ถูกต้อง",
                                icon: "warning",
                                buttons: {
                                    cancel: "ยกเลิก",
                                    confirm: {
                                        text: "ดำเนินการต่อ",
                                    }
                                },
                                dangerMode: true
                            }).then((submit) => {

                                axios.post('/sales/system/verify.del.php',{
                                    img_id: this.verify.id,
                                }).then(res => {
                                   //console.log(res.data);
                                   if(res.data.status == 200) 
                                        swal("สำเร็จ", "ทำรายการสำเร็จ", "success",{ 
                                            button: "ตกลง"
                                        }).then((value) => {
                                            location.reload(true)
                                        });
                                    if(res.data.status == 400) 
                                        swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 400)", "warning",{ 
                                            button: "ตกลง"
                                        }
                                    );
                                });
                                
                            })

                        },
                        sendStatus() {
                            swal({
                                title: 'คุณแน่ใจหรือไม่ ?',
                                text: "คุณต้องการขออนุมัติใหม่ใช่หรือไม่ โปรดตรวจสอบข้อมูลให้ถูกต้อง",
                                icon: "warning",
                                buttons: {
                                    cancel: "ยกเลิก",
                                    confirm: {
                                        text: "ดำเนินการต่อ",
                                    }
                                },
                                dangerMode: true
                            }).then((submit) => {
                                
                                if(submit) {
                                    axios.post('/sales/system/vision_chk.api.php',{
                                        img_id: this.verify.id,
                                    }).then(res => {
                                        console.log(res.data);
                                        if(res.data.status == 200) 
                                            swal("สำเร็จ", "ทำรายการสำเร็จ", "success",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });
                                        if(res.data.status == 400)
                                            swal("เกิดข้อผิดพลาดบางอย่าง", res.data.message , "warning",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });

                                        if(res.data.status == 505)
                                            swal("เกิดข้อผิดพลาดบางอย่าง", res.data.message, "warning",{ 
                                                button: "ตกลง"
                                            }).then((value) => {
                                                location.reload(true)
                                            });

                                    })
                                }
                                
                            })

                            
                        },
                        
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
                                var cfimg_link_500 =  res.data.result.variants[0];
                                var cfimg_link =  res.data.result.variants[1];

                                if(res.data.success == true) 
                                    axios.post('/sales/system/upload_img.ins.php',{
                                        aimg_img_id: cfimg_id,
                                        aimg_link:  cfimg_link,
                                        aimg_link_500: cfimg_link_500,
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

                            
                        },
                        verifyData(){

                            var a = this.file_upload;
                            if ((a == null || a == "")) {
                                swal("ไม่สามารถทำรายการได้", "โปรดเลือกไฟล์เอกสารยืนยันตัวตน", "warning",{ 
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
                                var cfimg_link_500 =  res.data.result.variants[0];
                                var cfimg_link =  res.data.result.variants[1];

                                if(res.data.success == true) 
                                    axios.post('/sales/system/cfimg_verify.api.php',{
                                        aimg_img_id: cfimg_id,
                                        aimg_link:  cfimg_link,
                                        aimg_link_500: cfimg_link_500,
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
                            id: '',
                            af_name: '',
                            gender: '',
                            province: '',
                            livein: '',
                            thai_id: '',
                            phone: '',
                            status: '',
                            datetime: ''
                        }
                    },
                    mounted () {
                        axios.get('/sales/system/agent.api.php?u=<?php echo $m_id; ?>')
                            .then(response => {
                                
                                if(response.data.status == 404) 
                                    swal("เกิดข้อผิดพลาดบางอย่าง", "อาจมีบางอย่างผิดปกติ (error : 404)", "warning",{ 
                                        button: "ตกลง"
                                    }).then((value) => {
                                        window.location.href = "/home";
                                    });
                                this.id = response.data.agent.id;
                                this.af_name = response.data.agent.name;
                                this.gender = response.data.agent.gender;
                                this.province = response.data.agent.province;
                                this.livein = response.data.agent.livein;
                                this.thai_id = response.data.agent.thai_id;
                                this.status = response.data.agent.status;
                                this.datetime = response.data.agent.datetime;
                                this.phone = response.data.agent.phone;
                                
                            })
                    },
                    methods: {
                        
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
                              this.img = response.data.img
                          ))
                    }
                });
        </script>

              <!-- App js -->
              <script src="/assets/js/theme.js"></script>

    </body>
</html>