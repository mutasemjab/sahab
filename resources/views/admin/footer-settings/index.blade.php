
@extends('layouts.admin')

@section('title', __('messages.footer_settings'))

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <h3 class="card-title">{{ __('messages.footer_settings_management') }}</h3>
               </div>

        

               <form action="{{ route('footer-settings.update') }}" method="POST">
                   @csrf
                   @method('PUT')

                   <div class="card-body">
                       <div class="row">
                           {{-- About Municipality Section --}}
                           <div class="col-md-6">
                               <div class="card border">
                                   <div class="card-header bg-primary text-white">
                                       <h5 class="mb-0">
                                           <i class="fas fa-building"></i>
                                           {{ __('messages.about_municipality_section') }}
                                       </h5>
                                   </div>
                                   <div class="card-body">
                                       @if($aboutLinks->count() > 0)
                                           <div class="table-responsive">
                                               <table class="table table-sm">
                                                   <thead>
                                                       <tr>
                                                           <th>{{ __('messages.title_en') }}</th>
                                                           <th>{{ __('messages.route') }}</th>
                                                           <th>{{ __('messages.active') }}</th>
                                                           <th>{{ __('messages.order') }}</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody id="about-links-tbody">
                                                       @foreach($aboutLinks as $link)
                                                           <tr data-id="{{ $link->id }}">
                                                               <td>
                                                                   <div class="mb-1">
                                                                       <strong>{{ __($link->title) }}</strong>
                                                                       <br>
                                                                       <small class="text-muted">
                                                                           <span class="badge bg-info">{{ __('messages.en') }}</span>
                                                                           {{ $link->title }}
                                                                       </small>
                                                                       @if(app()->getLocale() == 'ar' || config('app.locales'))
                                                                           <br>
                                                                           <small class="text-muted">
                                                                               <span class="badge bg-secondary">{{ __('messages.ar') }}</span>
                                                                               {{ __($link->title, [], 'ar') }}
                                                                           </small>
                                                                       @endif
                                                                   </div>
                                                               </td>
                                                               <td>
                                                                   <code>{{ $link->route_name }}</code>
                                                               </td>
                                                               <td>
                                                                   <div class="form-check form-switch">
                                                                       <input 
                                                                           class="form-check-input" 
                                                                           type="checkbox" 
                                                                           name="settings[{{ $link->id }}][is_active]" 
                                                                           value="1"
                                                                           {{ $link->is_active ? 'checked' : '' }}
                                                                           id="active_{{ $link->id }}"
                                                                       >
                                                                       <label class="form-check-label" for="active_{{ $link->id }}">
                                                                           <span class="badge bg-{{ $link->is_active ? 'success' : 'secondary' }}">
                                                                               {{ $link->is_active ? __('messages.active') : __('messages.inactive') }}
                                                                           </span>
                                                                       </label>
                                                                   </div>
                                                               </td>
                                                               <td>
                                                                   <input 
                                                                       type="number" 
                                                                       name="settings[{{ $link->id }}][order]" 
                                                                       value="{{ $link->order }}" 
                                                                       class="form-control form-control-sm" 
                                                                       style="width: 70px;"
                                                                       min="1"
                                                                   >
                                                               </td>
                                                           </tr>
                                                       @endforeach
                                                   </tbody>
                                               </table>
                                           </div>
                                       @else
                                           <div class="text-center text-muted py-4">
                                               <i class="fas fa-info-circle fa-2x mb-2"></i>
                                               <p>{{ __('messages.no_links_found_about') }}</p>
                                           </div>
                                       @endif
                                   </div>
                               </div>
                           </div>

                           {{-- Quick Links Section --}}
                           <div class="col-md-6">
                               <div class="card border">
                                   <div class="card-header bg-success text-white">
                                       <h5 class="mb-0">
                                           <i class="fas fa-link"></i>
                                           {{ __('messages.quick_links_section') }}
                                       </h5>
                                   </div>
                                   <div class="card-body">
                                       @if($quickLinks->count() > 0)
                                           <div class="table-responsive">
                                               <table class="table table-sm">
                                                   <thead>
                                                       <tr>
                                                           <th>{{ __('messages.title_en') }}</th>
                                                           <th>{{ __('messages.route') }}</th>
                                                           <th>{{ __('messages.active') }}</th>
                                                           <th>{{ __('messages.order') }}</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody id="quick-links-tbody">
                                                       @foreach($quickLinks as $link)
                                                           <tr data-id="{{ $link->id }}">
                                                               <td>
                                                                   <div class="mb-1">
                                                                       <strong>{{ __($link->title) }}</strong>
                                                                       <br>
                                                                       <small class="text-muted">
                                                                           <span class="badge bg-info">{{ __('messages.en') }}</span>
                                                                           {{ $link->title }}
                                                                       </small>
                                                                       @if(app()->getLocale() == 'ar' || config('app.locales'))
                                                                           <br>
                                                                           <small class="text-muted">
                                                                               <span class="badge bg-secondary">{{ __('messages.ar') }}</span>
                                                                               {{ __($link->title, [], 'ar') }}
                                                                           </small>
                                                                       @endif
                                                                   </div>
                                                               </td>
                                                               <td>
                                                                   <code>{{ $link->route_name }}</code>
                                                               </td>
                                                               <td>
                                                                   <div class="form-check form-switch">
                                                                       <input 
                                                                           class="form-check-input" 
                                                                           type="checkbox" 
                                                                           name="settings[{{ $link->id }}][is_active]" 
                                                                           value="1"
                                                                           {{ $link->is_active ? 'checked' : '' }}
                                                                           id="active_{{ $link->id }}"
                                                                       >
                                                                       <label class="form-check-label" for="active_{{ $link->id }}">
                                                                           <span class="badge bg-{{ $link->is_active ? 'success' : 'secondary' }}">
                                                                               {{ $link->is_active ? __('messages.active') : __('messages.inactive') }}
                                                                           </span>
                                                                       </label>
                                                                   </div>
                                                               </td>
                                                               <td>
                                                                   <input 
                                                                       type="number" 
                                                                       name="settings[{{ $link->id }}][order]" 
                                                                       value="{{ $link->order }}" 
                                                                       class="form-control form-control-sm" 
                                                                       style="width: 70px;"
                                                                       min="1"
                                                                   >
                                                               </td>
                                                           </tr>
                                                       @endforeach
                                                   </tbody>
                                               </table>
                                           </div>
                                       @else
                                           <div class="text-center text-muted py-4">
                                               <i class="fas fa-info-circle fa-2x mb-2"></i>
                                               <p>{{ __('messages.no_links_found_quick') }}</p>
                                           </div>
                                       @endif
                                   </div>
                               </div>
                           </div>
                       </div>

                       {{-- Instructions --}}
                       <div class="row mt-4">
                           <div class="col-12">
                               <div class="alert alert-info">
                                   <h6><i class="fas fa-info-circle"></i> {{ __('messages.instructions') }}:</h6>
                                   <ul class="mb-0">
                                       <li>{{ __('messages.instruction_1') }}</li>
                                       <li>{{ __('messages.instruction_2') }}</li>
                                       <li>{{ __('messages.instruction_3') }}</li>
                                       <li>{{ __('messages.instruction_4') }}</li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="card-footer">
                       <div class="d-flex justify-content-between">
                           <button type="button" class="btn btn-secondary" onclick="window.location.reload()">
                               <i class="fas fa-undo"></i> {{ __('messages.reset_changes') }}
                           </button>
                           <button type="submit" class="btn btn-primary">
                               <i class="fas fa-save"></i> {{ __('messages.save_changes') }}
                           </button>
                       </div>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>

{{-- Custom JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
   // Update badge colors when switches are toggled
   document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
       checkbox.addEventListener('change', function() {
           const badge = this.parentNode.querySelector('.badge');
           if (this.checked) {
               badge.textContent = '{{ __('messages.active') }}';
               badge.className = 'badge bg-success';
           } else {
               badge.textContent = '{{ __('messages.inactive') }}';
               badge.className = 'badge bg-secondary';
           }
       });
   });

   // Form submission confirmation
   document.querySelector('form').addEventListener('submit', function(e) {
       if (!confirm('{{ __('messages.confirm_save_settings') }}')) {
           e.preventDefault();
       }
   });
});
</script>


@endsection