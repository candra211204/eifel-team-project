    {{-- Side Bar --}}
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
        {{-- Sidebar Head --}}
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                {{-- <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
                    
                </a> --}}
            {{-- Logo --}}
            <div class="navbar-brand m-0">
                <img src="{{ asset('../assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Kelompok7Bookstore</span>
            </div>
        {{-- Logo End --}}
        </div>
        {{-- Sidebar Head End --}}

        <hr class="horizontal dark mt-0">

        {{-- Sidebar Body --}}
        @if (isset(auth()->user()->id))
            <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    {{-- Profile --}}
                    <div class="ms-5 me-5">
                        <div class="dropdown-center mb-3">
                            <button class="btn my-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('template/assets/img/bruce-mars.jpg') }}" alt="profile_image" class="w-40 border-radius-lg shadow-sm " title="Ambil Dari Database">
                                <br>
                                <p class="mt-2 mb-2">{{ auth()->user()->name }}</p>
                            </button>
                            <ul class="dropdown-menu mt-0">
                                @if (auth()->user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ url('/admin') }}">Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ url('/user/profil') }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ url('/user/pesanan') }}">Daftar Pesanan</a></li>
                                <li><a class="dropdown-item" href="#" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    {{-- Profile End --}}
                    <li class="nav-item">
                        <div class="container">
                            <div class="row ms-2 me-2">
                                {{-- Homepage --}}
                                {{-- <button type="button" class="btn col-md-12" href="userhomepage">
                                    <i class="fa-solid fa-store"></i>
                                    <p>Homepage</p>
                                </button> --}}
                                <a href="{{ url('/') }}" class="btn col-md-12">
                                    <i class="fa-solid fa-store"></i>
                                    <p>Homepage</p>
                                </a>
                                {{-- Homepage End --}}

                                {{-- Cart --}}
                                <a href="{{ url('cart') }}" class="btn col-md-12">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <p>List cart <small class="text-danger">{{ '('.Cart::session(auth()->user()->id)->getcontent()->count().')' }}</small></p>
                                </a>
                                {{-- Cart End --}}
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        @else
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                {{-- Profile --}}
                <div class="ms-5 me-5">
                    <div class="dropdown-center mb-3">
                        <button class="btn my-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('template/assets/img/bruce-mars.jpg') }}" alt="profile_image" class="w-40 border-radius-lg shadow-sm " title="Ambil Dari Database">
                            <br>
                            <p class="mt-2 mb-2">Login or Register</p>
                        </button>
                        <ul class="dropdown-menu mt-0">
                            <li><a class="dropdown-item" href="{{ url('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ url('register') }}">Register</a></li>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </ul>
        </div>
        @endif
        {{-- Need Help --}}
        {{-- <div class="sidenav-footer mx-3 mt-5">
            <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
                <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpg')"></div>
                    <div class="card-body text-start p-3 w-100">
                        <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                            <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
                        </div>
                        <div class="docs-info">
                            <h6 class="text-white up mb-0">Need help?</h6>
                            <p class="text-xs font-weight-bold">Please contactus</p>
                            <a href="" target="_blank" class="btn btn-white btn-sm w-100 mb-0">ContactUs</a>
                        </div>
                </div>
            </div>
        </div> --}}
        {{-- Need Help End --}}
        {{-- Sidebar Body End --}}
    </aside>
    {{-- Side Bar End --}}