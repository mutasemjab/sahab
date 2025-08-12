@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.service_details') }} - {{ $service->title_en }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('services.details.create', $service->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> {{ __('messages.add_details') }}
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($serviceDetails->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.video') }}</th>
                                        <th>{{ __('messages.description_en') }}</th>
                                        <th>{{ __('messages.description_ar') }}</th>
                                        <th>{{ __('messages.created_at') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceDetails as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($detail->video, 30) }}</td>
                                        <td>{{ Str::limit($detail->description_en, 50) }}</td>
                                        <td>{{ Str::limit($detail->description_ar, 50) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($detail->created_at)) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Edit Detail Button -->
                                                <a href="{{ route('services.details.edit', [$service->id, $detail->id]) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   title="{{ __('messages.edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <!-- Delete Detail Button -->
                                                <form action="{{ route('services.details.destroy', [$service->id, $detail->id]) }}" 
                                                      method="POST" 
                                                      class="d-inline" 
                                                      onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm" 
                                                            title="{{ __('messages.delete') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i>
                            {{ __('messages.no_service_details') }}
                            <br><br>
                            <a href="{{ route('services.details.create', $service->id) }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> {{ __('messages.add_first_detail') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Service Info Card -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('messages.service_information') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{ __('messages.title_en') }}:</strong> {{ $service->title_en }}<br>
                        <strong>{{ __('messages.title_ar') }}:</strong> {{ $service->title_ar }}<br>
                        <strong>{{ __('messages.target_audience') }}:</strong> {{ $service->target_audience }}<br>
                    </div>
                    <div class="col-md-6">
                        <strong>{{ __('messages.duration_service') }}:</strong> {{ $service->duration_service }}<br>
                        <strong>{{ __('messages.service_channel') }}:</strong> {{ $service->service_channel }}<br>
                        <strong>{{ __('messages.service_cost') }}:</strong> {{ $service->service_cost }}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection