@extends('layouts.front')

@section('content')

<div class="mutasem-error-page">
  <h1 class="mutasem-error-code">404</h1>
  <h2 class="mutasem-error-title">حدث خطأ ما</h2>
  <p class="mutasem-error-text">عذرًا، لا يمكننا العثور على الصفحة التي تبحث عنها.</p>
  <a href="{{route('home')}}" class="mutasem-error-button">العودة إلى الصفحة الرئيسية</a>
</div>

@endsection