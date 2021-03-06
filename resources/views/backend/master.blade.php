<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>

    <!-- Bootstrap Core CSS -->
    <link href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/backend/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/backend/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/backend/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/backend/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <script src="/backend/js/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.c

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top bg-success" role="navigation" style="margin-bottom: 0; color: green;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{!! URL('admin/tong-quan')!!}"><h4 class="text-uppercase" style="font-weight: bold">Organic Shop</h4></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="{!! url('logout') !!}">
                        <i class="fa fa-user fa-fw"></i> {!! Auth::user()->name !!} <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default  sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="bg-success">
                            <a href="{!! URL('admin/tong-quan')!!}"><i class="fa fa-dashboard fa-fw"></i> Tổng quan</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-tasks"></i> Quản lý Sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! URL::route('admin.sanpham.list') !!}"> Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.loaisanpham.list') !!}"> Loại sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.nhom.list') !!}"> Nhóm thực phẩm</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.donvitinh.list') !!}">Đơn vị</a>
                                </li>
                                
                                <li>
                                    <a href="{!! URL::route('admin.nhacungcap.list') !!}">Nhà cung cấp</a>
                                </li>
                                <li>
                                    <a href="{!! URL::route('admin.lohang.list') !!}">Lô hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!-- <li>
                            <a href="{!! URL::route('admin.nhanvien.list') !!}"><i class="fa fa-users"></i>Người dùng</a>
                        </li> -->
                        <li>
                            <a href="{!! URL::route('admin.khachhang.list') !!}"><i class="fa fa-users"></i> Khách hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.donhang.list') !!}"><i class="fa fa-file-text"></i> Đơn hàng</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.binhluan.list') !!}"><i class="fa fa-comments-o"></i> Bình luận</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.baiviet.list') !!}"><i class="fa fa-list"></i> Bài viết</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.quangcao.list') !!}"><i class="fa-share-alt-square"></i> Banner</a>
                        </li>
                        <li>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.khuyenmai.list') !!}"><i class="fa fa-bars"></i> Khuyến mãi</a>
                        </li>
                        <li>
                            <a href="{!! URL::route('admin.thongke.list') !!}"><i class="fa fa-cubes"></i> Kho hàng</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('title')
                    </div>

                    <div class="col-lg-12">
                        @if (Session::has('flash_message'))
                            <div class="alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message') !!}
                            </div>
                        @endif  
                        @yield('content')
                    </div>

                    

                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/backend/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Chart js -->
    <script src="/backend/bower_components/Chart.js-1.1.1/Chart.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="/backend/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="/backend/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    
    <!-- My JavaScript -->
    <script src="/backend/js/myscript.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script

</body>

</html>
