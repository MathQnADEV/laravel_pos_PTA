@extends('layouts.app')

@section('title', 'Detail Pesanan')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pesanan</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title" style="font-size: 20px">Detail Pesanan</h2>
                <p class="section-leading">
                <div>
                    <h6>Total Harga: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</h6>
                    <h6>Waktu Transaksi: {{ $order->transaction_time }}</h6>
                    <h6>Total Produk: {{ $order->total_item }}</h6>
                </div>
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr style="font-size: 17px">
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>QTY</th>
                                            <th>Harga Produk</th>
                                        </tr>
                                        @foreach ($orderItems as $item)
                                            <tr style="font-size: 16px">
                                                <td>
                                                    {{ $item->product->name }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item->product->price, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    {{ $item->quantity }}
                                                </td>
                                                <td>
                                                    Rp. {{ number_format($item->total_price, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
