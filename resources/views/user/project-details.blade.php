@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="{{ route('home') }}">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{route('projects')}}">{{ __('front.projects') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <span class="active">{{ $locale == 'ar' ? $project->title_ar : $project->title_en }}</span>
  </div>
</div>

<section class="project-details-section">
  <style>
    .project-details-section{padding:32px 0}
    .project-details-section .container{max-width:1100px;margin:0 auto;padding:0 16px}
    .project-header{margin-bottom:24px}
    .project-meta{display:flex;gap:12px;flex-wrap:wrap;align-items:center;margin-bottom:8px}
    .project-status{display:inline-flex;align-items:center;gap:8px;padding:6px 12px;border-radius:999px;font-size:14px;font-weight:600;border:1px solid #e6e6e6;color:#065f46;background:#f2fbf8}
    .project-status.completed{background:#e8f5ee;color:#065f46;border-color:#cfe8db}
    .project-status.ongoing{background:#fff6e9;color:#a15b00;border-color:#ffe2b8}
    .project-status.planned{background:#f5f7fa;color:#39424e;border-color:#e3e8ef}
    .project-time{font-size:14px;color:#555}
    .project-title{margin:0;font-size:32px;line-height:1.3;color:#111}
    .project-image{margin:20px 0;border-radius:16px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,.06)}
    .project-image img{width:100%;height:auto;display:block}
    .project-content{margin-top:24px}
    .project-description h2{margin:0 0 10px;font-size:22px;color:#065f46}
    .project-description .description-text{font-size:16px;line-height:1.9;color:#333;background:#fff;border:1px solid #eee;border-radius:12px;padding:16px}
    .project-details-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin-top:20px}
    .detail-card{display:flex;gap:12px;background:#fff;border:1px solid #eee;border-radius:14px;padding:16px;box-shadow:0 4px 14px rgba(0,0,0,.04)}
    .detail-icon{flex:0 0 44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:#f0f7f4;color:#065f46;font-size:18px}
    .detail-content h3{margin:0 0 6px;font-size:18px;color:#111}
    .detail-content p{margin:0 0 6px;font-size:15px;color:#444;line-height:1.7}
    .detail-content small{color:#666}
    .project-navigation{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:28px}
    .btn.btn-outline{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border:2px solid #065f46;color:#065f46;background:#fff;border-radius:10px;font-weight:600;text-decoration:none;transition:.25s}
    .btn.btn-outline:hover{background:#065f46;color:#fff}
    .project-nav-arrows{display:flex;gap:8px;align-items:center}
    .nav-arrow{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border:1px solid #e6e6e6;border-radius:10px;color:#222;text-decoration:none;background:#fff;transition:.25s}
    .nav-arrow:hover{box-shadow:0 6px 18px rgba(0,0,0,.06);transform:translateY(-1px)}
    @media (max-width:992px){
      .project-title{font-size:28px}
    }
    @media (max-width:768px){
      .project-details-grid{grid-template-columns:1fr}
      .project-title{font-size:24px}
      .detail-card{padding:14px}
      .project-meta{gap:8px}
    }
  </style>

  <div class="container">
    <!-- Project Header -->
    <div class="project-header">
      <div class="project-meta">
          <!--
        <span class="project-status 
          @if($project->type == 1) completed
          @elseif($project->type == 2) ongoing
          @else planned
          @endif">
          @if($project->type == 1)
            {{ __('front.completed') }}
          @elseif($project->type == 2)
            {{ __('front.ongoing') }}
          @else
            {{ __('front.planned') }}
          @endif
        </span>
        -->
        @if($project->time)
          <span class="project-time">{{ __('front.starting_from') }}: {{ $project->time }}</span>
        @endif
      </div>
      <h1 class="project-title">{{ $locale == 'ar' ? $project->title_ar : $project->title_en }}</h1>
    </div>

    <!-- Project Image -->
    <div class="project-image">
      <img src="{{ asset('assets/admin/uploads/' . $project->photo) }}" alt="{{ $locale == 'ar' ? $project->title_ar : $project->title_en }}">
    </div>

    <!-- Project Content -->
    <div class="project-content">
      <div class="project-description">
        <h2>{{ __('front.project_description') }}</h2>
        <div class="description-text">
          {!! $locale == 'ar' ? $project->description_ar : $project->description_en !!}
        </div>
      </div>

      <!-- Project Details Grid -->
      <div class="project-details-grid">
        <div class="detail-card">
          <div class="detail-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="detail-content">
            <h3>{{ __('front.project_timeline') }}</h3>
            <p>
              @if($project->type == 1)
                {{ __('front.completed_project') }}
              @elseif($project->type == 2)
                {{ __('front.ongoing_project') }}
              @else
                {{ __('front.planned_project') }}
              @endif
            </p>
            @if($project->time)
              <small>{{ __('front.start_date') }}: {{ $project->time }}</small>
            @endif
          </div>
        </div>

        <div class="detail-card">
          <div class="detail-icon">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="detail-content">
            <h3>{{ __('front.project_status') }}</h3>
            <p>
              @if($project->type == 1)
                {{ __('front.project_completed_desc') }}
              @elseif($project->type == 2)
                {{ __('front.project_ongoing_desc') }}
              @else
                {{ __('front.project_planned_desc') }}
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="project-navigation">
      <a href="{{ route('projects') }}" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i>
        {{ __('front.back_to_projects') }}
      </a>
      
      <div class="project-nav-arrows">
        @php
          $prevProject = \App\Models\Projects::where('id', '<', $project->id)->orderBy('id', 'desc')->first();
          $nextProject = \App\Models\Projects::where('id', '>', $project->id)->orderBy('id', 'asc')->first();
        @endphp
        
        @if($prevProject)
          <a href="{{ route('projects.show', $prevProject->id) }}" class="nav-arrow prev" title="{{ __('front.previous_project') }}">
            <i class="fas fa-chevron-left"></i>
            <span>{{ __('front.previous') }}</span>
          </a>
        @endif
        
        @if($nextProject)
          <a href="{{ route('projects.show', $nextProject->id) }}" class="nav-arrow next" title="{{ __('front.next_project') }}">
            <span>{{ __('front.next') }}</span>
            <i class="fas fa-chevron-right"></i>
          </a>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection