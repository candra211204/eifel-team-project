@extends('homepage.layout.layout')

@section('main')
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome To Our Web!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">buku</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    @foreach ($bukus as $buku)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <!-- Portfolio item 1-->
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ url('homepage/assets/img/portfolio/1.jpg') }}" alt="..." />
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">{{ $buku->judul }}</div>
                                    <div class="portfolio-caption-subheading text-muted">
                                        Harga : Rp. {{ $buku->harga }}
                                    </div>
                                    <div class="portfolio-caption-subheading mt-3">
                                        @if ($cart->where('id', $buku->id)->count())
                                            (In Cart)
                                        @else
                                        <form action="{{ url('cart/store') }}" method="POST">
                                            @csrf
                                                <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                                <center><input type="number" class="form-control w-25" name="qty" min="1" max="{{ $buku->stok }}"></center>
                                                <button class="btn btn-primary mt-3">+ Cart</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
@endsection