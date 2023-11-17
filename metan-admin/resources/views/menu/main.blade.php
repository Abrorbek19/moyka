<?php
use Illuminate\Support\Facades\Session;
?>
@if(!isset($innerLoop))
    <ul class="nav navbar-nav">
@else
            <ul class="dropdown-menu">
@endif

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }



@endphp
{{--    <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>--}}
@foreach ($items as $item)

    @php

        $originalItem = $item;
        if (Voyager::translatable($item)) {
        //      $item = $item->translate($options->locale);
                $locale = Session::get('locale', 'uz'); // Agar til ma'lum bo'lmasa, default sifatida "en" tilini qo'llaymiz
                $item = $item->translate($locale);
        }

        $listItemClass = null;
        $linkAttributes =  null;
        $styles = null;
        $icon = null;
        $caret = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // With Children Attributes
        if(!$originalItem->children->isEmpty()) {
            $linkAttributes =  'class="dropdown-toggle" data-toggle="dropdown"';
            $caret = '<span class="caret"></span>';

            if(url($item->link()) == url()->current()){
                $listItemClass = 'dropdown active';
            }else{
                $listItemClass = 'dropdown';
            }
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }

    @endphp
     <li class="{{ $listItemClass }}">
        <a href="{{ url($item->link()) }}" class="nav-item nav-link  {{ Request::is($item->link()) ? 'active' : '' }}" target="{{ $item->target }}" style="{{ $styles }}" {!! $linkAttributes ?? '' !!}>
            {!! $icon !!}

             {{ $item->title }}

            {!! $caret !!}
        </a>

        @if(!$originalItem->children->isEmpty())
        @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
        @endif
     </li>
@endforeach
    </ul>
</ul>
