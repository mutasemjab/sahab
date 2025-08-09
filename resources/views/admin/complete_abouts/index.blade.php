@extends('layouts.admin')

@section('title', __('messages.complete_abouts'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.complete_abouts') }}</h1>
    <a href="{{ route('complete_abouts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($complete_abouts->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.description_en') }}</th>
                            <th>{{ __('messages.description_ar') }}</th>
                            <th>{{ __('messages.photo') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complete_abouts as $complete_about)
                        <tr>
                            <td>{{ $complete_about->id }}</td>
                            <td>{{ Str::limit(strip_tags($complete_about->description_en), 50) }}</td>
                            <td>{{ Str::limit(strip_tags($complete_about->description_ar), 50) }}</td>
                            <td>
                                @if($complete_about->icon)
                                   {{ $complete_about->icon}}
                                @endif
                            </td>
                            <td>{{ $complete_about->created_at }}</td>
                            <td>
                                <a href="{{ route('complete_abouts.edit', $complete_about->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('complete_abouts.destroy', $complete_about->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No complete_about records found.</p>
                <a href="{{ route('complete_abouts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection