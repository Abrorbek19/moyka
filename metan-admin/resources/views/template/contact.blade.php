<?php
use Carbon\Carbon;
?>
@extends('layout.contact')
@section('content')

    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp

    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{__('msg.contact_us')}}</h2>
                </div>
                <div class="col-12">
                    <a href="{{url('/')}}">{{__('msg.home')}}</a>
                    <a href="{{url('contact')}}">{{__('msg.contact')}}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="section-header text-center">
                <p>{{__('msg.touch')}}</p>
                <h2>{{__('msg.query')}}</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    @foreach($information as $info)
                        @php
                            $carModel = \App\Models\Information::find($info->id);
                        @endphp
                    <div class="contact-info">
                        <h2>{{__('msg.quick')}}</h2>
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="contact-info-text">
                                <h3>{{__('msg.open_hour')}}</h3>
                                <p>{{$carModel->getTranslatedAttribute('work_days',$locale,'fallbackLocale')}}</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa fa-phone-alt"></i>
                            </div>
                            <div class="contact-info-text">
                                <h3>{{__('msg.call_us')}}</h3>
                                <p>{{$carModel->getTranslatedAttribute('phone',$locale,'fallbackLocale')}}</p>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="far fa-envelope"></i>
                            </div>
                            <div class="contact-info-text">
                                <h3>{{__('msg.email_us')}}</h3>
                                <p>{{$carModel->getTranslatedAttribute('email',$locale,'fallbackLocale')}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-7">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{'contact_message'}}" method="POST" name="form" id="form" novalidate="novalidate">
                            @csrf
                            <div class="control-group">
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="{{__('msg.name')}}" required="required" data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('msg.email')}}" required="required" data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" id="car_type" name="car_type" placeholder="{{__('msg.car')}}" required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" id="message" name="message" placeholder="{{__('msg.message')}}" required="required" data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>


                            @php
                                $created_at = Carbon::now()->toDateTimeString()
                            @endphp

                            <input type="hidden" class="form-control" name="created_at" id="created_at" value="{{$created_at}}">

                            <div>
                                <button class="btn btn-custom" type="submit" id="sendMessageButton">{{__('msg.send_message')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2998.3560429143995!2d69.23629107663487!3d41.27935500268823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8a60121a4933%3A0x2e06e174eda6444b!2zRGF0YVNpdGUgVGVjaG5vbG9neSAtINCy0LXQsSDRgdGC0YPQtNC40Y8!5e0!3m2!1sru!2s!4v1690793676730!5m2!1sru!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
