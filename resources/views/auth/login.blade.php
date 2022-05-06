@extends('frontend.master')

@section('content')
<section id="aa-catg-head-banner">
   <img src="{!! url('images/slide/banner_rom.jpg') !!}" alt="fashion img" style="width: 1920px; height: 300px;" >
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <ol class="breadcrumb">
          <li><a href="{!! url('/') !!}">Home</a></li>         
          <li class="active">Đăng nhập</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
<div class="container" style="padding-top:200px">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">Đăng nhập</h2>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                         <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail<span>*</span></label>

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
                                    Đăng nhập
                                </button>

                                <a class="btn btn-success" href="{{ url('/register') }}" type="button">Đăng ký</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
