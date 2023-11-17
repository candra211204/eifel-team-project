<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">TIK Health</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
            @guest
            <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a></li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ url('home') }}">{{ auth()->user()->name }}</a></li>
            @endguest
            <li class="nav-item"><a class="nav-link">Cart : {{ Cart::session(auth()->user()->id)->getcontent()->count() }}</a></li>
            </ul>
        </div>
    </div>
</nav>