@extends('backend.layouts.main')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="d-flex">
                <h1 class="m-0">Danh sách người dùng</h1>
                <button class="btn bg-success ml-2">Thêm mới</button>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="panel panel-default">
<!-- /.panel-heading -->
    <div class="panel-body">
        <div class="dataTable_wrapper">

        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr class="odd gradeX" align="center">
                    <th class="">STT</th>
                    <th class="">Ảnh</th>
                    <th class="">Email</th>
                    <th class="">Họ và tên</th>
                    <th class="">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="odd gradeX" align="center">
                        <td>{!! $item->id !!}</td>
                        <td>{!! $item->avatar !!}</td>
                        <td>{!! $item->email !!}</td>
                        <td>{!! $item->name !!}</td>
                        <td>
                            <a href="" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Chỉnh sửa"><i class="fa fa-edit fa-fw"></i></a>
                            <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')" href="" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Xóa"><i class="fa fa-trash  fa-fw"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.row -->
</div>
</div>
    <!-- /.content -->

@endsection