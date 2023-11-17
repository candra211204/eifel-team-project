@extends('customer.layouts.layout')

@section('main')
            {{-- Carousel --}}
            <div class="container">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3 mt-5 mb-5">
                        <div class="carousel-item active">
                            <img src="{{ asset('template/media/carousel1.jpg') }}" class="d-block w-100" alt="..." width="500" height="200">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/media/carousel2.jpg') }}" class="d-block w-100" alt="..." width="500" height="200">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/media/carousel3.jpg') }}" class="d-block w-100" alt="..." width="500" height="200">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            {{-- Carousel End --}}
    
            {{-- Book --}}
            <div class="container">
                <div class="card mt-3">
                    <div class="card-body">
                        <h3>Buku :</h3> 
                        <div class="row">
                            {{-- Book1 --}}
                            @foreach ($listbuku as $buku)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mt-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                        <a class="d-block shadow-xl border-radius-xl">
                                            <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0, 0, 0, 0.7)"><a href="{{ url('/?kategori='.$buku->kategori_id) }}" class="text-decoration-none text-white">{{ $buku->kategori->name }}</a></div>
                                            <img src="{{ asset('storage/'.$buku->cover) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                        </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">{{ $buku->kategori->jenis_kategori }}  </p>
                                        <a href="">
                                            <h5>{{ $buku->judul }}</h5>
                                        </a>
                                        <p class="text-gradient text-dark mb-2 text-sm"> @currency($buku->harga)   </p>
                                        <p class="text-gradient text-dark mb-2 text-sm">{{ $buku->stok }}  buah</p>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $buku->id }}">
                                            <p>See Details</p>
                                        </a>
                                            @if(isset(auth()->user()->id) && $buku->stok != 0)
                                            <div class="row">
                                                @if ($cart->where('id', $buku->id)->count())
                                                    <center>(In Cart)</center>
                                                @else
                                                <form action="{{ url('cart/store') }}" method="POST">
                                                    @csrf
                                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}" required>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control m-auto" placeholder="Masukkan Cart" name="qty" min="1"  max="{{ $buku->stok }}" aria-describedby="button-addon2">
                                                            <button class="btn btn-primary m-auto" type="submit" id="button-addon2">+ Cart</button>
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $buku->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $buku->judul }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/'.$buku->cover) }}" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl mb-3">
                                                    <h6 class="item-intro text-muted mb-3 text-center">Harga : @currency($buku->harga)</h6>
                                                    <h6 class="item-intro text-muted mb-3 text-center">Jumlah : {{ $buku->stok }}</h6>
                                                    <p>{{ $buku->sinopsis }}</p>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <strong>Penulis :</strong>
                                                            {{ $buku->penulis }}
                                                        </li>
                                                        <li>
                                                            <strong>Penerbit :</strong>
                                                            {{ $buku->penerbit }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            {{-- Book1 End --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- Book End --}}
@endsection