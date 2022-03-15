@extends('backend.master')
@section('title')
@stop
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Danh sách các bình luận
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab"><b>Tất cả</b></a>
            </li>
            <li><a href="#profile" data-toggle="tab"><b>Chưa xác nhận</b></a>
            </li>
            <li><a href="#messages" data-toggle="tab"><b>Đã xác nhận</b></a>
            </li>
        </ul>
    <div class="tab-content">
        <div class="tab-pane fade in active" id="home">
        <br>
        <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Ngày</th>
                    <th>Nội dung</th>
                    <th>Hành động</th>
                 
                </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr class="odd gradeX">
                    <td>{!! $item->id !!}</td>
                    <td>
                        <?php 
                            $product = DB::table('products')->where('id',$item->product_id)->first();

                        ?>
                        {!! $product->name !!}
                    </td>
                    <td>{!! date("d-m-Y",strtotime($item->created_at)) !!}</td>
                    <td>{!! $item->content !!}</td>
                    
                    <td align="center">
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.comment.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <br>
        <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Ngày</th>
                    <th>Nội dung</th>
                    <th>Action</th>
                 
                </tr>
            </thead>
            <tbody>
            @foreach ($data2 as $item)
                <tr class="odd gradeX">
                    <td>{!! $item->id !!}</td>
                    <td>
                        <?php 
                            $product = DB::table('products')->where('id',$item->product_id)->first();

                        ?>
                        {!! $product->name !!}
                    </td>
                    <td>{!! date("d-m-Y",strtotime($item->created_at)) !!}</td>
                    <td>{!! $item->content !!}</td>
                    <td>
                    <a href="{!! URL::route('admin.comment.getEdit', $item->id ) !!}" type="button" class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Chấp nhận"><i class="fa fa-check-square-o"></i></a>
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.comment.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        </div>
        <div class="tab-pane fade" id="messages">
            <br>
        <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th class="col-lg-1">STT</th>
                    <th class="col-lg-1">Sản phẩm</th>
                    <th class="col-lg-1">Ngày</th>
                    <th  class="col-lg-1">Tên</th>
                    <th  class="col-lg-1">Email</th>
                    <th class="col-lg-3">Nội dung</th>
                    <th>Action</th>
                 
                </tr>
            </thead>
            <tbody>
            @foreach ($data1 as $item)
                <tr class="odd gradeX" align="center">
                    <td>{!! $item->id !!}</td>
                    <td>
                        <?php 
                            $product = DB::table('products')->where('id',$item->product_id)->first();

                        ?>
                        {!! $product->name !!}
                    </td>
                    <td>{!! date("d-m-Y",strtotime($item->created_at)) !!}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->email !!}</td>
                    <td>{!! $item->content !!}</td>
                    
                    <td>
                    <a href="{!! URL::route('admin.comment.getEdit1', $item->id ) !!}" type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Hủy chấp nhận"><i class="fa fa-times-circle"></i></a>
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.comment.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
    </div>
    <!-- /.panel-body -->
@stop
