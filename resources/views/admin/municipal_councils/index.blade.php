@extends('layouts.admin')

@section('title', __('messages.MunicipalCouncils'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.MunicipalCouncils') }}</h1>
    <a href="{{ route('municipal-councils.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($municipalCouncils->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.icon') }}</th>
                            <th>{{ __('messages.description_en') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($municipalCouncils as $council)
                        <tr>
                            <td>{{ $council->id }}</td>
                            <td>{{ Str::limit($council->title_en, 30) }}</td>
                            <td>{{ Str::limit($council->title_ar, 30) }}</td>
                            <td><i class="{{ $council->icon }}"></i> {{ $council->icon }}</td>
                            <td>{{ Str::limit(strip_tags($council->description_en), 30) }}</td>
                            <td>
                                <a href="{{ route('municipal-councils.edit', $council->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('municipal-councils.destroy', $council->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No municipal councils found.</p>
                <a href="{{ route('municipal-councils.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection