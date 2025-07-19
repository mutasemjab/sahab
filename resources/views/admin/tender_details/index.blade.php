@extends('layouts.admin')

@section('title', __('messages.TenderDetails'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.TenderDetails') }}</h1>
    <a href="{{ route('tender-details.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($tenderDetails->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.tender_id') }}</th>
                            <th>{{ __('messages.video') }}</th>
                            <th>{{ __('messages.description_en') }}</th>
                            <th>{{ __('messages.condition') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenderDetails as $detail)
                        <tr>
                            <td>{{ $detail->id }}</td>
                            <td>{{ $detail->tender_title }}</td>
                            <td>
                                <a href="{{ $detail->video }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-play"></i> Watch
                                </a>
                            </td>
                            <td>{{ Str::limit(strip_tags($detail->description_en), 30) }}</td>
                            <td>{{ Str::limit(strip_tags($detail->condition), 30) }}</td>
                            <td>
                                <a href="{{ route('tender-details.edit', $detail->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('tender-details.destroy', $detail->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
                <p class="text-muted">No tender details found.</p>
                <a href="{{ route('tender-details.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection