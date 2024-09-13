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
                                            <i class="fas fa-globe"></i> Mã đơn hàng : {{ $cart->token }}
                                            <small class="float-right">Hôm nay: @php echo date("d-m-Y"); @endphp</small>
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
                                                    <th>Giá sản phẩm</th>
                                                    <th>Ảnh minh họa</th>
                                                    <th>Hoạt động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                @php $stt = 1; @endphp
                                                <tr>
                                                    <td>{{ $stt }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->create_at }}</td>
                                                    <td>3</td>
                                                    <td>2024</td>
                                                    <td>$64.50</td>
                                                    <td>
                                                        <button class="btn btn-warning">Sửa</button>
                                                        <button class="btn btn-danger">Xóa</button>
                                                    </td>
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
                    <div class="col-6">
                        <p class="lead">Phương thúc thanh toán</p>
                        <img src="../../dist/img/credit/visa.png" alt="Visa">


                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Dễ dàng thanh toán chỉ thông qua một lần quét mã
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">Thanh toán đơn hàng : abc ngày @php date("d-m-Y") @endphp</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Tổng cộng:</th>
                                    <td>$250.30</td>
                                </tr>
                                <tr>
                                    <th>Giảm giá (9.3%)</th>
                                    <td>$10.34</td>
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
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                class="fas fa-print"></i> Print</a>
                        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Thanh
                            toán ngay
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
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
@endsection()
