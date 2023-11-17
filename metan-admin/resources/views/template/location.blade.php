<?php
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
                    <h2>{{__('msg.point')}}</h2>
                </div>
                <div class="col-12">
                    <a href="{{url('/')}}">{{__('msg.home')}}</a>
                    <a href="{{url('location')}}">{{__('msg.location')}}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

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


@endsection
