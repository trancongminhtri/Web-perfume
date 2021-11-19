@extends('admin.layout-admin')
@section('title')
@endsection
@section('content')
<!-- Loading -->
<div class="loading"></div>
<div class="content-admin">
    <div class="grid_g">
        <div class="row_g">
            <div class="col_g l-12_g m-12_g" style="width:99%;">
                <div class="add-form__header add-form__add-account--center add-form__haeder-product">
                    <h3 class="add-form__haeding add-form__haeding-product">Báo Cáo Thống Kê</h3>
                </div>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger noti-alert-danger" role="alert" style="font-size: 1.5rem; margin-top: 10px;">
                        {{ $error }}
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <form action="{{route('quanly.bao-cao-thong-ke')}}" method="GET">
                    <div class="filter-report">
                        <div class="report-from">
                            <label for="" class="report-from__label">Từ: </label>
                            <input type="date" class="report-from__input" id="from_date" name="from_date" value="{{$now}}">
                        </div>
                        <div class="report-to">
                            <label for="" class="report-to__label">Đến: </label>
                            <input type="date" class="report-to__input" id="to_date" name="to_date" value="{{$now}}">
                        </div>
                        <div class="filter-select">
                            <label for="" class="report-to__label">Lọc:</label>
                            <select name="thoi_gian" id="thoi_gian" class="select-form report-select">
                                <option value="chon">-Chọn-</option>
                                <option value="hom-nay">Hôm nay</option>
                                <option value="hom-qua">Hôm qua</option>
                                <option value="tuan-nay">Tuần này</option>
                                <option value="thang-nay">Tháng này</option>
                                <option value="nam-nay">Năm này</option>
                            </select>
                        </div>
                        <div class="report-button">
                            <button id="btn-filter" class="report__btn" style="background: linear-gradient(0deg, #48c6ef, #6f86d6);"><i class="fas fa-filter" style="margin-right: 4px;"></i>Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div class="info-report__title">Thống kê doanh thu:<span> (gồm các đơn hàng đã hoàn thành - đã nhận được tiền)</span></div>
                <div class="info-report info-report__complete">
                    <a class="total-rating total-rating-complete">
                        <div class="total-rating__icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="total-rating__label">
                            Doanh thu: <br /><span>{{number_format($thongKeDHHoanThanh['tong_thanh_toan'])}}</span>
                        </div>
                        <div class="total-order__unit">VNĐ</div>
                    </a>

                    <a class="total-order total-order-complete">
                        <div class="total-order__icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <div class="total-order__label">
                            Đơn hàng: <br /><span>{{number_format($thongKeDHHoanThanh['tong_don_hang'])}}</span>
                        </div>
                        <div class="total-order__unit">Hóa đơn</div>
                    </a>
                    <a class="total-product total-product-complete">
                        <div class="total-product__icon">
                            <i class="fas fa-air-freshener"></i>
                        </div>
                        <div class="total-product__label">
                            Sản phẩm: <br /><span>{{number_format($thongKeDHHoanThanh['tong_san_pham'])}}</span>
                        </div>
                        <div class="total-order__unit">Sản phẩm</div>
                    </a>

                </div>
            </div>
            <div class="col_g l-6_g m-6_g" style="width:50%">
                <div class="chart-doughnut">
                    <canvas id="chart-doughnut-complete"></canvas>
                </div>
            </div>
            <div class="col_g l-6_g m-6_g" style="width:50%">
                <div class="total-turnover total-turnover-complete">
                    <div class="turnover__title">Tổng doanh thu <span>(đã nhận tiền)</span></div>
                    <div class="turnover__content complete" style="background-color: #556b2f;">
                        <div class="turnover__name">Trước giảm giá</div>
                        <div class="turnover__value">{{number_format($doanhThuDHHoanThanh['truoc_giam_gia'])}} <span>VNĐ</span></div>
                    </div>

                    <div class="turnover__content complete">
                        <div class="turnover__name">Giảm giá</i></div>
                        <div class="turnover__value">{{number_format($doanhThuDHHoanThanh['giam_gia'])}} <span>VNĐ</span></div>
                    </div>

                    <div class="turnover__content complete" style="background-color: #556b2f;">
                        <div class="turnover__name">Thực tế</div>
                        <div class="turnover__value">{{number_format($doanhThuDHHoanThanh['thuc_te'])}} <span>VNĐ</span></div>
                    </div>
                </div>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div id="phan-trang-nuoc-hoa-ht">
                    @include('admin.bao-cao.nuoc-hoa-hoan-thanh')
                </div>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div class="info-report__title un-complete">Thống kê doanh thu:<span> (gồm các các đơn hàng đang xử lý, đã xử lý và đã hủy)</span></div>
                <div class="info-report">
                    <a class="total-rating">
                        <div class="total-rating__icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="total-rating__label">
                            Doanh thu: <br /><span>{{number_format($thongKeDHMoi['tong_thanh_toan'])}}</span>
                        </div>
                        <div class="total-order__unit">VNĐ</div>
                    </a>

                    <a class="total-order">
                        <div class="total-order__icon">
                            <i class="fas fa-cart-arrow-down"></i>
                        </div>
                        <div class="total-order__label">
                            Đơn hàng: <br /><span>{{number_format($thongKeDHMoi['tong_don_hang'])}}</span>
                        </div>
                        <div class="total-order__unit">Hóa đơn</div>
                    </a>
                    <a class="total-product">
                        <div class="total-product__icon">
                            <i class="fas fa-air-freshener"></i>
                        </div>
                        <div class="total-product__label">
                            Tổng sản phẩm: <br /><span>{{number_format($thongKeDHMoi['tong_san_pham'])}}</span>
                        </div>
                        <div class="total-order__unit">Sản phẩm</div>
                    </a>

                </div>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div class="row_g no-gutters  row_g-chart">
                    <div class="col_g l-6_g m-6_g" style="width:50%">
                        <div class="chart-doughnut">
                            <canvas id="chart-doughnut-bill"></canvas>
                        </div>
                    </div>

                    <div class="col_g l-6_g m-6_g" style="width:50%">
                        <div class="chart-doughnut">
                            <canvas id="chart-doughnut-turnover"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div class="row_g no-gutters">
                    <div class="col_g l-4_g m-4_g" style="width:33.333%">
                        <div class="total-turnover total-bill">
                            <div class="turnover__title">Đơn hàng</div>

                            <div class="turnover__content turnovar__bill" style="background-color: #cc9b1e;">
                                <div class="turnover__name">Đang xử lý</i></div>
                                <div class="turnover__value">{{number_format($trangThaiDHMoi['dang_xu_ly'])}} <span class="unit-bill">đơn hàng</span></div>
                            </div>

                            <div class="turnover__content turnovar__bill">
                                <div class="turnover__name">Đã xử lý</div>
                                <div class="turnover__value">{{number_format($trangThaiDHMoi['da_xu_ly'])}} <span class="unit-bill">đơn hàng</span></div>
                            </div>

                            <div class="turnover__content turnovar__bill" style="background-color: #cc9b1e;">
                                <div class="turnover__name">Đã hủy</div>
                                <div class="turnover__value">{{number_format($trangThaiDHMoi['da_huy'])}} <span class="unit-bill">đơn hàng</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col_g l-4_g m-4_g" style="width:33.333%">
                        <div class="total-turnover">
                            <div class="turnover__title" style="background-color: #bf4f4f;">Hóa đơn hủy</div>

                            <div class="turnover__content" style="background-color: #c85151;">
                                <div class="turnover__name">Trước giảm giá</div>
                                <div class="turnover__value">{{number_format($doanhThuDHHuy['truoc_giam_gia'])}} <span>VNĐ</span></div>
                            </div>

                            <div class="turnover__content" style="background-color: #bf4f4f;">
                                <div class="turnover__name">Giảm giá</i></div>
                                <div class="turnover__value">{{number_format($doanhThuDHHuy['giam_gia'])}} <span>VNĐ</span></div>
                            </div>

                            <div class="turnover__content" style="background-color: #c85151;">
                                <div class="turnover__name">Thực tế</div>
                                <div class="turnover__value">{{number_format($doanhThuDHHuy['thuc_te'])}} <span>VNĐ</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col_g l-4_g m-4_g" style="width:33.333%">
                        <div class="total-turnover">
                            <div class="turnover__title">Tổng doanh thu (dự kiến)</div>
                            <div class="turnover__content" style="background-color: #2f4f4f;">
                                <div class="turnover__name">Trước giảm giá</div>
                                <div class="turnover__value">{{number_format($doanhThuDHMoi['truoc_giam_gia'])}} <span>VNĐ</span></div>
                            </div>

                            <div class="turnover__content">
                                <div class="turnover__name">Giảm giá</i></div>
                                <div class="turnover__value">{{number_format($doanhThuDHMoi['giam_gia'])}} <span>VNĐ</span></div>
                            </div>

                            <div class="turnover__content" style="background-color: #2f4f4f;">
                                <div class="turnover__name">Thực tế</div>
                                <div class="turnover__value">{{number_format($doanhThuDHMoi['thuc_te'])}} <span>VNĐ</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col_g l-12_g m-12_g" style="width:100%">
                <div id="phan-trang-nuoc-hoa-khac">
                    @include('admin.bao-cao.nuoc-hoa-khac')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
<!-- Chart JS -->
<script src="{{asset('assets/chart.js/dist/chart.min.js')}}"></script>

<!-- Lấy giá trị từ phân trang -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#phan-trang-nuoc-hoa-ht .pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var from_date, to_date, thoi_gian;
            if($(location).attr('href').split('thoi_gian=')[1] != 'chon'){
                from_date = null;
                to_date = null;
                thoi_gian = $(location).attr('href').split('thoi_gian=')[1];
            }
            else{
                var arrURL = $(location).attr('href').split('&');
                from_date = arrURL[0].split('from_date=')[1];
                to_date = arrURL[1].split('to_date=')[1];
                thoi_gian = arrURL[2].split('thoi_gian=')[1];
            }
            phanTrangNuocHoaHT(from_date, to_date, thoi_gian, page);
        });
    });

    function phanTrangNuocHoaHT(from_date, to_date, thoi_gian, page) {
        $.ajax({
            url: '/phan-trang-thong-ke?from_date='+ from_date + '&to_date=' + to_date + '&thoi_gian=' + thoi_gian +'&page=' + page,
            success: function(data) {
                $('#phan-trang-nuoc-hoa-ht').html(data['nuoc_hoa_ht']);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#phan-trang-nuoc-hoa-khac .pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var from_date, to_date, thoi_gian;
            if($(location).attr('href').split('thoi_gian=')[1] != 'chon'){
                from_date = null;
                to_date = null;
                thoi_gian = $(location).attr('href').split('thoi_gian=')[1];
            }
            else{
                var arrURL = $(location).attr('href').split('&');
                from_date = arrURL[0].split('from_date=')[1];
                to_date = arrURL[1].split('to_date=')[1];
                thoi_gian = arrURL[2].split('thoi_gian=')[1];
            }
            phanTrangNuocHoa(from_date, to_date, thoi_gian, page);
        });
    });

    function phanTrangNuocHoa(from_date, to_date, thoi_gian, page) {
        $.ajax({
            url: '/phan-trang-thong-ke?from_date='+ from_date + '&to_date=' + to_date + '&thoi_gian=' + thoi_gian +'&page=' + page,
            success: function(data) {
                $('#phan-trang-nuoc-hoa-khac').html(data['nuoc_hoa_khac']);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        // Chart doughnut bill
        const data_doughnut = {
            labels: ['Đang xử lý', 'Đã xử lý', 'Đã hủy'],
            datasets: [{
                label: 'Biểu đồ thống kê đơn hàng',
                data: Object.values(<?php echo (json_encode($trangThaiDHMoi)) ?>),
                borderWidth: 0.5,
                backgroundColor: ['#CB4335', '#1F618D', '#27AE60', ],
            }]
        };

        // Removes the alpha channel from background colors
        function handleLeave(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = color.length === 9 ? color.slice(0, -2) : color;
            });
            legend.chart.update();
        }

        // Append '4d' to the colors (alpha channel), except for the hovered index
        function handleHover(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
            });
            legend.chart.update();
        }

        const config_doughnut = {
            type: 'doughnut',
            data: data_doughnut,
            options: {
                plugins: {
                    legend: {
                        onHover: handleHover,
                        onLeave: handleLeave
                    },
                    title: {
                        display: true,
                        text: 'Biểu đồ thống kê đơn hàng'
                    }
                },
            }
        };

        var ctx_doungut = document.getElementById('chart-doughnut-bill');
        new Chart(ctx_doungut, config_doughnut);

        // Chart doughnut turnover
        const data_doughnutTurnover = {
            labels: ['Thực thế', 'Khuyến mãi', 'Trước khuyến mãi'],
            datasets: [{
                label: 'Biểu đồ thống kê doanh thu',
                data: Object.values(<?php echo (json_encode($doanhThuDHMoi)) ?>),
                borderWidth: 0.5,
                backgroundColor: ['#27AE60', '#1F618D', '#F1C40F'],
            }]
        };

        // Removes the alpha channel from background colors
        function handleLeave(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = color.length === 9 ? color.slice(0, -2) : color;
            });
            legend.chart.update();
        }

        // Append '4d' to the colors (alpha channel), except for the hovered index
        function handleHover(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
            });
            legend.chart.update();
        }

        const config_doughnutTurnover = {
            type: 'doughnut',
            data: data_doughnutTurnover,
            options: {
                plugins: {
                    legend: {
                        onHover: handleHover,
                        onLeave: handleLeave
                    },
                    title: {
                        display: true,
                        text: 'Biểu đồ thống kê doanh thu'
                    }
                },
            }
        };

        var ctx_doungut = document.getElementById('chart-doughnut-turnover');
        new Chart(ctx_doungut, config_doughnutTurnover);


        // Chart doughnut Complete
        const data_doughnutComplete = {
            labels: ['Thực thế', 'Khuyến mãi', 'Trước khuyến mãi'],
            datasets: [{
                label: 'Biểu đồ thống kê doanh thu',
                data: Object.values(<?php echo (json_encode($doanhThuDHHoanThanh)) ?>),
                borderWidth: 0.5,
                backgroundColor: ['#27AE60', '#1F618D', '#F1C40F'],
            }]
        };

        // Removes the alpha channel from background colors
        function handleLeave(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = color.length === 9 ? color.slice(0, -2) : color;
            });
            legend.chart.update();
        }

        // Append '4d' to the colors (alpha channel), except for the hovered index
        function handleHover(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
            });
            legend.chart.update();
        }

        const config_doughnutComplete = {
            type: 'doughnut',
            data: data_doughnutComplete,
            options: {
                plugins: {
                    legend: {
                        onHover: handleHover,
                        onLeave: handleLeave
                    },
                    title: {
                        display: true,
                        text: 'Biểu đồ thống kê doanh thu đã hoàn thành'
                    }
                },
            }
        };
        var ctx_doungut_complete = document.getElementById('chart-doughnut-complete');
        new Chart(ctx_doungut_complete, config_doughnutComplete);
    });
</script>
<!-- Filter select -->
<script>
    $('.report-select').change(function() {
        if ($('.report-select').val() !== '') {
            $('.report-from__input').attr('disabled', 'disabled');
            $('.report-to__input').attr('disabled', 'disabled');
        } else {
            $('.report-from__input').removeAttr('disabled');
            $('.report-to__input').removeAttr('disabled');
        };
    });
</script>
@endsection