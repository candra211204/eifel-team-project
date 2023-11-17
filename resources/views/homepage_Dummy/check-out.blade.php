@extends('homepage.layout.layout')

@section('main')
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Detail Pesanan : </h2>
                </div>
                <div class="row">
                    @foreach ($pesanans as $data)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3>Pesanan Ke- {{ $loop->iteration }}</h3>
                                <h4>{{ $data->buku->judul }}</h4>
                                <h6>Jumlah : {{ $data->jumlah }}</h6>
                                <h6>Harga : {{ $data->harga }}</h6>
                            </div>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3>Total : {{ $pesanan->total }}</h3>
                            <button class="btn btn-dark" onclick="bayar({{ $pesanan->id }})">Check-Out</button>
                            <form action="{{ url('check-out/pembayaran') }}" id="submit_form" method="POST">
                                @csrf
                                <input type="hidden" name="json" id="call_json">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection