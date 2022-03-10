<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang Quản Trị</title>

    <!-- Bootstrap Core CSS -->
    <link href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/backend/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/backend/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/backend/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style>
        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
html {
  color: #333;
  font-size: 62.5%;
  font-family: "Open Sans", sans-serif;
}
.main {
  background: #f1f1f1;
  min-height: 100vh;
  display: flex;
  justify-content: center;
}
.form {
  width: 360px;
  min-height: 100px;
  padding: 32px 24px;
  text-align: center;
  background: #fff;
  border-radius: 2px;
  margin: 24px;
  align-self: center;
  box-shadow: 0 2px 5px 0 rgba(51, 62, 73, 0.1);
}
.form .heading {
  font-size: 2rem;
}
.form .desc {
  text-align: center;
  text-transform: uppercase;
  font-size: 2.6rem;
  font-weight: lighter;
  line-height: 2.4rem;
  margin-top: 16px;
  font-weight: 700;
}

.form-group {
  display: flex;
  margin-bottom: 16px;
  flex-direction: column;
}

.form-label,
.form-message {
  text-align: left;
}

.form-label {
  font-weight: 700;
  padding-bottom: 6px;
  line-height: 1.8rem;
  font-size: 1.4rem;
}

.form-control {
  height: 40px;
  padding: 8px 12px;
  border: 1px solid #b3b3b3;
  border-radius: 3px;
  outline: none;
  font-size: 1.4rem;
}

.form-control:hover {
  border-color: #1dbfaf;
}

.form-group.invalid .form-control {
  border-color: #f33a58;
}

.form-group.invalid .form-message {
  color: #f33a58;
}

.form-message {
  font-size: 1.2rem;
  font-weight: bold;
  line-height: 1.6rem;
  padding: 4px 0 0;
  color: red;
}

.form-submit {
  outline: none;
  background-color: orange;
  margin-top: 12px;
  padding: 12px 16px;
  font-weight: 600;
  color: #fff;
  border: none;
  width: 100%;
  font-size: 14px;
  border-radius: 8px;
  cursor: pointer;
}

.form-submit:hover {
  opacity: .8;
}

.spacer {
  margin-top: 36px;
}

    </style>

</head>

<body>

    <!-- <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form  action="{!! route('admin.login.getLogin') !!}" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" name="email" value="{!! old('username') !!}" placeholder="Username" />
                                    <div>
                                        {!! $errors->first('username') !!}
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" />
                                    <div>
                                        {!! $errors->first('password') !!}
                                    </div> 
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 -->
    <div class="main center">
        <form action="{!! route('admin.login.getLogin') !!}" method="POST" class="form" id="form-1">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <p class="desc">Đăng nhập</p>
    
            <div class="spacer"></div>
    
            <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
            <span class="form-message">
                {!! $errors->first('email') !!}
            </span>
            </div>
    
            <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <span class="form-message">
                {!! $errors->first('password') !!}
            </span>
            </div>
    
    
            <button class="form-submit" type="submit">Đăng nhập</button>
        </form>
    </div>

</div>

    <!-- jQuery -->
    <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/backend/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/backend/dist/js/sb-admin-2.js"></script>

</body>

</html>
