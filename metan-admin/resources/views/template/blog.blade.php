<?php
use \Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
                <h2>{{__('msg.grid')}}</h2>
            </div>
            <div class="col-12">
                <a href="{{url('/')}}">{{__('msg.home')}}</a>
                <a href="{{url('blog')}}">{{__('msg.blog')}}</a>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


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
                                <p>
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
                <div class="row">
                    <div class="col-12">
                        <ul class="pagination justify-content-center">
                            @if ($news->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">{{__('msg.previous')}}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $news->previousPageUrl() }}">{{__('msg.previous')}}</a></li>
                            @endif

                            @for ($i = 1; $i <= $news->lastPage(); $i++)
                                @if ($i == $news->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $news->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor

                            @if ($news->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $news->nextPageUrl() }}">{{__('msg.next')}}</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">{{__('msg.next')}}</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    <!-- Blog End -->

@endsection
