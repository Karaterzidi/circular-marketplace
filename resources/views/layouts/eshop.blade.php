<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boutique | Ecommerce bootstrap template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{ asset('eshop/vendor/lightbox2/css/lightbox.min.css') }}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ asset('eshop/vendor/nouislider/nouislider.min.css') }}">
    <!-- Bootstrap select-->
    <!-- <link rel="stylesheet" href="{{ asset('eshop/vendor/bootstrap-select/css/bootstrap-select.min.css') }}"> -->
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{{ asset('eshop/vendor/owl.carousel2/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('eshop/vendor/owl.carousel2/assets/owl.theme.default.css') }}">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('eshop/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('eshop/css/custom.css') }}" >
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('eshop/img/favicon.png') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('styles')
  </head>
  <body>
    <div class="page-holder">
        <!-- navbar-->
        <header class="header bg-white">
            <div class="container px-0 px-lg-3">
            <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="/"><span class="font-weight-bold text-uppercase text-dark">Circular Marketplace</span></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <!-- Link--><a class="nav-link active" href="/">Home</a>
                    </li>
                    @if(auth()->user())
                    <li class="nav-item">
                    <!-- Link--><a class="nav-link" href="/shop">Shop</a>
                    </li>
                    @endif
                    <!-- <li class="nav-item">
                    <a class="nav-link" href="detail.html">Product detail</a>
                    </li> -->
                    <!-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                    <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown"><a class="dropdown-item border-0 transition-link" href="index.html">Homepage</a><a class="dropdown-item border-0 transition-link" href="shop.html">Category</a><a class="dropdown-item border-0 transition-link" href="detail.html">Product detail</a><a class="dropdown-item border-0 transition-link" href="cart.html">Shopping cart</a><a class="dropdown-item border-0 transition-link" href="checkout.html">Checkout</a></div>
                    </li> -->
                </ul>
                <form id="logout" action="/logout" method="POST">@csrf</form>
                <ul class="navbar-nav ml-auto">               
                    @if(auth()->user())
                    <li class="nav-item"><a class="nav-link" href="/cart"> <i class="fas fa-shopping-cart mr-1 text-gray"></i>Cart</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#"> <i class="far fa-heart mr-1"></i><small class="text-gray"> (0)</small></a></li> -->
                    <li class="nav-item"><a class="nav-link" href="/profile"> <i class="fas fa-user-alt mr-1 text-gray"></i>Profile</a></li>
                    <li class="nav-item"><button style="background: none; border: none" form="logout" class="nav-link"> <i class="fas fa-sign-out-alt mr-1 text-gray"></i>Logout</button></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="/login"> <i class="fas fa-user-alt mr-1 text-gray"></i >Login</a></li>
                    @endif
                </ul>
                </div>
            </nav>
            </div>
        </header>
      
        @yield('content')

        </div>
        <footer class="bg-dark text-white">
            <div class="container py-4">
                <div class="row py-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Circular Marketplace</h6>
                    <ul class="list-unstyled mb-0">
                    <li><a class="footer-link" href="/">Home</a></li>
                    <li><a class="footer-link" href="/shop">Shop</a></li>
                    <li><a class="footer-link" href="/cart">Cart</a></li>
                    <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Company</h6>
                    <ul class="list-unstyled mb-0">
                    <li><a class="footer-link" href="#">What We Do</a></li>
                    <li><a class="footer-link" href="#">Available Services</a></li>
                    <li><a class="footer-link" href="#">Latest Posts</a></li>
                    <li><a class="footer-link" href="#">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase mb-3">Social media</h6>
                    <ul class="list-unstyled mb-0">
                    <li><a class="footer-link" href="https://www.facebook.com/UniversityofWestAttica/">Facebook</a></li>
                    <li><a class="footer-link" href="https://www.instagram.com/universityofwestattica/?hl=el">Instagram</a></li>
                    <li><a class="footer-link" href="https://gr.linkedin.com/school/university-of-west-attica/">Linkedin</a></li>
                    </ul>
                </div>
                </div>
                <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                <div class="row">
                    <div class="col-lg-6">
                    <p class="small text-muted mb-0">&copy; 2021</p>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                    <p class="small text-muted mb-0">Circular Marketplace by <a class="text-white reset-anchor" href="#">Σοφία Καρατερζίδη</a></p>
                    </div>
                </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript files-->
    <!-- <script src="{{ asset('eshop/vendor/jquery/jquery.min.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous" ></script>
    <!-- <script src="{{ asset('eshop/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
    <script src="{{ asset('eshop/vendor/nouislider/nouislider.min.js') }}"></script>
    <script defer src="{{ asset('eshop/vendor/owl.carousel2/owl.carousel.min.js') }}"></script>
    <script defer src="{{ asset('eshop/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    <script src="{{ asset('eshop/vendor/lightbox2/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('eshop/js/front.js') }}"></script>
      
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @yield('scripts')
  </body>
</html>