@extends('frontend.master')

@section('content')
 <!-- catg header banner section -->
 <section id="aa-catg-head-banner">
    <div>
      <div class="top-bn">
        <div class="overlay">
          <h2 style="color: #fff; text-align: center; font-size: 4rem; line-height: 300px ">Đăng ký</h2>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}
                <div class="col-md-6">
                <div class="aa-myaccount-login">
                    <h4>Thông tin tài khoản</h4>
                    <div class="form-group">
                                
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail</label>

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
                                <label class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Xác nhận mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Thông tin khách hàng</h4>
                    <div class="form-group{{ $errors->has('txtname') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Tên khách hàng</label>

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
                        <label class="col-md-4 control-label">Số điện thoại</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="txtphone" value="{{ old('txtphone') }}">

                            @if ($errors->has('txtphone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txtphone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-4 control-label">Địa chỉ</label>

                        <div class="col-md-6">
                            <textarea class="form-control" rows="2" name="txtAddress" placeholder="Mô tả..."></textarea>
                        </div>
                    </div>
                    
                </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="aa-browse-btn">
                            </i>Đăng ký
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
