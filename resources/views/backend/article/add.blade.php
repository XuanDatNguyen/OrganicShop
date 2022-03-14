@extends('backend.master')

@section('content')
    <form action="{!! route('admin.article.getAdd') !!}" method="POST"  enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="row">
        <div class="col-lg-12 ">
        <div class="panel panel-green">
            <div class="panel-heading" style="height:60px;">
              <h3 >
                Đăng bài
              </h3>
            <div class="navbar-right" style="margin-right:10px;margin-top:-50px;">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{!! URL::route('admin.article.index') !!}" ><i class="btn btn-default" >Hủy</i></a>
            </div>
            </div>
            <div class="panel-body">
        <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Thêm bài viết</h3>
            </div>
            <div class="panel-body">
                
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tiêu đề</label>
                <input class="form-control" name="txtMNTittle" value="{!! old('txtMNTittle') !!}" placeholder="Tiêu đề..." />
                <div>
                    {!! $errors->first('txtMNTittle') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Tóm tắt</label>
                <textarea class="form-control" rows="2" name="txtMNResum" placeholder="Mô tả...">{!! old('txtMNResum') !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtMNResum'); </script>
                <div>
                    {!! $errors->first('txtMNResum') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Nội dung</label>
                <textarea class="form-control" rows="2" name="txtMNContent" placeholder="Mô tả...">{!! old('txtMNContent') !!}</textarea>
                <script type="text/javascript">CKEDITOR.replace('txtMNContent'); </script>
                <div>
                    {!! $errors->first('txtMNContent') !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Thêm ảnh</label>
                <input type="file" name="fImage" value="{!! old('fImage') !!}">
                <div>
                    {!! $errors->first('fImage') !!}
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Nguyên liệu có sãn tại cửa hàng</h3>
                </div>
            <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                <thead>
                    <tr>
                        <th></th>
                        <th>Sản phẩm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
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