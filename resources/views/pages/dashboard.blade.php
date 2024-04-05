@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard - Semoga harimu menyenangkan brooo</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 style="font-size: 16px">Total STAFF</h4>
                            </div>
                            <div class="card-body">
                                {{ $users }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-cubes-stacked"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 style="font-size: 16px">Total Produk</h4>
                            </div>
                            <div class="card-body">
                                {{ $products }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="margin-top: -8px">
                                <h4 style="font-size: 16px">Total Pemasukan Bulan Sekarang</h4>
                            </div>
                            <div class="card-body">
                                Rp. {{ number_format($total_pemasukan, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header" style="margin-top: -8px">
                                <h4 style="font-size: 16px">Total Order Bulan Sekarang</h4>
                            </div>
                            <div class="card-body">
                                {{ $order }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 style="font-size: 20px">Grafik Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChartss" height="182"></canvas>
                            <div class="statistic-details mt-sm-4">
                                <div class="statistic-details-item">
                                    <div class="detail-value" style="font-size: 25px">Rp
                                        {{ number_format($today_sale, 0, ',', '.') }}</div>
                                    <div class="detail-name" style="font-size: 16px">Penjualan Hari Ini</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" style="font-size: 25px">Rp
                                        {{ number_format($week_sale, 0, ',', '.') }}</div>
                                    <div class="detail-name" style="font-size: 16px">Penjualan Minggu Ini</div>
                                </div>
                                <div class="statistic-details-item">
                                    {{-- <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span>9%</span> --}}
                                    <div class="detail-value" style="font-size: 25px">Rp
                                        {{ number_format($month_sale, 0, ',', '.') }}</div>
                                    <div class="detail-name" style="font-size: 16px">Penjualan Bulan Ini</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" style="font-size: 25px">Rp
                                        {{ number_format($year_sale, 0, ',', '.') }}</div>
                                    <div class="detail-name" style="font-size: 16px">Penjualan Tahun Ini</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var weeklyIncomeData = {!! json_encode($weeklyIncomeData) !!};
            var labels = [];
            var datasets = [];
            Object.keys(weeklyIncomeData).forEach(function(kasirName) {
                var data = [];
                Object.keys(weeklyIncomeData[kasirName]).forEach(function(date) {
                    var formattedDate = new Date(date).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short'
                    });
                    if (!labels.includes(formattedDate)) {
                        labels.push(
                            formattedDate);
                    }
                    data.push(weeklyIncomeData[kasirName][
                        date
                    ]);
                });
                datasets.push({
                    label: 'Total pemasukan - ' + kasirName,
                    data: data,
                    backgroundColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(
                        Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)',
                    borderColor: 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math
                        .random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 1)',
                    borderWidth: 1,
                    fill: false
                });
            });

            var ctx = document.getElementById('myChartss').getContext('2d');
            var myChartss = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontSize: 16,
                                callback: function(value, index, values) {
                                    return 'Rp ' + value.toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                            },
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 16
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem
                                    .index];
                                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        }
                    },
                    legend: {
                        labels: {
                            fontSize: 16
                        }
                    }
                }
            });
        });
    </script>
@endpush
