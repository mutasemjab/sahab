@extends('layouts.admin')
@section('title', __('messages.Services'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.Services') }}</h1>
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('messages.create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($services->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('messages.title_en') }}</th>
                                <th>{{ __('messages.title_ar') }}</th>
                                <th>{{ __('messages.icon') }}</th>
                                <th>{{ __('messages.target_audience') }}</th>
                                <th>{{ __('messages.service_cost') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>{{ Str::limit($service->title_en, 30) }}</td>
                                    <td>{{ Str::limit($service->title_ar, 30) }}</td>
                                    <td><i class="{{ $service->icon }}"></i> {{ $service->icon }}</td>
                                    <td>{{ $service->target_audience }}</td>
                                    <td>{{ $service->service_cost }}</td>
                                    <td>
                                        <a href="{{ route('services.details', $service->id) }}" class="btn btn-info btn-sm"
                                            title="{{ __('messages.view_details') }}">
                                            <i class="fas fa-list"></i> {{ __('messages.details') }}
                                        </a>

                                        <!-- Add Details Button -->
                                        <a href="{{ route('services.details.create', $service->id) }}"
                                            class="btn btn-success btn-sm" title="{{ __('messages.add_details') }}">
                                            <i class="fas fa-plus"></i> {{ __('messages.add_details') }}
                                        </a>

                                        <a href="{{ route('services.edit', $service->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">No services found.</p>
                    <a href="{{ route('services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('messages.create') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
