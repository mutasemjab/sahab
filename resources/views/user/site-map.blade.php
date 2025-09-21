@extends('layouts.front')

@section('content')
<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">الرئيسية</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">خريطة الموقع</a>
  </div>
</div>

<div class="mutasem-quicklinks-section">
  <ul class="mutasem-quicklinks-list">
    <li class="main-link"><a href="#">رابط الصفحة</a>
      <ul>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a>
          <ul>
            <li class="sub-link"><a href="#">رابط الصفحة الفرعية الفرعية</a>
              <ul>
                <li class="sub-link"><a href="#">رابط الصفحة الفرعية الفرعية الفرعية</a></li>
              </ul>
            </li>
            <li class="sub-link"><a href="#">رابط الصفحة الفرعية الفرعية</a></li>
          </ul>
        </li>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
      </ul>
    </li>

    <li class="main-link"><a href="#">رابط الصفحة</a>
      <ul>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
      </ul>
    </li>

    <li class="main-link"><a href="#">رابط الصفحة</a>
      <ul>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
      </ul>
    </li>

    <li class="main-link"><a href="#">رابط الصفحة</a>
      <ul>
        <li class="sub-link"><a href="#">رابط الصفحة الفرعية</a></li>
      </ul>
    </li>
  </ul>
</div>

<style>
.mutasem-quicklinks-list{
  list-style:none;
  margin:0;
  padding:0;
  direction:rtl;
  text-align:right;
}
.mutasem-quicklinks-list li{
  margin:6px 0;
  font-size:15px;
  line-height:1.6;
}
.mutasem-quicklinks-list a{
  color:#065f46;
  text-decoration:none;
}
.mutasem-quicklinks-list a:hover{
  text-decoration:underline;
}
.mutasem-quicklinks-list .main-link{
  list-style-type:disc; /* ● */
  font-weight:600;
}
.mutasem-quicklinks-list .sub-link{
  list-style-type:circle; /* ○ */
  font-weight:400;
}
.mutasem-quicklinks-list ul{
  list-style:inherit;
  margin:4px 0 4px 0;
  padding-right:20px;
}
</style>


@endsection