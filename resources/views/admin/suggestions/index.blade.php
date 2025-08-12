@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.suggestions_management') }}</h3>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('admin.suggestions.index') }}" class="mb-4">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" name="status" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_status') }}</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>{{ __('messages.work_on_it') }}</option>
                                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>{{ __('messages.done') }}</option>
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
                                <select class="form-control" name="opinion" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_opinions') }}</option>
                                    <option value="1" {{ request('opinion') == '1' ? 'selected' : '' }}>{{ __('messages.opinion_good') }}</option>
                                    <option value="2" {{ request('opinion') == '2' ? 'selected' : '' }}>{{ __('messages.opinion_not_good') }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="service" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_services') }}</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ request('service') == $service->id ? 'selected' : '' }}>
                                            {{ $service->title_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                           placeholder="{{ __('messages.search_by_name_phone_note') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request()->hasAny(['search', 'status', 'gender', 'opinion', 'service']))
                                            <a href="{{ route('admin.suggestions.index') }}" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
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
                    </form>

                    <!-- Results Info -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p class="text-muted">
                                {{ __('messages.showing') }} {{ $suggestions->firstItem() ?? 0 }} {{ __('messages.to') }} {{ $suggestions->lastItem() ?? 0 }} 
                                {{ __('messages.of') }} {{ $suggestions->total() }} {{ __('messages.results') }}
                            </p>
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
                                    <th>{{ __('messages.service') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                    <th>{{ __('messages.opinion') }}</th>
                                    <th>{{ __('messages.usage_frequency') }}</th>
                                    <th>{{ __('messages.accessibility_needs') }}</th>
                                    <th>{{ __('messages.note') }}</th>
                                    <th>{{ __('messages.question') }}</th>
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
                                @forelse($suggestions as $suggestion)
                                <tr>
                                    <td>{{ $suggestion->id }}</td>
                                    <td>
                                        @if($suggestion->hide_information == 1)
                                            <i class="fas fa-eye-slash text-muted" title="{{ __('messages.information_hidden') }}"></i>
                                        @endif
                                        <strong>{{ $suggestion->name }}</strong>
                                    </td>
                                    <td>{{ $suggestion->phone }}</td>
                                    <td>{{ $suggestion->age }}</td>
                                    <td>
                                        @if($suggestion->gender == 1)
                                            <span class="badge badge-primary">{{ __('messages.male') }}</span>
                                        @else
                                            <span class="badge badge-pink">{{ __('messages.female') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $suggestion->service->title_ar }}</span>
                                    </td>
                                    <td>
                                        @switch($suggestion->status)
                                            @case(1)
                                                <span class="badge badge-warning">{{ __('messages.pending') }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-info">{{ __('messages.work_on_it') }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge badge-success">{{ __('messages.done') }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($suggestion->opinion == 1)
                                            <span class="badge badge-success">
                                                <i class="fas fa-thumbs-up"></i> {{ __('messages.opinion_good') }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-thumbs-down"></i> {{ __('messages.opinion_not_good') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($suggestion->how_much_use_this_service)
                                            @case(1)
                                                <span class="badge badge-success">{{ __('messages.weekly') }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-warning">{{ __('messages.monthly') }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge badge-secondary">{{ __('messages.yearly') }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($suggestion->Do_you_need_accessibility)
                                            @case(1)
                                                <span class="badge badge-primary">{{ __('messages.screen_reader_support') }}</span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-info">{{ __('messages.large_text') }}</span>
                                                @break
                                            @case(3)
                                                <span class="badge badge-dark">{{ __('messages.color_contrast') }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $suggestion->note }}">
                                            {{ Str::limit($suggestion->note, 50) }}
                                        </span>
                                        @if(strlen($suggestion->note) > 50)
                                            <button type="button" class="btn btn-sm btn-outline-info ml-1" 
                                                    data-toggle="modal" data-target="#noteModal{{ $suggestion->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $suggestion->question }}">
                                            {{ Str::limit($suggestion->question, 50) }}
                                        </span>
                                        @if(strlen($suggestion->question) > 50)
                                            <button type="button" class="btn btn-sm btn-outline-info ml-1" 
                                                    data-toggle="modal" data-target="#questionModal{{ $suggestion->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($suggestion->created_at)->format('Y-m-d H:i') }}
                                            <br>
                                            <span class="badge badge-secondary">
                                                {{ \Carbon\Carbon::parse($suggestion->created_at)->diffForHumans() }}
                                            </span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    data-toggle="modal" data-target="#detailsModal{{ $suggestion->id }}" 
                                                    title="{{ __('messages.view_details') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.suggestions.destroy', $suggestion->id) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete_suggestion') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ __('messages.delete') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <!-- Details Modal -->
                                    <div class="modal fade" id="detailsModal{{ $suggestion->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('messages.suggestion_details') }} - {{ $suggestion->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><strong>{{ __('messages.name') }}:</strong> {{ $suggestion->name }}</p>
                                                            <p><strong>{{ __('messages.phone') }}:</strong> {{ $suggestion->phone }}</p>
                                                            <p><strong>{{ __('messages.age') }}:</strong> {{ $suggestion->age }}</p>
                                                            <p><strong>{{ __('messages.gender') }}:</strong> 
                                                                @if($suggestion->gender == 1)
                                                                    {{ __('messages.male') }}
                                                                @else
                                                                    {{ __('messages.female') }}
                                                                @endif
                                                            </p>
                                                            <p><strong>{{ __('messages.service') }}:</strong> {{ $suggestion->service->title_ar }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p><strong>{{ __('messages.status') }}:</strong>
                                                                @switch($suggestion->status)
                                                                    @case(1) {{ __('messages.pending') }} @break
                                                                    @case(2) {{ __('messages.work_on_it') }} @break
                                                                    @case(3) {{ __('messages.done') }} @break
                                                                @endswitch
                                                            </p>
                                                            <p><strong>{{ __('messages.opinion') }}:</strong>
                                                                @if($suggestion->opinion == 1)
                                                                    {{ __('messages.opinion_good') }}
                                                                @else
                                                                    {{ __('messages.opinion_not_good') }}
                                                                @endif
                                                            </p>
                                                            <p><strong>{{ __('messages.usage_frequency') }}:</strong>
                                                                @switch($suggestion->how_much_use_this_service)
                                                                    @case(1) {{ __('messages.weekly') }} @break
                                                                    @case(2) {{ __('messages.monthly') }} @break
                                                                    @case(3) {{ __('messages.yearly') }} @break
                                                                @endswitch
                                                            </p>
                                                            <p><strong>{{ __('messages.accessibility_needs') }}:</strong>
                                                                @switch($suggestion->Do_you_need_accessibility)
                                                                    @case(1) {{ __('messages.screen_reader_support') }} @break
                                                                    @case(2) {{ __('messages.large_text') }} @break
                                                                    @case(3) {{ __('messages.color_contrast') }} @break
                                                                @endswitch
                                                            </p>
                                                            <p><strong>{{ __('messages.information_hidden') }}:</strong>
                                                                @if($suggestion->hide_information == 1)
                                                                    {{ __('messages.yes') }}
                                                                @else
                                                                    {{ __('messages.no') }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="mb-3">
                                                        <strong>{{ __('messages.note') }}:</strong>
                                                        <div class="p-3 bg-light rounded mt-2">
                                                            {!! nl2br(e($suggestion->note)) !!}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <strong>{{ __('messages.question') }}:</strong>
                                                        <div class="p-3 bg-light rounded mt-2">
                                                            {!! nl2br(e($suggestion->question)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        {{ __('messages.close') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Note Modal -->
                                    @if(strlen($suggestion->note) > 50)
                                    <div class="modal fade" id="noteModal{{ $suggestion->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('messages.note') }} - {{ $suggestion->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! nl2br(e($suggestion->note)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Question Modal -->
                                    @if(strlen($suggestion->question) > 50)
                                    <div class="modal fade" id="questionModal{{ $suggestion->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('messages.question') }} - {{ $suggestion->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {!! nl2br(e($suggestion->question)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="14" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-lightbulb fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('messages.no_suggestions_found') }}</h5>
                                            <p class="text-muted">{{ __('messages.no_suggestions_to_display') }}</p>
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
                            {{ $suggestions->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function() {
    // Auto-focus search input if there's a search term
    if ($('input[name="search"]').val()) {
        $('input[name="search"]').focus();
    }
});
</script>

<style>
.badge-pink {
    background-color: #e91e63;
    color: white;
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

.modal-body .bg-light {
    max-height: 400px;
    overflow-y: auto;
}
</style>
@endsection