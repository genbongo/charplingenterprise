<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Creamline</title>
        <link rel="shortcut icon" type="image/jpg" href="{{url('/img/logo/logo.jpg')}}"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <!-- js -->
        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    </head>
    <body>

        <div class="preloader">
            <div class="animation"></div>
            <div class="animation"></div>
            <div class="animation"></div>
            <div class="animation"></div>
            <div class="animation target">
                <img src="{{url('/img/logo/creamline_logo.png')}}" class="boang">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

            </div>
        </div>
        <div class="content">
            <div id="top"><p class="top-message">Welcome to Creamline Philippines (+63)912-3456-789)</p></div>
            <div class="menu-container sticky-top">
                <div class="logo-container">
                    <img src="{{url('/img/logo/logo.jpg')}}" id="logo" alt="logo"/>
                </div>
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <!-- slider section -->
            <!-- left-slider -->
            <div class="full-slider">
                <div class="row">
                    <div class="col-md-8">
                        <div id="slider1" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{url('/img/core/banner-1.png')}}">
                                        <!-- <div class="carousel-caption d-none d-md-block">
                                            <h5>First slide label</h5>
                                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                        </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/banner-2.png')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Second slide label</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/banner-4.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#slider1" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slider1" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!-- right-slider -->
                    <div class="col-md-4">
                        <div id="slider2" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{url('/img/core/slider-1.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>First slide label</h5>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    </div> -->
                                </div>
                                
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-2.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Second slide label</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-3.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-4.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-5.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-6.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-7.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-8.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                                <div class="carousel-item">
                                <img src="{{url('/img/core/slider-9.jpg')}}">
                                    <!-- <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div> -->
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#slider2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slider2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3 column section -->
            <div class="row">
                <div class="col-md-4">
                    <div class="hover hover-4 text-white rounded">
                            <img src="{{url('/img/core/shirt.jpg')}}" class="img-fluid " alt="">
                        <div class="hover-overlay"></div>
                        <div class="hover-4-content">
                            <!-- <h3 class="hover-4-title text-uppercase font-weight-bold mb-0"><span>Available Now!</span></h3> -->
                            <p class="hover-4-description text-uppercase mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hover hover-4 text-white rounded">
                            <img src="{{url('/img/core/icecream.jpg')}}" class="img-fluid " alt="">
                        <div class="hover-overlay"></div>
                        <div class="hover-4-content">
                            <!-- <h3 class="hover-4-title text-uppercase font-weight-bold mb-0"><span>Available Now!</span></h3> -->
                            <p class="hover-4-description text-uppercase mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hover hover-4 text-white rounded">
                            <img src="{{url('/img/core/shop.jpg')}}" class="img-fluid " alt="">
                        <div class="hover-overlay"></div>
                        <div class="hover-4-content">
                            <!-- <h3 class="hover-4-title text-uppercase font-weight-bold mb-0"><span>Available Now!</span></h3> -->
                            <p class="hover-4-description text-uppercase mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor</p>
                        </div>
                    </div>
                </div>
            </div>

<!-- Footer -->
<footer class="text-center text-white footer-content">

<section id="developers" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">The Developers</h5>
        <div class="row">
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{url('/img/profile/candy.jpg')}}" alt="card image"></p>
                                    <h4 class="card-title">Candy Carol Ochea</h4>
                                    <p class="card-text">Responsible for the UI & UX Design</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-3">
                                    <h4 class="card-title">Candy Carol Ochea</h4>
                                    <p class="card-text">-Created the landing page<br>-Added CSS to all the pages<br>-Mobile Responsive<br>-Created the Website layout</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{url('/img/profile/gen.jpg')}}" alt="card image"></p>
                                    <h4 class="card-title">Gen Bongo</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-3">
                                    <h4 class="card-title">Gen Bongo</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{url('/img/profile/ishi.jpg')}}" alt="card image"></p>
                                    <h4 class="card-title">Alex Ishizuka</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-3">
                                    <h4 class="card-title">Alex Ishizuka</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid" src="{{url('/img/profile/arpon.jpg')}}" alt="card image"></p>
                                    <h4 class="card-title">John Joshua Arpon</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-3">
                                    <h4 class="card-title">John Joshua Arpon</h4>
                                    <p class="card-text">LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT SED DO EIUSMOD TEMPOR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Team member -->

        </div>
    </div>
</section>

  <!-- Copyright -->
  <div class="text-left p-3 bottom">
    <div class="row">
        <div class="col-md-6">
            © 2021 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">creamline.com</a>
        </div>

        <div class="col-md-6">
            <img src="{{url('/img/logo/creamline_logo.png')}}" class="text-right float-right footer-logo"/>
        </div>
    </div>
  </div>

   
  <!-- Copyright -->
</footer>
<!-- Footer -->
        </div>
    </body>
</html>
<script>

    $('.lds-roller').delay(1500).queue(function (next) { 
        $(this).css('display', 'block'); 
        next(); 
    });
        
    var preloader = document.getElementsByClassName("preloader")[0];
    var content = document.getElementsByClassName("content");

        $('body').css("overflow", "hidden");
        preloader.addEventListener("animationend", function() {
            $(".content").css("display", "block");
            $(this).delay(1500).queue(function (next) { 
                $(".preloader").css("display", "none");
                $('body').css("overflow", "visible");
            }); 
        });
    
</script>