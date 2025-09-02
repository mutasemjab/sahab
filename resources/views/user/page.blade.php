@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ $page->localized_title }}</a>
  </div>
</div>


<div class="project-content" style="padding:40px; min-height:400px; border-radius:16px;width: 50%; line-height:1.8; color:#065f46; text-align:right;">
    <h3 style="font-size:28px; margin-bottom:20px; color:#065f46;">
       {{ $page->localized_title }}
    </h3>
    <p style="margin-bottom:16px; font-size:18px;">
        {!! $page->localized_description !!}
    </p>
</div>

@endsection
