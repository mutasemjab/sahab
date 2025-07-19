@extends('layouts.admin')

@section('title', __('messages.Laws'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Laws') }}</h1>
    <a href="{{ route('laws.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($laws->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.description_en') }}</th>
                            <th>{{ __('messages.pdf') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laws as $law)
                        <tr>
                            <td>{{ $law->id }}</td>
                            <td>{{ Str::limit($law->title_en, 30) }}</td>
                            <td>{{ Str::limit($law->title_ar, 30) }}</td>
                            <td>{{ Str::limit(strip_tags($law->description_en), 30) }}</td>
                            <td>
                                @if($law->pdf)
                                    <a href="{{ asset($law->pdf) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('laws.edit', $law->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('laws.destroy', $law->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No laws found.</p>
                <a href="{{ route('laws.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection