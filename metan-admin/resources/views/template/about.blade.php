<?php
use Illuminate\Support\Facades\DB;
?>

@extends('layout.main')
@section('content')

    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp
<!-- Page Header Start -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{__('msg.about_us')}}</h2>
            </div>
            <div class="col-12">
                <a href="{{url('/')}}">{{__('msg.home')}}</a>
                <a href="{{url('about')}}">{{__('msg.about_us')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


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



@endsection
