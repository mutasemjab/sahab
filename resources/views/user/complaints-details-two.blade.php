{{-- resources/views/user/complaint-details-two.blade.php --}}
@extends('layouts.front')

@section('content')

<div class="breadcrumb-bar">
  <div class="breadcrumb-container">
    <a href="#">{{ __('front.home') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="{{ route('complaints.index') }}">{{ __('front.complaints') }}</a>
    <span> <i class="fas fa-chevron-left"></i> </span>
    <a href="#" class="active">{{ __('front.complaint_details') }}</a>
  </div>
</div>

<section class="complaint-details">
  <h2 class="section-title">{{ __('front.complaint_details') }}</h2>
  <p class="section-desc">{{ __('front.complaint_details_description') }}</p>

  <div class="complaint-box">
    <div class="complaint-header">
      <span class="
        @if($complaint->status == 1) pending-status
        @elseif($complaint->status == 2) working-status
        @elseif($complaint->status == 3) resolved-status
        @elseif($complaint->status == 4) not-in-scope
        @else unsolved-status
        @endif">
        @if($complaint->status == 1)
          {{ __('front.status_pending') }}
        @elseif($complaint->status == 2)
          {{ __('front.status_working') }}
        @elseif($complaint->status == 3)
          {{ __('front.status_done') }}
        @elseif($complaint->status == 4)
          {{ __('front.not_within_municipality_jurisdiction') }}
        @else
          {{ __('front.status_not_solved') }}
        @endif
      </span>
      @if($complaint->is_complaint_emergency == 1)
        <span class="emergency-indicator">{{ __('front.emergency_complaint') }}</span>
      @endif
    </div>
    
    <div class="info-label-h">{{ __('front.complaint_information') }}</div>
    <div class="info-label-desc">{{ __('front.complaint_number') }}: {{ $complaint->number }}</div>

    <div class="complaint-info">

      <div class="info-label">{{ __('front.complaint_type') }}:</div>
      <div class="info-gray">{{ $locale == 'ar' ? $complaint->service->title_ar : $complaint->service->title_en }}</div>

      <div class="info-label">{{ __('front.description') }}:</div>
      <div class="info-gray">{{ $complaint->complaint_details }}</div>

      @if($complaint->hide_information == 2)
        <div class="info-label">{{ __('front.submitted_by') }}:</div>
        <div class="info-gray">{{ $complaint->name }}</div>
        
        <div class="info-label">{{ __('front.contact_number') }}:</div>
        <div class="info-gray">{{ $complaint->phone }}</div>
        
        <div class="info-label">{{ __('front.submitter_age') }}:</div>
        <div class="info-gray">{{ $complaint->age }}</div>
        
        <div class="info-label">{{ __('front.gender') }}:</div>
        <div class="info-gray">{{ $complaint->gender == 1 ? __('front.male') : __('front.female') }}</div>
      @endif

      <div class="info-label">{{ __('front.submission_date') }}:</div>
      <div class="info-gray">{{ $complaint->created_at->format('Y-m-d H:i') }}</div>

      @if($complaint->photo && count(json_decode($complaint->photo)) > 0)
        <div class="info-label">{{ __('front.complaint_images') }}:</div>
        <div class="images-wrapper">
          @foreach(json_decode($complaint->photo) as $photo)
            <img src="{{ asset('storage/' . $photo) }}" alt="{{ __('front.complaint_image') }}" onclick="openImageModal(this)">
          @endforeach
        </div>
      @endif

      @if($complaint->another_photo && count(json_decode($complaint->another_photo)) > 0)
        <div class="info-label">{{ __('front.additional_attachments') }}:</div>
        <div class="images-wrapper">
          @foreach(json_decode($complaint->another_photo) as $photo)
            <img src="{{ asset('storage/' . $photo) }}" alt="{{ __('front.additional_attachment') }}" onclick="openImageModal(this)">
          @endforeach
        </div>
      @endif

      <div class="info-label">{{ __('front.municipality') }}:</div>
      <div class="info-gray">{{ __('front.sahab_municipality') }}</div>

      <div class="info-label">{{ __('front.complaint_area') }}:</div>
      <div class="info-gray">{{ $locale == 'ar' ? $complaint->placeComplaint->name_ar : $complaint->placeComplaint->name_en }}</div>

      @if($complaint->address_details)
        <div class="info-label">{{ __('front.detailed_address') }}:</div>
        <div class="info-gray">{{ $complaint->address_details }}</div>
      @endif

      <div class="info-label">{{ __('front.location') }}:</div>
      <div class="map-box">
        <iframe
          src="https://maps.google.com/maps?q={{ $complaint->lat }},{{ $complaint->lng }}&t=&z=15&ie=UTF8&iwloc=&output=embed"
          frameborder="0"
          allowfullscreen
          aria-hidden="false"
          tabindex="0"
        ></iframe>
      </div>

      <div class="info-label">{{ __('front.coordinates') }}:</div>
      <div class="info-gray">
        {{ __('front.latitude') }}: {{ $complaint->lat }}<br>
        {{ __('front.longitude') }}: {{ $complaint->lng }}
      </div>

    </div>

    <div class="complaint-actions">
      <a href="{{ route('complaints.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        {{ __('front.back_to_complaints') }}
      </a>
      
      @if($complaint->hide_information == 2)
        <a href="tel:{{ $complaint->phone }}" class="btn-contact">
          <i class="fas fa-phone"></i>
          {{ __('front.contact_submitter') }}
        </a>
      @endif
    </div>
  </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="modal" onclick="closeImageModal()">
  <div class="modal-content">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img id="modalImage" src="" alt="{{ __('front.complaint_image') }}">
  </div>
</div>

<script>
function openImageModal(img) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = "block";
    modalImg.src = img.src;
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = "none";
}

// Close modal when clicking outside the image
window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


@endsection