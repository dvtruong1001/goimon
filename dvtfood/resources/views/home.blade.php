@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">DVTFOOD</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i
                                    class="fas fa-solid fa-utensils"></i></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sản phẩm</span>
                                <span class="info-box-number">
                                    Lên tới
                                    <span class="badge badge-danger">1000 món</span>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Lượt thích</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Đã bán</span>
                                <span class="info-box-number">760</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Khách hàng</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    @php
                                        $firstTab = true;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <li class="nav-item"><a
                                                class="nav-link @php echo $firstTab ? "active" : ""; $firstTab = false; @endphp"
                                                href="#category{{ $category->id }}" data-toggle="tab">
                                                {{ $category->name }}</a></li>
                                    @endforeach

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @php
                                        $firstActiveTab = true;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <div class="@php echo $firstActiveTab ? "active" : ""; $firstActiveTab = false; @endphp tab-pane"
                                            id="category{{ $category->id }}">
                                            <div class="row g-3">

                                                @foreach ($products as $product)
                                                    @if ($product->category_id == $category->id)
                                                        <div
                                                            class="col-6 col-md-4 col-lg-3 border border-5 border-left-0 border-top-0 border-bottom-0 mb-3">

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <img src="{{ URL($product->img) }}" class="img-fluid">
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col-12">
                                                                        <span class="text-lg">{{ $product->name }}</span>
                                                                    </div>
                                                                    <div class="col-12 fw-bold mb-2">
                                                                        <span
                                                                            class="text-danger text-lg">{{ $product->price }}</span>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button class="btn btn-danger btn-addtocart"
                                                                            data-id="{{ $product->id }}"><i
                                                                                class="fas fa-shopping-cart"></i>
                                                                            Thêm vào giỏ hàng</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach



                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    @section('script')
    <script>
        $(document).ready(function() {
            $(".btn-addtocart").click(function(e) {
                const product_id = $(this).data('id');
                e.preventDefault();
                console.log("product_id", product_id);
                
                $.ajax({
                    type: "get",
                    url: "{{ route('addtocart') }}",
                    data: {
                        user_token: getCookie('user_token'),
                        product_id: product_id
                    },
                    dataType: "json",
                    success: function(response, textStatus, jqXHR) {

                        Toast.fire({
                            icon: 'success',
                            html: '<span class="text-success">'+ response.message + '</span>'
                        })
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
        })
    </script>
    @endsection
    <!-- /.content-wrapper -->
@endsection()
