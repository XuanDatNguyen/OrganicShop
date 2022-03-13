@extends('backend.master')

@section('content')
<style type="text/css" media="screen">
    .icon_del{
        position: relative;
        top: -200px;
        left: 150px;
    }
</style>
    <form action="" method="POST"  enctype="multipart/form-data" name="frmEditPro">
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
        <a href="{!! URL::route('admin.product.index') !!}" ><i class="btn btn-default" >Hủy</i></a>
    </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-7">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtSPName" placeholder="Nhập tên sản phẩm..." value="{!! $product->name !!}"  />
                <div>
                    {!! $errors->first('txtSPName') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Loại sản phẩm</label>
                <div >
                    <select name="txtSPCate" id="input" class="form-control">
                        <option value="">--Chọn loại sản phẩm--</option>
                        <?php Select_Function($cate,$product->category_id); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Đơn vị tính</label>
                <div >
                    <select name="txtSPUnit" id="input" class="form-control">
                        <option value="">--Chọn đơn vị tính--</option>
                        <?php Select_Function($unit,$product->unit_id); ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="txtSPIntro" placeholder="Mô tả...">{!! $product->description !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtSPIntro'); </script>
                <div>
                    {!! $errors->first('txtSPIntro') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Hình ảnh </label>
                <br>
                <img src="{!! asset('images/products/'.$product->image) !!}" class="img-responsive img-rounded" alt="Image" style="width: 200px; height: 200px;">
                <input type="hidden" name="fImageCurrent" value="{!! $product->image !!}">

                <br>
                <input type="file" name="fImage" >
            </div>
        </div>
       </div>
       <div class="col-lg-5">
       </div>
        </div>
    </div>
</div>   
</div>
</form>
@stop