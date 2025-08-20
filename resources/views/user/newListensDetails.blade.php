@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('newListen.index') }}" class="active">{{ __('front.listen_sessions') }}</a>
  </div>
</div>


 <div class="project-content">
    <h3>{{ $newListen->title }}</h3>
    <p>{{ $newListen->description }}</p>
</div>
@endsection