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
                <h2>{{__('msg.plan')}}</h2>
            </div>
            <div class="col-12">
                <a href="{{url('/')}}">{{__('msg.home')}}</a>
                <a href="{{url('price')}}">{{__('msg.price')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

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

@endsection
