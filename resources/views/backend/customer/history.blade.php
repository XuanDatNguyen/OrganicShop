@extends('backend.master')
@section('title')
    <h3 class="page-header ">
        Lịch sử mua hàng của khách hàng: <b><i>{{$customer->name}}</i></b>
        
    </h3>
@stop
@section('content')                 
<div class="panel panel-default">
<div class="panel-heading">
    <b><i>Danh sách đơn hàng</i></b>
    <a href="{!! URL::route('admin.customer.index') !!}" class="btn btn-default">Quay lại</a>
</div>
<!-- .panel-heading -->
<div class="panel-body">
    <div class="panel-group" id="accordion">
        @foreach ($order as $item)
        <?php 
             
            switch ($item->order_status_id) {
                case '1':
                    $color = "red";
                    break;
                case '2':
                    $color = "primary";
                    break;
                case '3':
                    $color = "yellow";
                    break;
                case '4':
                    $color = "green";
                    break;
                default:
                    $color = "btn-default";
                    break;
            }
        ?>
        <div class="panel panel-{{$color}}">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <?php
                    $tt = DB::table('order_statuses')->where('id', $item->order_status_id)->first();  
                    ?>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" ><p style="color:white;"><b>Đơn hàng số {{ $item->id }} | <i>Tình trạng:</i> {{$tt->name}}</b></p></a>

                </h4>
            </div>
            <div id="collapse{{$item->id}}" class="panel-collapse collapse">
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
                    </div>
                    <div class="col-lg-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Thông tin giao hàng</h3>
                      </div>
                      <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-hover">

                              <tbody>
                                  <tr>
                                      <td><b>Người nhận hàng</b></td>
                                      <td>{!! $item->recipient !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Số điện thoại</b></td>
                                      <td>{!! $item->recipient_phone !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Email</b></td>
                                      <td>{!! $item->recipient_email !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Địa chỉ</b></td>
                                      <td>{!! $item->recipient_address !!}</td>
                                  </tr>
                                  <tr>
                                      <td><b>Ghi chú</b></td>
                                      <td>
                                      @if (!asset($item->order_note))
                                        {{ $item->order_note }}
                                      @else
                                        Không có ghi chú
                                      @endif
                                        
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      </div>
                    </div> 
                    </div>
                    </div>
                    <?php 
                        $order_detail = DB::table('order_details')->where('order_id',$item->id)->get();
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
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
                                            <b>Tổng tiền : {!! number_format("$item->order_total",0,",",".") !!} vnđ </b>
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
        </div>
        @endforeach
    </div>
</div>
<!-- .panel-body -->
</div>
<!-- /.panel -->

@stop