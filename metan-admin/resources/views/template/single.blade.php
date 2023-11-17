<?php
use Carbon\Carbon;
?>
@extends('layout.single')
@section('content')

    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp
    <body>

        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{__('msg.detail_page')}}</h2>
                    </div>
                    <div class="col-12">
                        <a href="{{url('/')}}">{{__('msg.home')}}</a>
                        <a href="{{url('blog')}}">{{__('msg.detail')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Single Post Start-->
        <div class="single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @foreach($news as $new)
                            @php
                                $categ = \App\Models\News::find($new->id);
                            @endphp
                        <div class="single-content">
                            <img src="../storage/{{$new->image}}" />
                            {!!$categ->getTranslatedAttribute('content',$locale,'fallbackLocale')!!}
                        </div>
                        @endforeach
                        <div class="single-related">
                            <h2>{{__('msg.related_post')}}</h2>
                            <div class="owl-carousel related-slider">
                                @foreach($post as $po)
                                    @php
                                        $categ = \App\Models\News::find($po->id);
                                    @endphp
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="../storage/{{$po->image}}" />
                                    </div>
                                    <div class="post-text">
                                        <a href="{{url('single',$po->id)}}">{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a>
                                        <div class="post-meta">
                                            <p>{{__('msg.by')}} <a>{{$categ->getTranslatedAttribute('person',$locale,'fallbackLocale')}}</a></p>
                                            <p>{{__('msg.in')}} <a>{{$categ->getTranslatedAttribute('category_name',$locale,'fallbackLocale')}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="single-comment">
                            <h2>{{$comment_count}} {{ __('msg.comment') }}</h2>
                            <ul class="comment-list">
                                @foreach($comment as $title)
                                <li class="comment-item">
                                    <div class="comment-body">
                                        <div class="comment-text">
                                            <h3>{{$title->name}}</h3>
                                            <p>
                                                {{$title->comment}}
                                            </p>

                                            <span>{{ Carbon::parse($title->created_at)->format('d F Y H:i A') }}</span>

                                            @csrf
                                            @php
                                                $created_at = Carbon::now()->toDateTimeString();

                                            $like = \Illuminate\Support\Facades\DB::table('like')->where('comment_id',$title->id)->count();
                                            @endphp


                                            <input type="hidden" class="form-control" name="created" id="created" value="{{$created_at}}">


                                            <button class="btn like-button" name="comment_id" data-comment-id="{{$title->id}}">
                                                <i class="fa-regular fa-heart"></i>
                                            </button>
                                            <h6 class="like_count" data-comment-id="{{$title->id}}" style="display: inline-block; margin-left: 10px;">
                                                {{$like}}
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="comment-form">
                            <h2>{{__('msg.leave_comment')}}</h2>
                            <form method="POST" id="form" action="{{'comment'}}">
                                @csrf

                                @foreach($news as $id)
                                    <input type="hidden" class="form-control" name="single_id" id="single_id" value="{{$id->id}}">
                                @endforeach
                                <div class="form-group">
                                    <label for="name">{{__('msg.name')}} *</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>

                                <div class="form-group">
                                    <label for="comment">{{__('msg.message')}} *</label>
                                    <textarea id="comment" name="comment" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                @php
                                 $created_at = Carbon::now()->toDateTimeString()
                                       // $created_at = Carbon::now()->format('Y-m-d H:i:s');
                                @endphp

                                <input type="hidden" class="form-control" name="created_at" id="created_at" value="{{$created_at}}">

                                <div class="form-group">
                                    <input type="submit" value="{{__('msg.post_comment')}}" class="btn btn-custom">
                                </div>
                            </form>
                        </div>
                    </div>


                   @foreach($news as $author_id)
{{--                       <h1>{{$author_id->id}}</h1>--}}
                       @php
                           $author = \App\Models\News::where('id', $author_id->id)->get();
                       @endphp
                   @endforeach
                    @foreach($author as $person)
{{--                        <h1>{{$person->person}}</h1>--}}
                        @php
                            $person_id = \App\Models\Author::where('name', $person->person)->get();
                        @endphp
                    @endforeach

                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar-widget">
                                @foreach($person_id as $aut)
                                    @php
                                        $categ = \App\Models\Author::find($aut->id);
                                    @endphp
                                    <div class="single-bio">
                                        <div class="single-bio-img">
                                            <img src="../storage/{{$aut->image}}" />
                                        </div>
                                        <div class="single-bio-text">
                                            <h3>{{$categ->getTranslatedAttribute('name',$locale,'fallbackLocale')}}</h3>
                                            <p>
                                                {{$categ->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                            </p>
                                        </div>
                                        <div class="single-bio-social">
                                            <a class="btn" href="{{$aut->telegram_link}}"><i class="fab fa-telegram"></i></a>
                                            <a class="btn" href="{{$aut->twitter_link}}"><i class="fab fa-twitter"></i></a>
                                            <a class="btn" href="{{$aut->facebook_link}}"><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn" href="{{$aut->youtube_link}}"><i class="fab fa-youtube"></i></a>
                                            <a class="btn" href="{{$aut->instagram_link}}"><i class="fab fa-instagram"></i></a>
                                            <a class="btn" href="{{$aut->linkedin_link}}"><i class="fab fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="sidebar-widget">
                                <div class="search-widget">
                                    <form>
                                        <input class="form-control" type="text" placeholder="Search Keyword">
                                        <button class="btn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>

                            <div class="sidebar-widget">
                                <h2 class="widget-title">{{__('msg.recent_post')}}</h2>
                                <div class="recent-post">
                                    @foreach($posts as $pot)
                                        @php
                                            $categ = \App\Models\News::find($pot->id);
                                        @endphp
                                    <div class="post-item">
                                        <div class="post-img">
                                            <img src="../storage/{{$pot->image}}" />
                                        </div>
                                        <div class="post-text">
                                            <a href="{{url('single',$pot->id)}}">{{$categ->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a>
                                            <div class="post-meta">
                                                <p>{{__('msg.by')}}<a>{{$categ->getTranslatedAttribute('person',$locale,'fallbackLocale')}}</a></p>
                                                <p>{{__('msg.in')}}<a>{{$categ->getTranslatedAttribute('category_name',$locale,'fallbackLocale')}}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Post End-->

    </body>
@endsection
