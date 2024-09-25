@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Trang giỏ hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Giỏ hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @foreach ($shoppingcarts as $cart)
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-globe"></i> Mã đơn hàng : <span
                                                @if ($cart->status == 0) class="badge badge-warning"
                                            @else
                                                class="badge badge-success" @endif>{{ $cart->token }}</span>
                                            <small class="float-right">Tạo vào lúc: {{ $cart->created_at }}</small>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Đặt lúc</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá / 1 sản phẩm</th>
                                                    <th>Ảnh minh họa</th>
                                                    @if ($cart->status == 0)
                                                        <th>Hoạt động</th>
                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $price_final = 0; @endphp
                                                @foreach ($products[$cart->token] as $product)
                                                    @php
                                                        $stt = 1;
                                                        $price_final +=
                                                            (float) $product['linker']->price *
                                                            (int) $product['product']->product_count;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $stt }}</td>
                                                        <td>{{ $product['linker']->name }}</td>
                                                        <td>{{ $product['product']->created_at }}</td>
                                                        <td><input type="number" style="min-width: 70px"
                                                                class="form-control edit-product-count" min="1"
                                                                max="100" data-id="{{ $product['product']->id }}"
                                                                data-cart="{{ $cart->token }}"
                                                                value="{{ $product['product']->product_count }}"
                                                                @if ($cart->status == 1) readonly @endif></td>
                                                        <td>{{ $product['linker']->price }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <img width="80"
                                                                        src="{{ URL($product['linker']->img) }}"
                                                                        class="img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if ($cart->status == 0)
                                                            <td>

                                                                <button class="btn btn-danger btn-remove"
                                                                    data-id="{{ $product['product']->id }}"
                                                                    data-cart="{{ $cart->token }}">Xóa</button>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-12 col-lg-6">
                                        <p class="lead">Phương thúc thanh toán</p>
                                        <img src="../../dist/img/credit/visa.png" alt="Visa">


                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            @if ($cart->status == 2)
                                                <span class="badge badge-success">Bạn đã thanh toán đơn hàng này rồi</span>
                                            @else
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="badge badge-success">Vui lòng quét mã qr bên dưới để
                                                            thanh
                                                            toán
                                                            đơn hàng</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <img src="https://dvtmod.top/qr/?logo=1&amount={{ $price_final }}&comment=Thanhtoan_{{ $cart->token }}&v={{ rand(1111, 99999) }}"
                                                            alt="">
                                                    </div>

                                                </div>
                                            @endif

                                        </p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 col-lg-6">
                                        <p class="lead">Thanh toán đơn hàng : <span
                                                class="text-warning">{{ $cart->token }}</span> ngày
                                            {{ $cart->create_at }}
                                        </p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Tổng cộng:</th>
                                                    <td class="price-final-{{ $cart->id }}">{{ $price_final }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Giảm giá (0%)</th>
                                                    <td class="price-final-{{ $cart->id }}">{{ $price_final }}</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <a href="invoice-print.html" rel="noopener" target="_blank"
                                            class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                        @if ($cart->status == 0)
                                            <button type="button" class="btn btn-success float-right confirm-btn"
                                                data-cart="{{ $cart->token }}"><i class="far fa-credit-card"></i> Hoàn
                                                thành đơn
                                            </button>
                                        @elseif($cart->status == 1)
                                            <button type="button" class="btn btn-success float-right pay-btn"
                                                data-cart="{{ $cart->token }}"><i class="far fa-credit-card"></i> Kiểm tra
                                                thanh toán
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-warning float-right remove-cart"
                                                data-cart="{{ $cart->token }}"><i class="fas fa-trash"></i> Xóa đơn hàng
                                            </button>
                                        @endif


                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Main content -->

                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@section('script')
    <script>
        $(document).ready(function() {

            $(".remove-cart").click(function(e) {
                e.preventDefault();

                const carttoken = $(this).data("cart");

                $.ajax({
                    type: "GET",
                    url: "{{ route('removecart') }}",
                    data: {
                        user_token: getCookie("user_token"),
                        
                        cart_token: carttoken
                    },
                    dataType: "json",
                    success: function(response) {

                        window.location.reload();

                    },

                    error: function(jqXHR, textStatus, errorThrown) {

                        const obj = JSON.parse(jqXHR.responseText);

                        Toast.fire({
                            icon: 'warning',
                            html: '<span class="text-warning">' + obj.message +
                                '</span>'
                        })
                    }
                });
            });

            $(".btn-remove").click(function(e) {
                e.preventDefault();

                const id = $(this).data("id");
                const carttoken = $(this).data("cart");

                $.ajax({
                    type: "GET",
                    url: "{{ route('removeproduct') }}",
                    data: {
                        user_token: getCookie("user_token"),
                        product_id: id,
                        cart_token: carttoken
                    },
                    // dataType: "json",
                    success: function(response) {

                        console.log(response);

                        window.location.reload();

                    },

                    error: function(jqXHR, textStatus, errorThrown) {

                        const obj = JSON.parse(jqXHR.responseText);

                        Toast.fire({
                            icon: 'warning',
                            html: '<span class="text-warning">' + obj.message +
                                '</span>'
                        })
                    }
                });

            });

            $(".pay-btn").click(function(e) {


                const cart = $(this).data("cart");
                $.ajax({
                    type: "GET",
                    url: "{{ route('checkpaycart') }}",
                    data: {
                        user_token: getCookie("user_token"),

                        cart_token: cart

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {

                            window.location.reload();

                        } else {

                            Swal.fire({
                                icon: "warning",
                                title: "Thông báo",
                                text: "Đơn hàng đang được thanh toán"
                            });
                        }

                    },

                    error: function(jqXHR, textStatus, errorThrown) {

                        const obj = JSON.parse(jqXHR.responseText);

                        Toast.fire({
                            icon: 'warning',
                            html: '<span class="text-warning">' + obj
                                .message +
                                '</span>'
                        })
                    }
                });

            });

            $(".confirm-btn").click(function(e) {
                e.preventDefault();
                const cart = $(this).data("cart");

                Swal.fire({
                    title: 'Bạn có chắc chắn xác nhận đơn này không?',
                    text: "Đơn hàng sẽ được gửi đến nhà hàng và bạn sẽ không thể thay đổi đơn này",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có'
                }).then((result) => {
                    if (result.isConfirmed) {


                        $.ajax({
                            type: "GET",
                            url: "{{ route('confirmcart') }}",
                            data: {
                                user_token: getCookie("user_token"),

                                cart_token: cart

                            },
                            dataType: "json",
                            success: function(response) {
                                window.location.reload();
                            },

                            error: function(jqXHR, textStatus, errorThrown) {

                                const obj = JSON.parse(jqXHR.responseText);

                                Toast.fire({
                                    icon: 'warning',
                                    html: '<span class="text-warning">' + obj
                                        .message +
                                        '</span>'
                                })
                            }
                        });
                    }
                })
            })
            $(".edit-product-count").change(function(e) {
                e.preventDefault();

                if ($(this).val() <= 0) {
                    $(this).val(1);
                }

                if ($(this).val() > 100) {
                    $(this).val(100);
                }

                const id = $(this).data("id");
                const cart = $(this).data("cart");
                $.ajax({
                    type: "GET",
                    url: "{{ route('updateproduct') }}",
                    data: {
                        user_token: getCookie("user_token"),
                        product_id: id,
                        new_count: $(this).val(),
                        cart_token: cart

                    },
                    dataType: "json",
                    success: function(response) {


                        $(".price-final-" + cart).text(response.price_final);


                    },

                    error: function(jqXHR, textStatus, errorThrown) {

                        const obj = JSON.parse(jqXHR.responseText);

                        Toast.fire({
                            icon: 'warning',
                            html: '<span class="text-warning">' + obj.message +
                                '</span>'
                        })
                    }
                });

            });
        });
    </script>
@endsection
@endsection()
