@extends('customer.layouts.layout')

@section('main')
            {{-- Book --}}
            <div class="container">
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="section-heading text-uppercase">Detail Pesanan</h2>
                        @foreach ($pesanans as $pesanan)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3>Pesanan Ke- {{ $loop->iteration }}</h3>
                                    <h4>{{ $pesanan->buku->judul }}</h4>
                                    <h6>Jumlah : {{ $pesanan->jumlah }}</h6>
                                    <h6>Harga : @currency($pesanan->harga)</h6>
                                </div>
                            </div>
                        @endforeach
                        <div class="card-body">
                            <h3>Total :  @currency($pesanan_data->total) </h3>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Book End --}}
@endsection