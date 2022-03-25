@extends('backend.master')

@section('content')
<form action="" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
     <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                Cập nhật thông tin giao hàng 
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.order.index') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Thông tin khách hàng</h3>
          </div>
          <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-hover">

                  <tbody>
                      <tr>
                          <td><b>Tên khách hàng</b></td>
                          <td>{!! $customer->name !!}</td>
                      </tr>
                      <tr>
                          <td><b>Số điện thoại</b></td>
                          <td>{!! $customer->phone !!}</td>
                      </tr>
                      <tr>
                          <td><b>Email</b></td>
                          <td>{!! $customer->email !!}</td>
                      </tr>
                      <tr>
                          <td><b>Địa chỉ</b></td>
                          <td>{!! $customer->address !!}</td>
                      </tr>
                  </tbody>
              </table>
          </div>    
        </div>
        </div>
        <div class="col-lg-12">
        <br>
            <div class="form-group">
                <label for="input" >Tình trạng đơn hàng</label>
                <div>
                    <?php
                    $t = DB::table('order_statuses')->where('id', $order->order_status_id)->first();  
                    ?>
                    <input class="form-control" name="txtLHQuant" value="{!! $t->name !!}" disabled="true" />
                </div>
            </div>
        </div>
        </div>
        <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Thông tin giao hàng</h3>
          </div>
          <div class="panel-body">
              <div class="col-lg-7">
            <div class="form-group">
                <label>Người nhận hàng</label>
                <input class="form-control" name="txtName" value="{!! $order->recipient !!}" placeholder="Ký hiệu..." />
               
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Số điện thoại</label>
                <input class="form-control" name="txtPhone" value="{!! $order->recipient_phone !!}"/>
                  
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="txtEmail" value="{!! $order->recipient_email !!}"/>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Địa chỉ</label>
                <textarea class="form-control" name="txtAddress" rows="2">{!! $order->recipient_address !!}</textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Ghi chú</label>
                <textarea class="form-control" name="txtNote" rows="2" >{!! $order->order_note !!}</textarea>
            </div>
        </div>
          </div>
        </div> 
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default" >
          <div class="panel-heading">
            <h2 class="panel-title" ><b>Danh sách sản phẩm</b></h2>
          </div>
          <div class="panel-body">
            <div class="col-lg-12" >
                <div class="table-responsive">
                    <table class="table table-hovered" >
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 0; ?>
                            @foreach ($order_detail as $val)
                                <tr>
                                    <td>{!! $count = $count + 1 !!}</td>
                                    <td>
                                        <?php  
                                            $product = DB::table('products')->where('id',$val->product_id)->first();
                                            print_r($product->name);
                                        ?>
                                    </td>
                                    <td>
                                    {!! number_format($val->total_amount/$val->qty,0,",",".") !!} vnđ 
                                    </td>
                                    <td>{!! $val->qty !!}</td>
                                    <td>{!! number_format("$val->total_amount",0,",",".") !!} vnđ </td>
                                </tr>
                            @endforeach
                            <tr>
                            <td colspan="5">
                                <b>Tổng tiền : {!! number_format("$order->order_total",0,",",".") !!} vnđ </b>
                            </td>
                                
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
    </div>
  </form>
@stop