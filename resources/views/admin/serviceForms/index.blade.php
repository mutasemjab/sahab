@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.service_forms_management') }}</h3>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('admin.service-forms.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" 
                                           placeholder="{{ __('messages.search_by_name_email_message') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if(request()->hasAny(['search', 'service']))
                                            <a href="{{ route('admin.service-forms.index') }}" class="btn btn-outline-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="service" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.all_services') }}</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ request('service') == $service->id ? 'selected' : '' }}>
                                            {{ $service->title_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 text-right">
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
                                {{ __('messages.showing') }} {{ $serviceForms->firstItem() ?? 0 }} {{ __('messages.to') }} {{ $serviceForms->lastItem() ?? 0 }} 
                                {{ __('messages.of') }} {{ $serviceForms->total() }} {{ __('messages.results') }}
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
                                    <th>{{ __('messages.service') }}</th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.name') }}
                                            @if(request('sort') == 'name')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="text-white text-decoration-none">
                                            {{ __('messages.email') }}
                                            @if(request('sort') == 'email')
                                                <i class="fas fa-sort-{{ request('direction', 'desc') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>{{ __('messages.message') }}</th>
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
                                @forelse($serviceForms as $serviceForm)
                                <tr>
                                    <td>{{ $serviceForm->id }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $serviceForm->service->title_ar }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $serviceForm->name }}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $serviceForm->email }}" class="text-primary">
                                            {{ $serviceForm->email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if(strlen($serviceForm->message) > 100)
                                            <span class="text-truncate d-inline-block" style="max-width: 300px;" title="{{ $serviceForm->message }}">
                                                {{ Str::limit($serviceForm->message, 100) }}
                                            </span>
                                            <button type="button" class="btn btn-sm btn-outline-info ml-2" 
                                                    data-toggle="modal" data-target="#messageModal{{ $serviceForm->id }}">
                                                <i class="fas fa-eye"></i> {{ __('messages.view_full') }}
                                            </button>

                                            <!-- Message Modal -->
                                            <div class="modal fade" id="messageModal{{ $serviceForm->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('messages.service_inquiry') }} - {{ $serviceForm->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.service') }}:</strong> 
                                                                <span class="badge badge-primary">{{ $serviceForm->service->title_ar }}</span>
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.from') }}:</strong> {{ $serviceForm->name }} ({{ $serviceForm->email }})
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.date') }}:</strong> {{ \Carbon\Carbon::parse($serviceForm->created_at)->format('Y-m-d H:i') }}
                                                            </div>
                                                            <div class="mb-3">
                                                                <strong>{{ __('messages.message') }}:</strong>
                                                            </div>
                                                            <div class="p-3 bg-light rounded">
                                                                {!! nl2br(e($serviceForm->message)) !!}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="mailto:{{ $serviceForm->email }}?subject=Re: {{ __('messages.service_inquiry') }} - {{ $serviceForm->service->title_ar }}" 
                                                               class="btn btn-primary">
                                                                <i class="fas fa-reply"></i> {{ __('messages.reply_via_email') }}
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                {{ __('messages.close') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {!! nl2br(e($serviceForm->message)) !!}
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($serviceForm->created_at)->format('Y-m-d H:i') }}
                                            <br>
                                            <span class="badge badge-secondary">
                                                {{ \Carbon\Carbon::parse($serviceForm->created_at)->diffForHumans() }}
                                            </span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="mailto:{{ $serviceForm->email }}?subject=Re: {{ __('messages.service_inquiry') }} - {{ $serviceForm->service->title_ar }}" 
                                               class="btn btn-sm btn-primary" title="{{ __('messages.reply_via_email') }}">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    data-toggle="modal" data-target="#messageModal{{ $serviceForm->id }}" 
                                                    title="{{ __('messages.view_full_message') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('admin.service-forms.destroy', $serviceForm->id) }}" method="POST" 
                                                  class="d-inline" onsubmit="return confirm('{{ __('messages.confirm_delete_service_form') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ __('messages.delete') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">{{ __('messages.no_service_forms_found') }}</h5>
                                            <p class="text-muted">{{ __('messages.no_service_forms_to_display') }}</p>
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
                            {{ $serviceForms->appends(request()->query())->links() }}
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