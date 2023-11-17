@extends('homepage.layout.layout')

@section('main')
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Cart</h2>
                </div>
                <div class="row">
                    @if (Cart::session(auth()->user()->id)->isEmpty())
                        <h3 class="section-subheading text-muted text-center mt-5">(Cart Is Empty...)</h3>
                    @else
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col" class="w-25">Harga</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col" colspan="3" class="w-25 text-center">Action</th>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $cart->name }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>{{ $cart->price }}</td>
                                    <td>{{ Cart::get($cart->id)->getPriceSum() }}</td>
                                    {{-- Update --}}
                                    <form action="{{ url('cart/update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $cart->id }}">
                                    <td><input type="number" class="form-control" name="qty" min="1"></td>
                                    <td><button type="submit" class="btn btn-primary">Update</button></td>
                                    </form>
                                    {{-- Delete --}}
                                    <td><a href="{{ url('/cart/delete/'. $cart->id) }}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col">Total : {{ Cart::session(auth()->user()->id)->getTotal() }}</th>
                                    <th scope="col" colspan="3" class="text-center">
                                        <a href="{{ url('/cart/check-out') }}" class="btn btn-dark">Check-out</a>
                                        {{-- <button class="btn btn-dark" id="check-out">Check-Out</button> --}}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    @endif
                </div>
            </div>
        </section>
@endsection