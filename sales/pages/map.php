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

                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mb-2 font-size-18">จำนวนสมาชิก จังหวัด</h4>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th width="50%">จังหวัด</th>
                                                        <th>จำนวน</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Alice</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
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

        <script src="https://code.highcharts.com/maps/highmaps.js"></script>
		<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
		<script src="/sales/assets/js/th-all.js"></script>
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

            $(function () {

                var data = [
                    {
                        "hc-key": "th-ct",
                        "value": 0
                    },
                    {
                        "hc-key": "th-4255",
                        "value": 1
                    },
                    {
                        "hc-key": "th-pg",
                        "value": 2
                    },
                    {
                        "hc-key": "th-st",
                        "value": 3
                    },
                    {
                        "hc-key": "th-kr",
                        "value": 4
                    },
                    {
                        "hc-key": "th-sa",
                        "value": 5
                    },
                    {
                        "hc-key": "th-tg",
                        "value": 6
                    },
                    {
                        "hc-key": "th-tt",
                        "value": 7
                    },
                    {
                        "hc-key": "th-pl",
                        "value": 8
                    },
                    {
                        "hc-key": "th-ps",
                        "value": 9
                    },
                    {
                        "hc-key": "th-kp",
                        "value": 10
                    },
                    {
                        "hc-key": "th-pc",
                        "value": 11
                    },
                    {
                        "hc-key": "th-sh",
                        "value": 12
                    },
                    {
                        "hc-key": "th-at",
                        "value": 13
                    },
                    {
                        "hc-key": "th-lb",
                        "value": 14
                    },
                    {
                        "hc-key": "th-pa",
                        "value": 15
                    },
                    {
                        "hc-key": "th-np",
                        "value": 16
                    },
                    {
                        "hc-key": "th-sb",
                        "value": 17
                    },
                    {
                        "hc-key": "th-cn",
                        "value": 18
                    },
                    {
                        "hc-key": "th-bm",
                        "value": 19
                    },
                    {
                        "hc-key": "th-pt",
                        "value": 20
                    },
                    {
                        "hc-key": "th-no",
                        "value": 21
                    },
                    {
                        "hc-key": "th-sp",
                        "value": 22
                    },
                    {
                        "hc-key": "th-ss",
                        "value": 23
                    },
                    {
                        "hc-key": "th-sm",
                        "value": 24
                    },
                    {
                        "hc-key": "th-pe",
                        "value": 25
                    },
                    {
                        "hc-key": "th-cc",
                        "value": 26
                    },
                    {
                        "hc-key": "th-nn",
                        "value": 27
                    },
                    {
                        "hc-key": "th-cb",
                        "value": 28
                    },
                    {
                        "hc-key": "th-br",
                        "value": 29
                    },
                    {
                        "hc-key": "th-kk",
                        "value": 30
                    },
                    {
                        "hc-key": "th-ph",
                        "value": 31
                    },
                    {
                        "hc-key": "th-kl",
                        "value": 32
                    },
                    {
                        "hc-key": "th-sr",
                        "value": 33
                    },
                    {
                        "hc-key": "th-nr",
                        "value": 34
                    },
                    {
                        "hc-key": "th-si",
                        "value": 35
                    },
                    {
                        "hc-key": "th-re",
                        "value": 36
                    },
                    {
                        "hc-key": "th-le",
                        "value": 37
                    },
                    {
                        "hc-key": "th-nk",
                        "value": 38
                    },
                    {
                        "hc-key": "th-ac",
                        "value": 39
                    },
                    {
                        "hc-key": "th-md",
                        "value": 40
                    },
                    {
                        "hc-key": "th-sn",
                        "value": 41
                    },
                    {
                        "hc-key": "th-nw",
                        "value": 42
                    },
                    {
                        "hc-key": "th-pi",
                        "value": 43
                    },
                    {
                        "hc-key": "th-rn",
                        "value": 44
                    },
                    {
                        "hc-key": "th-nt",
                        "value": 45
                    },
                    {
                        "hc-key": "th-sg",
                        "value": 46
                    },
                    {
                        "hc-key": "th-pr",
                        "value": 47
                    },
                    {
                        "hc-key": "th-py",
                        "value": 48
                    },
                    {
                        "hc-key": "th-so",
                        "value": 49
                    },
                    {
                        "hc-key": "th-ud",
                        "value": 50
                    },
                    {
                        "hc-key": "th-kn",
                        "value": 51
                    },
                    {
                        "hc-key": "th-tk",
                        "value": 52
                    },
                    {
                        "hc-key": "th-ut",
                        "value": 53
                    },
                    {
                        "hc-key": "th-ns",
                        "value": 54
                    },
                    {
                        "hc-key": "th-pk",
                        "value": 55
                    },
                    {
                        "hc-key": "th-ur",
                        "value": 56
                    },
                    {
                        "hc-key": "th-sk",
                        "value": 57
                    },
                    {
                        "hc-key": "th-ry",
                        "value": 58
                    },
                    {
                        "hc-key": "th-cy",
                        "value": 59
                    },
                    {
                        "hc-key": "th-su",
                        "value": 60
                    },
                    {
                        "hc-key": "th-nf",
                        "value": 61
                    },
                    {
                        "hc-key": "th-bk",
                        "value": 62
                    },
                    {
                        "hc-key": "th-mh",
                        "value": 63
                    },
                    {
                        "hc-key": "th-pu",
                        "value": 64
                    },
                    {
                        "hc-key": "th-cp",
                        "value": 65
                    },
                    {
                        "hc-key": "th-yl",
                        "value": 66
                    },
                    {
                        "hc-key": "th-cr",
                        "value": 67
                    },
                    {
                        "hc-key": "th-cm",
                        "value": 68
                    },
                    {
                        "hc-key": "th-ln",
                        "value": 69
                    },
                    {
                        "hc-key": "th-na",
                        "value": 70
                    },
                    {
                        "hc-key": "th-lg",
                        "value": 71
                    },
                    {
                        "hc-key": "th-pb",
                        "value": 72
                    },
                    {
                        "hc-key": "th-rt",
                        "value": 73
                    },
                    {
                        "hc-key": "th-ys",
                        "value": 74
                    },
                    {
                        "hc-key": "th-ms",
                        "value": 75
                    },
                    {
                        "hc-key": "th-un",
                        "value": 76
                    },
                    {
                        "hc-key": "th-nb",
                        "value": 77
                    }
                ];

                // Initiate the chart
                $('#map-container').highcharts('Map', {
                    chart: {
                        height: (16 / 9 * 100) + '%'
                    },

                    title : {
                        text : ''
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
                    series : [{
                        data : data,
                        mapData: Highcharts.maps['countries/th/th-all'],

                        joinBy: 'hc-key',
                        name: 'จำนวนประชากร',
                        states: {
                            hover: {
                                color: '#FF0000'
                            }
                        }
                    }]
                });
            });
        </script>

        <!-- App js -->
        <script src="/sales/assets/js/theme.js"></script>

    </body>

</html>

