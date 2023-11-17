<?php
use \Illuminate\Support\Facades\DB;
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
                <h2>{{__('msg.service')}}</h2>
            </div>
            <div class="col-12">
                <a href="{{url('/')}}">{{__('msg.home')}}</a>
                <a href="{{url('service')}}">{{__('msg.service')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


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

@endsection
