<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Spicyo</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('css/home/bootstrap.min.css')}}">
    <!-- owl css -->
    <link rel="stylesheet" href="{{asset('css/home/owl.carousel.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('css/home/style.css') }}">
    <!-- responsive-->
    <link rel="stylesheet" href="{{asset('css/home/responsive.css')}}">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
<!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="{{asset('images/loading.gif')}}" alt="" /></div>
</div>


<div class="wrapper">
    <!-- end loader -->

    <div class="sidebar">
        <!-- Sidebar  -->
        <nav id="sidebar">

            <div id="dismiss">
                <i class="fa fa-arrow-left"></i>
            </div>

            <ul class="list-unstyled components">

                <li class="active">
                    <a href="#">خانه</a>
                </li>
                <li>
                    <a href="#">درباره</a>
                </li>
                <li>
                    <a href="#">دستور پخت</a>
                </li>
                <li>
                    <a href="#">بلاگ</a>
                </li>
                <li>
                    <a href="#"> تماس با ما</a>
                </li>
            </ul>

        </nav>
    </div>

    <div id="content">
        <!-- header -->
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="full">
                            <a class="logo" href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt="#" /></a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="full">
                            <div class="right_header_info">
                                <ul class="list-inline">
                                    @auth('admin')
                                        <li class="list-inline-item">
                                            <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-outline-success custom-button" type="submit">خروج</button>
                                            </form>
                                            <a class="btn btn-outline-success" href="{{route('admin.restaurantCategories.index')}}">پنل ادمین</a>
                                        </li>
                                    @endauth

                                    <!-- Check if a seller is authenticated -->
                                    @auth('seller')
                                        <li class="list-inline-item">
                                            <form id="logout-form-seller" action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-outline-success custom-button" type="submit">خروج</button>
                                            </form>
                                            <a class="btn btn-outline-success" href="">داشبورد فروشنده</a>
                                        </li>
                                    @endauth

                                    @guest('admin')
                                        @guest('seller')
                                            <li class="list-inline-item">
                                                <a class="btn btn-outline-success active" href="{{ route('login.show') }}">ورود</a>
                                                <a class="btn btn-outline-success" href="">ثبت نام فروشندگان</a>
                                            </li>
                                        @endguest
                                    @endguest

                                    <li class="list-inline-item">
                                        <button type="button" class="btn btn-primary" id="sidebarCollapse">
                                            <img src="{{asset('images/menu_icon.png')}}" alt="#" style="height: 20px;">
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success text-center" style="position: absolute; top: 70%; left: 50%; transform: translate(-50%, -50%);" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </header>

        <!-- end header -->
        <!-- start slider section -->
        <div class="slider_section">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div id="main_slider" class="carousel vert slide" data-ride="carousel" data-interval="5000">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="slider_cont">
                                                    <h3>Discover Restaurants<br>That deliver near You</h3>
                                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                                    <a class="main_bt_border" href="#">Order Now</a>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="slider_image full text_align_center">
                                                    <img class="img-responsive" src="images/burger_slide.png" alt="#" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="slider_cont">
                                                    <h3>Discover Restaurants<br>That deliver near You</h3>
                                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                                    <a class="main_bt_border" href="#">Order Now</a>
                                                </div>
                                            </div>
                                            <div class="col-md-7 full text_align_center">
                                                <div class="slider_image">
                                                    <img class="img-responsive" src="images/burger_slide.png" alt="#" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                                    <i class="fa fa-angle-up"></i>
                                </a>
                                <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end slider section -->

        <!-- section -->
        <section class="resip_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ourheading">
                            <h2>Our Recipes</h2>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="owl-carousel owl-theme">

                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs1.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Homemade</h3>
                                            <h4><span class="theme_color">$</span>10</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs2.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Noodles</h3>
                                            <h4><span class="theme_color">$</span>20</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs3.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Egg</h3>
                                            <h4><span class="theme_color">$</span>30</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs4.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Sushi Dizzy</h3>
                                            <h4><span class="theme_color">$</span>40</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs5.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>The Coffee Break</h3>
                                            <h4><span class="theme_color">$</span>50</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs1.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Homemade</h3>
                                            <h4><span class="theme_color">$</span>10</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs2.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Noodles</h3>
                                            <h4><span class="theme_color">$</span>20</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs3.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Egg</h3>
                                            <h4><span class="theme_color">$</span>30</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs4.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>Sushi Dizzy</h3>
                                            <h4><span class="theme_color">$</span>40</h4>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product_blog_img">
                                            <img src="images/rs5.png" alt="#" />
                                        </div>
                                        <div class="product_blog_cont">
                                            <h3>The Coffee Break</h3>
                                            <h4><span class="theme_color">$</span>50</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="bg_bg">
            <!-- about -->
            <div class="about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <i><img src="images/title.png" alt="#"/></i>
                                <h2>About Our Food & Restaurant</h2>
                                <span>It is a long established fact that a reader will be distracted by the readable content of a
                   <br> page when looking at its layout. The point of using Lorem
                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="about_box">
                                <h3>Best Food</h3>
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscureContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard </p>
                                <a href="#">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-10 col-sm-12 about_img_boxpdnt">
                            <div class="about_img">
                                <figure><img src="images/about-img.jpg" alt="#/"></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end about -->

            <!-- blog -->
            <div class="blog">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <i><img src="images/title.png" alt="#"/></i>
                                <h2>Our Blog</h2>
                                <span>when looking at its layout. The point of using Lorem</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                            <div class="blog_box">
                                <div class="blog_img_box">
                                    <figure><img src="images/blog_img1.png" alt="#"/>
                                        <span>02 FEB 2019</span>
                                    </figure>
                                </div>
                                <h3>Spicy Barger</h3>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mar_bottom">
                            <div class="blog_box">
                                <div class="blog_img_box">
                                    <figure><img src="images/blog_img2.png" alt="#"/>
                                        <span>02 FEB 2019</span>
                                    </figure>
                                </div>
                                <h3>Egg & Tosh</h3>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="blog_box">
                                <div class="blog_img_box">
                                    <figure><img src="images/blog_img3.png" alt="#"/>
                                        <span>02 FEB 2019</span>
                                    </figure>
                                </div>
                                <h3>Pizza</h3>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end blog -->

            <!-- Our Client -->
            <div class="Client">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="title">
                                <i><img src="images/title.png" alt="#"/></i>
                                <h2>Our Client</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="Client_box">
                                <img src="images/client.jpg" alt="#"/>
                                <h3>Roock Due</h3>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text.</p>
                                <i><img src="images/client_icon.png" alt="#"/></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Our Client -->
        </div>
        <!-- footer -->
        <fooetr>
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class=" col-md-12">
                            <h2>Request  A<strong class="white"> Call  Back</strong></h2>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                            <form class="main_form">
                                <div class="row">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="Name" type="text" name="Name">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="Email" type="text" name="Email">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="Phone" type="text" name="Phone">
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="textarea" placeholder="Message" type="text" name="Message"></textarea>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <button class="send">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="img-box">
                                <figure><img src="images/img.jpg" alt="img" /></figure>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="footer_logo">
                                <a href="index.html"><img src="images/logo1.jpg" alt="logo" /></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <ul class="lik">
                                <li class="active"> <a href="index.html">Home</a></li>
                                <li> <a href="about.html">About</a></li>
                                <li> <a href="recipe.html">Recipe</a></li>
                                <li> <a href="blog.html">Blog</a></li>
                                <li> <a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="new">
                                <h3>Newsletter</h3>
                                <form class="newtetter">
                                    <input class="tetter" placeholder="Your email" type="text" name="Your email">
                                    <button class="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <div class="container">
                        <p>© 2019 All Rights Reserved. Design by<a href="https://html.design/"> Free Html Templates</a></p>
                    </div>
                </div>
            </div>
        </fooetr>
        <!-- end footer -->

    </div>
</div>
<div class="overlay"></div>
<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script src="js/jquery-3.0.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function() {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
</style>


<script>
    $(document).ready(function() {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 10,
            nav: true,
            loop: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }
        })
    })
</script>

</body>

</html>


