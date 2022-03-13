@extends('backend.master')
@section('title')
    <h3 class="page-header ">
        Lô hàng /
        <a href="{!! URL::route('admin.consignment.getAdd') !!}" class="btn btn-success" style="margin-top:-8px;">Thêm mới</a>
    </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách lô hàng</i></b>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
    <div class="dataTable_wrapper">

    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr class="odd gradeX" align="center">
                <th>Sản phẩm</th>
                <th>Ngày</th>
                <th>HSD</th>
                <th>SL</th>
                <th>Mua vào</th>
                <th>Bán ra</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($data as $item)
            <tr class="odd gradeX">
                    <?php 
                    // date("Y-m-d H:i", strtotime("$now -$days day"));
                        $today  = date("Y-m-d"); // Năm/Tháng/Ngày
                        
                        $begin =  date("Y-m-d", strtotime("$item->created_at")); // Năm/Tháng/Ngày
                        
                        // strtotime(date("Y-m-d", $begin,"+ "+$item->khuyenmai_thoi_gian +" days"));
                        $end = date("Y-m-d",strtotime($begin . "+ $item->estimate  day"));
                        // echo $end;
                        if ((strtotime($today) >= strtotime($begin))&& (strtotime($today) <= strtotime($end)))
                        {

                        }else{
                        DB::table('consignments')
                            ->where('id',$item->id)
                            ->update([
                                'status' => 1,
                                ]);
                        }
                        
                     ?>
               
                <td>
                    <?php $product = DB::table('products')->where('id',$item->product_id)->first(); ?>
                    @if (!empty($product->name))
                        {!! $product->name !!}
                    @else
                        {!! NULL !!}
                    @endif
                </td>
              
                <td>{!! date("d-m-Y",strtotime($begin)) !!}</td>
                <td>{!! date("d-m-Y",strtotime($end)) !!}</td>
                <td>{!! $item->qty !!}</td>
                <td>{!! number_format("$item->purchase_price",0,",",".")  !!}vnđ</td>
                <td>{!! number_format("$item->sale_price",0,",",".") !!}vnđ
                </td>
                <td class="center">
                    <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="{!! URL::route('admin.consignment.getDelete', $item->id ) !!}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash-o  fa-fw"></i></a>
                    <a href="{!! URL::route('admin.consignment.getEdit', $item->id ) !!}" type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-pencil fa-fw"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <!-- /.row -->
</div>
</div>
@stop