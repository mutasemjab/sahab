@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.projects') }}</a>
  </div>
</div>

<section class="projects-section">
  <div class="container">
    <h2 class="section-title">{{ __('front.projects') }}</h2>
    <p class="section-description">{{ __('front.projects_description') }}</p>

    <div class="projects-filters">
      <div class="status-buttons">
        <button class="filter-btn {{ request('type') == '' ? 'active' : '' }}" data-type="">{{ __('front.all_projects') }}</button>
        <button class="filter-btn {{ request('type') == '3' ? 'active' : '' }}" data-type="3">{{ __('front.planned') }}</button>
        <button class="filter-btn {{ request('type') == '2' ? 'active' : '' }}" data-type="2">{{ __('front.ongoing') }}</button>
        <button class="filter-btn {{ request('type') == '1' ? 'active' : '' }}" data-type="1">{{ __('front.completed') }}</button>
      </div>
      <div class="search-sort">
        <form id="search-form" method="GET">
          <input type="hidden" name="type" value="{{ request('type') }}">
          <input type="text" name="search" placeholder="{{ __('front.search_projects') }}" value="{{ request('search') }}">
          <select name="sort" onchange="document.getElementById('search-form').submit()">
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('front.newest_first') }}</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('front.oldest_first') }}</option>
          </select>
        </form>
      </div>
    </div>

    <div class="projects-grid">
      @forelse($projects as $project)
        <div class="project-card">
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
          <img src="{{ asset('storage/' . $project->photo) }}" alt="{{ $locale == 'ar' ? $project->title_ar : $project->title_en }}">
          <div class="project-content">
            <h3>{{ $locale == 'ar' ? $project->title_ar : $project->title_en }}</h3>
            <p>{{ Str::limit($locale == 'ar' ? $project->description_ar : $project->description_en, 100) }}</p>
            @if($project->time)
              <p class="start-date">{{ __('front.starting_from') }}: {{ $project->time }}</p>
            @endif
            <a href="{{ route('projects.show', $project->id) }}">{{ __('front.learn_more') }} ←</a>
          </div>
        </div>
      @empty
        <div class="no-projects">
          <p>{{ __('front.no_projects_found') }}</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const searchForm = document.getElementById('search-form');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const typeInput = searchForm.querySelector('input[name="type"]');
            typeInput.value = type;
            searchForm.submit();
        });
    });

    // Submit form on search input
    const searchInput = searchForm.querySelector('input[name="search"]');
    searchInput.addEventListener('input', function() {
        setTimeout(() => {
            searchForm.submit();
        }, 500);
    });
});
</script>

@endsection