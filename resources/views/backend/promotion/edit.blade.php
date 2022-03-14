@extends('backend.master')

@section('content')
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                Cập nhật
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.promotion.index') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
        <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin khuyến mãi</h3>
            </div>
            <div class="panel-body">
            <div class="col-lg-12">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input class="form-control" name="txtKMTittle" value="{!! $promotion->title !!}" placeholder="Tiêu đề..." />
                <div>
                    {!! $errors->first('txtKMTittle') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control" rows="3" name="txtKMContent" placeholder="Mô tả...">{!! $promotion->content !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtKMContent'); </script>
                <div>
                    {!! $errors->first('txtKMContent') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
                <div class="form-group">
                    <label>Tỷ lệ giá khuyến mãi</label>
                    <input class="form-control" name="txtKMPer" value="{!! $promotion->percent !!}" placeholder="VD: 10,20,30,..." />
                    <div>
                        {!! $errors->first('txtKMPer') !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Thời gian khuyến mãi</label>
                    <input class="form-control" name="txtKMTime" value="{!! $promotion->estimate !!}" placeholder="VD:10,30,..." />
                    <div>
                        {!! $errors->first('txtKMTime') !!}
                    </div>
                </div>
            </div>
        
     </div>
     </div>
    </div>
     <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Sản phẩm khuyến mãi</h3>
                </div>
            <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th></th>
                        <th class="col-lg-12">Sản phẩm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_1 as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="products[{!! $item->id !!}]" id="{!! $item->id !!}" value="{!! $item->id !!}" checked="true">
                        </td>
                        <td>
                            {!! $item->name !!}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($product_2 as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="products[{!! $item->id !!}]" id="{!! $item->id !!}" value="{!! $item->id !!}">
                        </td>
                        <td>
                            {!! $item->name !!}
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
    </div>
    </div>
    </div>
</form>
@stop