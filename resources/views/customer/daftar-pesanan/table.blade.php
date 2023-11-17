@extends('customer.layouts.layout')

@section('main')
            {{-- Book --}}
            <div class="container">
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="section-heading text-uppercase">Daftar Pesanan : </h2>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Action</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $pesanan->order_id }}</td>
                                        <td>@currency($pesanan->total)</td>
                                        <td>{{ $pesanan->metode_pembayaran }}</td>
                                        <td><p class="text-success fw-bold">{{ strstr($pesanan->status, ', ', true) }}</p></td>
                                        <td>{{ $pesanan->tanggal }}</td>
                                        <td>
                                            <a href="{{ url('/user/pesanan/detail/'.$pesanan->id) }}" class="btn btn-primary">Detail</a>
                                            <a href="{{ url('/user/pesanan/cetak/'.$pesanan->id) }}" class="btn btn-secondary">Cetak Invoice</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            {{-- Book End --}}
@endsection