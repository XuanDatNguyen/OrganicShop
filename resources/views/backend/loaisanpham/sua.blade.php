@extends('backend.master')

@section('content')

    <form action="" method="POST"  enctype="multipart/form-data">
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
                <a href="{!! URL::route('admin.loaisanpham.list') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
        <div class="col-lg-7">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tên</label>
                <input class="form-control" name="txtLSPName" placeholder="Tên loại sản phẩm..." value="{!! $loaisp->loaisanpham_ten !!}" />
                <div>
                    {!! $errors->first('txtLSPName') !!}
                </div>
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="input" >Nhóm</label>
                <div>
                    <select id="input" name="txtLSPParent"  class="form-control">
                            <option value=""> Select Cate</option>
                            <?php Select_Function($nhom,$loaisp->nhom_id); ?>
                    </select>
                </div>
                <div>
                    {!! $errors->first('txtLSPParent') !!}
                </div> 
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" rows="3" name="txtLSPIntro" placeholder="Mô tả...">{!! $loaisp->loaisanpham_mo_ta !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtLSPIntro'); </script>
            </div>
        </div>
       
        </div>
        </div>
        </div>
        </div>
        </div>
    </form>

@stop