<!doctype html>
<html lang="{{$locale}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{  setting('site.title') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="{{ Voyager::image( setting('site.logo') ) }}" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template Stylesheet -->
    <link href="<?=asset('assets/css/style.css')?>" rel="stylesheet">
</head>
<body>
@php
    $information = \Illuminate\Support\Facades\DB::table('information')->get();
    \Illuminate\Support\Facades\App::setLocale($locale)
@endphp

<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        @foreach($information as $inf)
            @php
                $carModel = \App\Models\Information::find($inf->id);
            @endphp
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <h1>
                            {{$carModel->getTranslatedAttribute('name',$locale,'fallbackLocale')}}
{{--                            <span>--}}
{{--                                Wash--}}
{{--                            </span>--}}
                        </h1>
                        <!-- <img src="./assets/img/logo.jpg" alt="Logo"> -->
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-7 d-none d-lg-block">
                <div class="row" style="align-items: center;">
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>{{ __('msg.open_hour')}}</h3>
                                <p>
                                    {{$carModel->getTranslatedAttribute('work_days',$locale,'fallbackLocale')}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="fa fa-phone-alt"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>{{ __('msg.call_us') }}</h3>
                                <p>
                                    {{$carModel->getTranslatedAttribute('phone',$locale,'fallbackLocale')}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="top-bar-item">
                            <div class="top-bar-icon">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="top-bar-text">
                                <h3>{{ __('msg.email_us') }}</h3>
                                <p>
                                    {{$carModel->getTranslatedAttribute('email',$locale,'fallbackLocale')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Top Bar End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <a href="{{url('/')}}" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    {{--Header menu--}}

                        {{menu('Header','menu/main')}}

                    {{--end menu url{{resource/views/menu/main}}}--}}

{{--                    <a href="{{ url('about') }}" class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">About</a>--}}
                </div>
                <div class="ml-auto">
                    <a class="btn btn-custom" href="{{url('contact')}}">{{ __('msg.get') }}</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->


@yield('content')



<!-- Footer Start -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-contact">
                    <h2>{{ __('msg.touch') }}</h2>
                    @foreach($information as $foot)
                        @php
                            $carModel = \App\Models\Information::find($foot->id);
                        @endphp
                    <p><i class="fa fa-map-marker-alt"></i>{{$carModel->getTranslatedAttribute('address',$locale,'fallbackLocale')}}</p>
                    <p><i class="fa fa-phone-alt"></i>{{$carModel->getTranslatedAttribute('phone',$locale,'fallbackLocale')}}</p>
                    <p><i class="fa fa-envelope"></i>{{$carModel->getTranslatedAttribute('email',$locale,'fallbackLocale')}}</p>
                    <div class="footer-social">
                        <a class="btn" href="{{$foot->twitter_link}}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="btn" href="{{$foot->facebook_link}}">
                            <i class="fab fa-facebook-f"></i>
                        </a>
{{--                        <a class="btn" href="{{$foot->youtube_link}}">--}}
{{--                            <i class="fab fa-youtube"></i>--}}
{{--                        </a>--}}
{{--                        <a class="btn" href="{{$foot->telegram_link}}">--}}
{{--                            <i class="fab fa-telegram"></i>--}}
{{--                        </a>--}}
                        <a class="btn" href="{{$foot->instagram_link}}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="btn" href="{{$foot->linkedin_link}}">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-link">
                    <h2>{{__('msg.popular')}}</h2>
                    <a href="{{url('about')}}">{{__('msg.about_us')}}</a>
                    <a href="{{url('contact')}}">{{__('msg.contact_us')}}</a>
                    <a href="{{url('service')}}">{{__('msg.our_service')}}</a>
                    <a href="{{url('location')}}">{{__('msg.service_points')}}</a>
                    <a href="{{url('price')}}">{{__('msg.pricing_plan')}}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-link">
                    <h2>{{__('msg.useful')}}</h2>
                    <a href="">{{__('msg.terms')}}</a>
                    <a href="">{{__('msg.policy')}}</a>
                    <a href="">{{__('msg.cookies')}}</a>
                    <a href="">{{__('msg.help')}}</a>
                    <a href="">{{__('msg.faq')}}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-newsletter">
                    <h2>{{__('msg.newsletter')}}</h2>

                    <form action="{{'news_email'}}" method="POST" name="news_form" id="news_form">
                        @csrf
                        <input class="form-control" name="full_name" id="full_name" placeholder="{{__('msg.name')}}">
                        <input class="form-control"  name="email" id="news_email" placeholder="{{__('msg.email')}}">
                        <button class="btn btn-custom" type="submit">{{__('msg.submit')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
{{--    <div class="container copyright">--}}
{{--        <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved. Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>--}}
{{--    </div>--}}
</div>
<!-- Footer End -->

<!-- Back to top button -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- Pre Loader -->
<div id="loader" class="show">
    <div class="loader"></div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>

<!-- Contact Javascript File -->

<!-- Template Javascript -->
<script src="<?=asset('assets/js/main.js')?>"></script>
<script src="<?=asset('assets/js/order.js')?>"></script>

<script src="<?=asset('assets/js/news_email.js')?>"></script>
</body>
</html>
