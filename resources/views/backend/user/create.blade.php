@extends('backend.layouts.main')
@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="d-flex">
                <h1 class="m-0">Thêm mới người dùng</h1>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm mới người dùng</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <form role="form" action="{!! route('admin.user.store') !!}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Họ và tên</label>
                                    <input  type="text" class="form-control" id="name" name="txtname"
                                           placeholder="Nhập họ và tên">
                                    @if ($errors->has('name'))
                                        {{$errors->first('name')}}
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Nhập email">
                                    @if ($errors->has('email'))
                                        {{$errors->first('email')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input  type="password" class="form-control" id="password" name="password"
                                           placeholder="Nhập password">
                                    @if ($errors->has('password'))
                                        {{$errors->first('password')}}
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Chọn quyền</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="0">--Chọn quyền--</option>
                                        @foreach($roles as $role)
                                            <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_id'))
                                        {{$errors->first('role_id')}}
                                    @endif
                                </div>

                                <div class="form-group d-flex flex-column ">
                                    <label for="exampleInputFile">Thêm ảnh</label>
                                    <input type="file" id="avatar" name="avatar">
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn bg-success">Lưu</button>
                                    <button type="reset" class="btn btn-light">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection