
@extends('admin.asset.template')

@section('main')
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-4">
                <h3 class="font-weight-bolder mb-3">Daftar Pesanan</h3>
                    <div class="row">
                        <div class="col">
                        <a href="{{ url('pesanan/laporan/excel') }}" class="btn btn-primary">Cetak Laporan</a>
                        </div>
                        <table class="table text-center">
                            <thead class="thead">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Customer</th>
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
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->order_id }}</td>
                                    <td>@currency($pesanan->total)</td>
                                    <td>{{ $pesanan->metode_pembayaran }}</td>
                                    <td><p class="text-success fw-bold">{{ strstr($pesanan->status, ', ', true) }}</p></td>
                                    <td>{{ $pesanan->tanggal }}</td>
                                    <td><a href="{{ url('/user/pesanan/detail/'.$pesanan->id) }}" class="btn btn-primary">Detail</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection