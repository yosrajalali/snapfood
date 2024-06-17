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

    <!-- Leaflet CSS for the map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        #map { width: 100%; height: 400px; }
    </style>
</head>
<!-- body -->

<body class="main-layout">
<!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="{{asset('images/loading.gif')}}" alt="" /></div>
</div>

<div class="wrapper">
    <!-- end loader -->

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
                                            <a class="btn btn-outline-success" href="{{route('admin.foodCategories.index')}}">پنل ادمین</a>
                                        </li>
                                    @endauth

                                    <!-- Check if a seller is authenticated -->
                                    @auth('seller')
                                        <li class="list-inline-item">
                                            <form id="logout-form-seller" action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-outline-success custom-button" type="submit">خروج</button>
                                            </form>
                                            <a class="btn btn-outline-success" href="{{route('seller.recentOrders')}}">داشبورد فروشنده</a>
                                        </li>
                                    @endauth

                                    @guest('admin')
                                        @guest('seller')
                                            <li class="list-inline-item">
                                                <a class="btn btn-outline-success active" href="{{ route('login.show') }}">ورود</a>
                                                <a class="btn btn-outline-success" href="{{route('seller.showRegister')}}">ثبت نام فروشندگان</a>
                                            </li>
                                        @endguest
                                    @endguest

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
                                                    <h3> رستورانهای نزدیکتان را<br>پیدا کنید</h3>
                                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                                    <button type="button" class="main_bt_border bg-success" data-toggle="modal" data-target="#locationModal">آدرس انتخابی</button>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="slider_image full text_align_center">
                                                    <img class="img-responsive" src="images/burger_slide.png" alt="#" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end slider section -->

        <!-- Modal -->
        <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="locationModalLabel">انتخاب آدرس</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container mx-auto px-4 py-6">
                            <h1 class="text-4xl font-bold text-center text-gray-800 mb-1">جستجوی رستوران‌های نزدیک</h1>
                            <div class="mb-1">
                                <label for="city" class="block text-gray-700">شهر خود را انتخاب کنید:</label>
                                <select id="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                                    <option value="" disabled selected>انتخاب شهر</option>

                                </select>
                            </div>
                            <div id="map"></div>
                            <form id="locationForm" method="POST" action="{{ route('search-restaurants') }}">
                                @csrf
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <button type="submit" class="bg-success dark:hover:bg-gray-200 text-white font-bold py-2 px-4 rounded mt-4">جستجوی رستوران‌های نزدیک</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

<!-- Scripts for the modal map -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var map;
    $('#locationModal').on('shown.bs.modal', function () {
        if (!map) {
            map = L.map('map').setView([35.6892, 51.3890], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([35.6892, 51.3890], { draggable: true }).addTo(map);
            var updating = false;

            function updateMarker(lat, lon, updateMap = true) {
                if (updating) return;
                updating = true;
                marker.setLatLng([lat, lon]);
                if (updateMap) {
                    map.setView([lat, lon], 12);
                }
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;
                setTimeout(() => updating = false, 200); // To prevent infinite loop
            }

            $('#city').on('change', function () {
                var selectedOption = $(this).find('option:selected');
                var lat = parseFloat(selectedOption.data('lat'));
                var lon = parseFloat(selectedOption.data('lon'));
                console.log('Selected city:', selectedOption.text());
                console.log('Coordinates:', lat, lon);
                if (!isNaN(lat) && !isNaN(lon)) {
                    updateMarker(lat, lon);
                } else {
                    console.error('Invalid coordinates for the selected city.');
                    alert('مختصات معتبر برای شهر انتخاب شده وجود ندارد.');
                }
                $(this).select2('close');
            });

            map.on('moveend', function () {
                if (updating) return;
                var center = map.getCenter();
                updateMarker(center.lat, center.lng, false);
            });

            marker.on('dragend', function () {
                var latLng = marker.getLatLng();
                updateMarker(latLng.lat, latLng.lng, false);
            });

            async function fetchCities() {
                try {
                    const response = await fetch('https://iran-locations-api.ir/api/v1/fa/cities');
                    const data = await response.json();
                    console.log('Fetched cities:', data);
                    const citySelect = $('#city');
                    data.forEach(city => {
                        if (city.latitude && city.longitude) {
                            const option = $('<option></option>')
                                .val(city.name)
                                .data('lat', city.latitude)
                                .data('lon', city.longitude)
                                .text(city.name);
                            citySelect.append(option);
                        } else {
                            console.error('Invalid coordinates for city:', city.name);
                        }
                    });
                } catch (error) {
                    console.error('Error fetching cities:', error);
                }
            }
            fetchCities();
        } else {
            setTimeout(function() {
                map.invalidateSize();
            }, 10);
        }
    });
</script>

</body>

</html>
