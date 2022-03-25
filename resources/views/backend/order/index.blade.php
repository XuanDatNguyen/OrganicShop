@extends('backend.master')
@section('title')
    
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách đơn hàng</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Thời gian đặt hàng</th>
                <th>Tổng tiền</th>
                <th>Tình trạng</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="even gradeC" align="center">
                    <td>{!! $item->id !!}</td>
                    <td>
                    <?php  
                        $customer = DB::table('customers')->where('id',$item->customer_id)->first();
                        print_r($customer->name);
                    ?> 
                    </td>
                    <td>{!! date("H:m:s d-m-Y", strtotime("$item->created_at")) !!}</td>
                    <td>{!! number_format("$item->order_total",0,",",".") !!} vnđ </td>
                    <td>
                    <?php  
                        $order_status = DB::table('order_statuses')->where('id',$item->order_status_id)->first();
                        print_r($order_status->name);
                    ?>  
                    </td>
                   
                    <td class="center">
                    <a href="{!! URL::route('admin.order.getEdit1', $item->id ) !!}" 
                       type="button" class="btn btn-primary" 
                       data-toggle="tooltip" data-placement="left" 
                       title="Cập nhât Thông tin Giao hàng">
                       <i class="fa fa-truck"></i>
                    </a>
                    <a href="{!! URL::route('admin.order.getEdit2', $item->id ) !!}" 
                       type="button" class="btn btn-success" 
                       data-toggle="tooltip" data-placement="left" 
                       title="Cập nhât Thông tin Thanh toán">
                        <i class="fa fa-credit-card"></i>
                    </a>
                    <a href="{!! URL::route('admin.order.getEdit', $item->id ) !!}" 
                       type="button" class="btn btn-warning" 
                       data-toggle="tooltip" data-placement="left" 
                       title="Cập nhât Tình trạng đơn hàng">
                        <i class="fa fa-exchange"></i>
                    </a>
                </td>
            </tr>
                </tr>
            @endforeach
            
        </tbody>
        </table>
</div>
    <!-- /.row -->
</div>
</div>
@stop
