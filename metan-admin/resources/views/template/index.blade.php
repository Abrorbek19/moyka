<?php
use \Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
?>
@extends('layout.main')
@section('content')
@php
    \Illuminate\Support\Facades\App::setLocale($locale)
@endphp
{{--

getTranslatedAttribute('category_name',$locale,'fallbackLocale')
--}}
    <!-- Carousel Start -->
    <div class="carousel">
        <div class="container-fluid">
            <div class="owl-carousel">
                @foreach($carusel as $car)
                    @php
                        $carModel = \App\Models\Carusel::find($car->id);
                    @endphp
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="storage/{{$carModel->image}}" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h3>{{$carModel->getTranslatedAttribute('category_name',$locale,'fallbackLocale')}}</h3>
                            <h1>{{$carModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h1>
                            <p>
                                {{$carModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                            </p>
                            <a class="btn btn-custom" href="">{{ __('msg.explore_more') }}</a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    @foreach($about as $img)
                    <div class="about-img">
                        <img src="storage/{{$img->image}}" alt="Image">
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    @php
                        $category = DB::table('category')->where(['category'=>'about'])->get();
                    @endphp
                    @foreach($category as $cat)
                        @php
                            $categ = \App\Models\Category::find($cat->id);
                        @endphp
                    <div class="section-header text-left">
                        <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                        <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                    </div>
                    @endforeach
                    <div class="about-content">
                        @foreach($about as $a)
                            @php
                                $abot = \App\Models\About::find($a->id);
                            @endphp
                        <p>
                            {{$abot->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                        </p>
                        @endforeach
                        <ul>
                            @foreach($items as $item)
                                @php
                                    $it = \App\Models\Items::find($item->id);
                                @endphp
                            <li>
                                <i class="{{$it->icon}}"></i>
                                {{$it->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                            </li>
                            @endforeach
                        </ul>
                        <a class="btn btn-custom" href="">{{ __('msg.learn_more') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    @php
        $service = DB::table('service')->where(['category'=>'service'])->get();
        $category = DB::table('category')->where(['category'=>'service'])->get();
    @endphp

    <!-- Service Start -->
    <div class="service">
        <div class="container">
            @foreach($category as $cat)
                @php
                    $categ = \App\Models\Category::find($cat->id);
                @endphp
                <div class="section-header text-center">
                    <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                    <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                </div>
            @endforeach
            <div class="row">
                @foreach($service as $ser)
                    @php
                        $categ = \App\Models\Service::find($ser->id);
                    @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="service-item">
                        <i class="{{$ser->image}}"></i>
                        <h3>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                        <p>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

    @php
        $service = DB::table('service')->where(['category'=>'calculate'])->get();
    @endphp
    <!-- Facts Start -->
    <div class="facts" data-parallax="scroll" data-image-src="./assets/img/facts.jpg">
        <div class="container">
            <div class="row">
                @foreach($service as $icon)
                    @php
                        $categ = \App\Models\Service::find($icon->id);
                    @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="facts-item">
                        <i class="{{$icon->image}}"></i>
                        <div class="facts-text">
                            <h3 data-toggle="counter-up">{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                            <p>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Facts End -->

@php
$price = DB::table('category')->where(['category'=>'price'])->get();
@endphp
    <!-- Price Start -->
    <div class="price">
        <div class="container">
            @foreach($price as $p)
                @php
                    $categ = \App\Models\Category::find($p->id);
                @endphp
                <div class="section-header text-center">
                    <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                    <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                </div>
            @endforeach
            <div class="row">

                @php
                    $list = ['basic' => 'basic', 'complex' => 'complex', 'premium' => 'premium'];
                @endphp

                @foreach($list as $category => $categoryName)
                    @php
                        $basic = DB::table('items')->where('category', $category)->get();
                        $price = DB::table('price')->where('category', $category)->get();
                        $complex = ($category === 'complex');
                    @endphp

                    @foreach($price as $pr)
                        @php
                            $pri = \App\Models\Price::find($pr->id);
                        @endphp
                        <div class="col-md-4">
                            <div class="price-item {{ $complex ? ' featured-item' : '' }}">
                                <div class="price-header">
                                    <h3>{{$pri->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                                    <h2>
                                        <span>{{$pri->getTranslatedAttribute('icon',$locale,'fallbackLocale')}}</span>
                                        <strong>{{$pri->getTranslatedAttribute('basic_money',$locale,'fallbackLocale')}}</strong>
                                        <span>{{$pri->getTranslatedAttribute('addition_money',$locale,'fallbackLocale')}}</span>
                                    </h2>
                                </div>
                                <div class="price-body">
                                    <ul>
                                        @foreach($basic as $bas)
                                            @php
                                                $it = \App\Models\Items::find($bas->id);
                                            @endphp
                                            <li>
                                                <i class="{{$it->icon}}"></i>
                                                {{$it->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="price-footer">
                                    <a class="btn btn-custom" href="{{url('contact')}}">
                                        {{ __('msg.book_now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>
    <!-- Price End -->
    @php
        $loc = DB::table('category')->where(['category'=>'location'])->get();
    @endphp

    <!-- Location Start -->
    <div class="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    @foreach($loc as $l)
                        @php
                            $categ = \App\Models\Category::find($l->id);
                        @endphp
                        <div class="section-header text-left">
                            <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                            <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                        </div>
                    @endforeach
                    <div class="row">
                        @foreach($location as $locat)
                            @php
                                $categ = \App\Models\Location::find($locat->id);
                            @endphp
                        <div class="col-md-6">
                            <div class="location-item">
                                <i class="{{$locat->icon}}"></i>
                                <div class="location-text">
                                    <h3>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                                    <p>{{$categ->getTranslatedAttribute('address',$locale,'fallbackLocale')}}</p>
                                    <p><strong>{{__('msg.call')}}:</strong>{{$locat->phone}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="location-form">
                        <h3>{{ __('msg.request') }}</h3>
                        <form method="POST" id="form" action="{{url('message')}}">
                            @csrf
                            <div class="control-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="{{__('msg.name')}}" />
                            </div>
                            <div class="control-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="{{__('msg.email')}}"  />
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="text" name="text" placeholder="{{__('msg.description')}}"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-custom" id="submit" type="submit">{{ __('msg.sent') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location End -->

    @php
        $teamm = DB::table('category')->where(['category'=>'team'])->get();
    @endphp

    <!-- Team Start -->
    <div class="team">
        <div class="container">
            @foreach($teamm as $t)
                @php
                    $categ = \App\Models\Category::find($t->id);
                @endphp
                <div class="section-header text-center">
                    <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                    <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                </div>
            @endforeach
            <div class="row">
                @foreach($team as $tea)
                    @php
                        $categ = \App\Models\Team::find($tea->id);
                    @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="storage/{{$tea->image}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{$categ->getTranslatedAttribute('name',$locale,'fallbackLocale')}}</h2>
                            <p>{{$categ->getTranslatedAttribute('job',$locale,'fallbackLocale')}}</p>
                            <div class="team-social">
                                <a href=""><i class="fab fa-telegram"></i></a>
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

@php
    $client = DB::table('category')->where(['category'=>'client'])->get();
@endphp
    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            @foreach($client as $cli)
                @php
                    $categ = \App\Models\Category::find($cli->id);
                @endphp
                <div class="section-header text-center">
                    <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                    <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                </div>
            @endforeach
            <div class="owl-carousel testimonials-carousel">
                @foreach($commentary as $com)
                    @php
                        $categ = \App\Models\ClientComment::find($com->id);
                    @endphp
                <div class="testimonial-item">
                    <img src="storage/{{$com->image}}" alt="Image">
                    <div class="testimonial-text">
                        <h3>{{$categ->getTranslatedAttribute('name',$locale,'fallbackLocale')}}</h3>
                        <h4>{{$categ->getTranslatedAttribute('job',$locale,'fallbackLocale')}}</h4>
                        <p>
                            {{$categ->getTranslatedAttribute('comment',$locale,'fallbackLocale')}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    @php
        $blog = DB::table('category')->where(['category'=>'blog'])->get();
    @endphp

    <!-- Blog Start -->
    <div class="blog">
        <div class="container">
            @foreach($blog as $blo)
                @php
                    $categ = \App\Models\Category::find($blo->id);
                @endphp
                <div class="section-header text-center">
                    <p>{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                    <h2>{{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</h2>
                </div>
            @endforeach
            <div class="row">
                @foreach($news as $new)
                    @php
                        $categ = \App\Models\News::find($new->id);
                    @endphp
                <div class="col-lg-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="storage/{{$new->image}}" alt="Image">
                            <div class="meta-date">
                                <span>{{ Carbon::parse($new->date)->format('d')}}</span>
                                @php
                                    // $new->date sifatida berilgan sanani olish
                                     $dateFromBackend = $new->date;

                                     // Tilni aniqlash uchun sessiondan yoki boshqa joydan tilni olish
                                     $locale = Session::get('locale', 'uz');

                                     // Sanani Carbon obyektiga o'girib turish
                                     $carbonDate = Carbon::parse($dateFromBackend);

                                     // Oy raqamini olish
                                     $monthNumber = $carbonDate->format('n');

                                     // Oy nomlarini lug'atdan olish
                                 //  $months = ($locale == 'uz') ? __('month') : __('month', [], 'en');
        $months = ($locale == 'uz') ? __('month') : ($locale == 'ru' ? __('month', [], 'ru') : __('month', [], 'en'));



                                     // Oy nomini chiqarish
                                     $monthName = $months[$monthNumber];

                                @endphp
                                <strong>{{$monthName}}</strong>

                                <span>{{Carbon::parse($new->date)->format('Y')}}</span>
                            </div>
                        </div>
                        <div class="blog-text">
                            <h3>
                                <a href="{{url('single',$new->id)}}">
                                    {{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                </a>
                            </h3>
                            <p style="overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;">
                                <a href="{{url('single',$new->id)}}">
                                    {{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                </a>
                            </p>
                        </div>
                        <div class="blog-meta">
                            <p><i class="fa fa-user"></i><a href="">{{$categ->getTranslatedAttribute('person',$locale,'fallbackLocale')}}</a></p>
                            <p><i class="fa fa-folder"></i><a href="">{{$categ->getTranslatedAttribute('category_name',$locale,'fallbackLocale')}}</a></p>
                            <p>
                                <i class="fa fa-comments"></i>
                                <a href="">
                                    @php
                                        $comment_count = DB::table('comment')->where('single_id',$new->id)->count();
                                    @endphp
                                    {{$comment_count}} {{ __('msg.comment') }}
                                </a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Blog End -->


@endsection

