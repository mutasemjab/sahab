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
  <div class="container">
    <!-- Project Header -->
    <div class="project-header">
      <div class="project-meta">
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
      
      <!-- Optional: Next/Previous project navigation -->
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