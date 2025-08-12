@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.complaints_management') }}</h3>
                    
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <form method="GET" action="{{ route('adminComplaints.index') }}" class="mb-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" name="status" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_status') }}</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>{{ __('messages.work_on_it') }}</option>
                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>{{ __('messages.done') }}</option>
                                    <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>{{ __('messages.outside_jurisdiction') }}</option>
                                    <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>{{ __('messages.not_solved') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="emergency" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_types') }}</option>
                                    <option value="1" {{ request('emergency') == '1' ? 'selected' : '' }}>{{ __('messages.emergency') }}</option>
                                    <option value="2" {{ request('emergency') == '2' ? 'selected' : '' }}>{{ __('messages.regular') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="gender" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_genders') }}</option>
                                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                           placeholder="{{ __('messages.search_by_name_or_phone') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request()->hasAny(['search', 'status', 'emergency', 'gender']))
                                            <a href="{{ route('adminComplaints.index') }}" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Results Info -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted">
                                {{ __('messages.showing') }} {{ $complaints->firstItem() ?? 0 }} {{ __('messages.to') }} {{ $complaints->lastItem() ?? 0 }} 
                                {{ __('messages.of') }} {{ $complaints->total() }} {{ __('messages.results') }}
                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}" 
                                   class="btn btn-outline-secondary {{ request('per_page', 25) == 10 ? 'active' : '' }}">10</a>
                                <a href="{{ request()->fullUrlWithQuery(['per_page' => 25]) }}" 
                                   class="btn btn-outline-secondary {{ request('per_page', 25) == 25 ? 'active' : '' }}">25</a>
                                <a href="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}" 
                                   class="btn btn-outline-secondary {{ request('per_page', 25) == 50 ? 'active' : '' }}">50</a>
                                <a href="{{ request()->fullUrlWithQuery(['per_page' => 100]) }}" 
                                   class="btn btn-outline-secondary {{ request('per_page', 25) == 100 ? 'active' : '' }}">100</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.id') }}
                                            @if(request('sort') == 'id')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.number') }}</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.name') }}
                                            @if(request('sort') == 'name')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.phone') }}</th>
                                    <th>{{ __('messages.age') }}</th>
                                    <th>{{ __('messages.gender') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.emergency') }}</th>
                                    <th>{{ __('messages.service') }}</th>
                                    <th>{{ __('messages.place') }}</th>
                                    <th>{{ __('messages.details') }}</th>
                                    <th>{{ __('messages.photos') }}</th>
                                    <th>{{ __('messages.video') }}</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.created') }}
                                            @if(request('sort') == 'created_at' || !request('sort'))
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $complaint)
                                <tr>
                                    <td>{{ $complaint->id }}</td>
                                    <td>
                                        <span class="badge badge-info">#{{ $complaint->number }}</span>
                                    </td>
                                    <td>
                                        @if($complaint->hide_information == 1)
                                            <i class="fas fa-eye-slash text-muted" title="{{ __('messages.information_hidden') }}"></i>
                                            {{ $complaint->name }}
                                        @else
                                            {{ $complaint->name }}
                                        @endif
                                    </td>
                                    <td>{{ $complaint->phone }}</td>
                                    <td>{{ $complaint->age }}</td>
                                    <td>
                                        @if($complaint->gender == 1)
                                            <span class="badge badge-primary">{{ __('messages.male') }}</span>
                                        @else
                                            <span class="badge badge-pink">{{ __('messages.female') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($complaint->status)
                                            @case(1)
                                                <span class="badge badge-warning">{{ __('messages.pending') }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-info">{{ __('messages.work_on_it') }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge badge-success">{{ __('messages.done') }}</span>
                                                @break
                                            @case(4)
                                                <span class="badge badge-secondary">{{ __('messages.outside_jurisdiction') }}</span>
                                                @break
                                            @case(5)
                                                <span class="badge badge-danger">{{ __('messages.not_solved') }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($complaint->is_complaint_emergency == 1)
                                            <span class="badge badge-danger">
                                                <i class="fas fa-exclamation-triangle"></i> {{ __('messages.emergency') }}
                                            </span>
                                        @else
                                            <span class="badge badge-light">{{ __('messages.regular') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-outline">{{ __('messages.service') }}: {{ $complaint->service->title_ar }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-outline">{{ __('messages.place') }}: {{ $complaint->placeComplaint->name_ar }}</span>
                                        @if($complaint->address_details)
                                            <br><small class="text-muted">{{ Str::limit($complaint->address_details, 30) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $complaint->complaint_details }}">
                                            {{ Str::limit($complaint->complaint_details, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            // Safely decode JSON and ensure we have arrays
                                            $photos = json_decode($complaint->photo, true);
                                            if (!is_array($photos)) {
                                                $photos = [];
                                            }
                                            
                                            $anotherPhotos = [];
                                            if ($complaint->another_photo) {
                                                $anotherPhotos = json_decode($complaint->another_photo, true);
                                                if (!is_array($anotherPhotos)) {
                                                    $anotherPhotos = [];
                                                }
                                            }
                                            
                                            $totalPhotos = count($photos) + count($anotherPhotos);
                                        @endphp
                                        
                                        @if($totalPhotos > 0)
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#photosModal{{ $complaint->id }}">
                                                <i class="fas fa-images"></i> {{ $totalPhotos }} {{ __('messages.photos') }}
                                            </button>

                                            <!-- Photos Modal -->
                                            <div class="modal fade" id="photosModal{{ $complaint->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('messages.complaint_photos') }} - #{{ $complaint->number }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                @if(is_array($photos) && count($photos) > 0)
                                                                    @foreach($photos as $photo)
                                                                        <div class="col-md-4 mb-3">
                                                                            <img src="{{ asset('assets/admin/uploads/' . trim($photo, '"')) }}" class="img-fluid rounded" alt="{{ __('messages.complaint_photo') }}" style="max-height: 200px; object-fit: cover;">
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                
                                                                @if(is_array($anotherPhotos) && count($anotherPhotos) > 0)
                                                                    @foreach($anotherPhotos as $photo)
                                                                        <div class="col-md-4 mb-3">
                                                                            <img src="{{ asset('assets/admin/uploads/' . trim($photo, '"')) }}" class="img-fluid rounded" alt="{{ __('messages.additional_photo') }}" style="max-height: 200px; object-fit: cover;">
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">{{ __('messages.no_photos') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($complaint->video)
                                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#videoModal{{ $complaint->id }}">
                                                <i class="fas fa-video"></i> {{ __('messages.view') }}
                                            </button>

                                            <!-- Video Modal -->
                                            <div class="modal fade" id="videoModal{{ $complaint->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('messages.complaint_video') }} - #{{ $complaint->number }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                        </div>
                                                        <div class="modal-body">
                                                            <video width="100%" controls>
                                                                <source src="{{ asset('assets/admin/uploads/' . $complaint->video) }}" type="video/mp4">
                                                                {{ __('messages.browser_not_support_video') }}
                                                            </video>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">{{ __('messages.no_video') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-success" title="{{ __('messages.view_location') }}" onclick="showLocation({{ $complaint->lat }}, {{ $complaint->lng }})">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="15" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('messages.no_complaints_found') }}</h5>
                                            <p class="text-muted">{{ __('messages.no_complaints_to_display') }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            {{ $complaints->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.complaint_location') }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
// Show location function using free OpenStreetMap
function showLocation(lat, lng) {
    $('#locationModal').modal('show');
    
    // Initialize map when modal is shown
    $('#locationModal').on('shown.bs.modal', function () {
        // Clear any existing map content
        document.getElementById('map').innerHTML = '';
        
        // Use free OpenStreetMap
        var mapHtml = 
            '<div style="position: relative; height: 100%;">' +
            '<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ' +
            'src="https://www.openstreetmap.org/export/embed.html?bbox=' + 
            (lng-0.01) + '%2C' + (lat-0.01) + '%2C' + (lng+0.01) + '%2C' + (lat+0.01) + 
            '&layer=mapnik&marker=' + lat + '%2C' + lng + '"></iframe>' +
            '<div style="position: absolute; top: 10px; right: 10px; background: white; padding: 5px 10px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">' +
            '<a href="https://www.openstreetmap.org/?mlat=' + lat + '&mlon=' + lng + '#map=15/' + lat + '/' + lng + '" target="_blank" style="text-decoration: none; color: #007bff;">' +
            '<i class="fas fa-external-link-alt"></i> {{ __('messages.view_in_openstreetmap') }}' +
            '</a>' +
            '</div>' +
            '</div>';
            
        document.getElementById('map').innerHTML = mapHtml;
    });
}
</script>

<style>
.badge-pink {
    background-color: #e91e63;
    color: white;
}

.badge-outline {
    background-color: transparent;
    border: 1px solid #dee2e6;
    color: #6c757d;
}

.table td {
    vertical-align: middle;
}

.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.table th a {
    display: block;
    color: white !important;
}

.table th a:hover {
    color: #f8f9fa !important;
}
</style>
@endsection