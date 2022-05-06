@extends('frontend.master')

@section('content')
 <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="{!! url('images/slide/banner_rom.jpg') !!}" alt="fashion img" style="width: 1920px; height: 300px;" >
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <ol class="breadcrumb">
          <li><a href="{!! url('/') !!}">Home</a></li>         
          <li class="active">Đăng ký tài khoản</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  </section>
  <!-- / product category -->
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
   <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">Đăng ký</h2>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />

                        <div class="form-group{{ $errors->has('txtname') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Tên khách hàng<span>*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="txtname" value="{{ old('txtname') }}">

                                @if ($errors->has('txtname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('txtname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('txtphone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Số điện thoại<span>*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="txtphone" value="{{ old('txtphone') }}">
                                @if ($errors->has('txtphone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('txtphone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('txtaddress') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Địa chỉ<span>*</span></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="txtaddress" value="{{ old('address') }}">

                                @if ($errors->has('txtaddress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('txtaddress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label"><span>Email*</span></label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password<span>*</span></label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Đăng ký
                                </button>
                                <a class="btn btn-success" href="{{ url('/login') }}" type="button">Đăng nhập</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
