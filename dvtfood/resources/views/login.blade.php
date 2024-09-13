@include('layouts.header')

<body class="hold-transition dark-mode login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>DVT</b>FOOD</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Đăng nhập để tiếp tục sử dụng</p>

                <form id="login-form" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Số điện thoại" id="phone" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">
                    <a href="forgot-password.html">Quên mật khẩu?</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Chưa có tài khoản?</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    @include('layouts.script')
    <script>
        $(document).ready(function() {
            $("#login-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{ route('login') }}",
                    data: {
                        phone: $("#phone").val(),
                        password: $("#password").val()
                    },
                    dataType: "json",
                    success: function(response, textStatus, jqXHR) {

                        setCookie("user_token", response.token, 30);
                        window.location.href = "{{ route("home") }}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                        const obj = JSON.parse(jqXHR.responseText);

                        Swal.fire({
                            title: 'Error',
                            text: obj.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });


                        // console.log('jqXHR:', jqXHR.responseText);
                    }
                });
            })
        });
    </script>
    @include('layouts.end')
