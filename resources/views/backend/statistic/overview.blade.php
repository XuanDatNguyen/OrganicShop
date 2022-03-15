@extends('backend.master')
@section('title')
    <h3 class="page-header">Kho hàng</h3>
@stop
@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-arrow-circle-o-down fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->nhap !!}</div>
                        <div>Sản phẩm nhập vào</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.statistic.nhapvao') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-arrow-circle-o-up fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->ban !!}</div>
                        <div>Sản phẩm đã bán</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.statistic.banra') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-th-large fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->ton !!}</div>
                        <div>Sản phẩm hiện có</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.statistic.hienco') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-undo fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{!! $sl[0]->tra !!}</div>
                        <div>Sản phẩm đổi trả</div>
                    </div>
                </div>
            </div>
            <a href="{!! URL::route('admin.statistic.doitra') !!}">
                <div class="panel-footer">
                    <span class="pull-left">Xem chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->


<div class="row">

    <div class="col-lg-6">

        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Bán chạy nhất</i></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($bannhieu as $item)
                            <tr>
                            <?php $sp = DB::table('products')->where('id',$item->product_id)->first(); ?>
                            <td>{!! $item->product_id !!}</td>
                            <td>{!! $sp->name !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                            <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->product_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                            </tr>
                        @endforeach
                            
                        
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.statistic.banchay') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <!-- /.col-lg-6-->
    <div class="col-lg-6">

        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Tồn nhiều nhất</i></b>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($tonnhieu as $item)
                            <tr>
                            <?php $sp = DB::table('products')->where('id',$item->product_id)->first(); ?>
                            <td>{!! $item->product_id !!}</td>
                            <td>{!! $sp->name !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                            <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->product_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                            </tr>
                        @endforeach
                            
                        
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.statistic.tonnhieu') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <div class="col-lg-6">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Sản phẩm hết hạn sử dụng</i></b>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu slidedown">
                        <li>
                            <a href="#">
                                <i class="fa fa-refresh fa-fw"></i> Refresh
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-check-circle fa-fw"></i> Available
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-times fa-fw"></i> Busy
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-clock-o fa-fw"></i> Away
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <i class="fa fa-sign-out fa-fw"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($hethan as $item)
                            <tr>
                            <?php $sp = DB::table('products')->where('id',$item->product_id)->first(); ?>
                            <td>{!! $item->product_id !!}</td>
                            <td>{!! $sp->name !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                            <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->product_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.statistic.hethan') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
    <div class="col-lg-6">
        <!-- /.panel -->
        <!-- /.panel -->
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <!-- <i class="fa fa-comments fa-fw"></i> -->
                <b><i>Sản phẩm còn hạn sử dụng</i></b>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu slidedown">
                        <li>
                            <a href="#">
                                <i class="fa fa-refresh fa-fw"></i> Refresh
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-check-circle fa-fw"></i> Available
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-times fa-fw"></i> Busy
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-clock-o fa-fw"></i> Away
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <i class="fa fa-sign-out fa-fw"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên </th>
                            <th>Đã bán</th>
                            <th>Còn lại</th>
                            <th>Nhập hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conhan as $item)
                            <tr>
                            <?php $sp = DB::table('products')->where('id',$item->product_id)->first(); ?>
                            <td>{!! $item->product_id !!}</td>
                            <td>{!! $sp->name !!}</td>
                            <td><button type="button" class="btn btn-info btn-xs">{!! $item->ban !!}</button></td>
                            <td><button type="button" class="btn btn-warning btn-xs">{!! $item->ton !!}</button></td>
                            <td class="center">
                            <a href="{!! URL::route('admin.consignment.getNhaphang', [$item->product_id] ) !!}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="Nhập hàng"><i class="fa fa-plus"></i></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.panel-body -->
            <div class="panel-footer">
                <div class="input-group">
                    <span class="input-group-btn">
                         <a href="{!! URL::route('admin.statistic.conhan') !!}" class="btn btn-default" type="button">Xem chi tiết</a>
                    </span>
                </div>
            </div>
            <!-- /.panel-footer -->
        </div>
        <!-- /.panel .chat-panel -->
    </div>
</div>

@stop
