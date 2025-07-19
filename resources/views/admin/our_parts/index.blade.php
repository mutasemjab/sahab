@extends('layouts.admin')

@section('title', __('messages.OurParts'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.OurParts') }}</h1>
    <a href="{{ route('our-parts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($ourParts->count() > 0)
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
                        @foreach($ourParts as $ourPart)
                        <tr>
                            <td>{{ $ourPart->id }}</td>
                            <td>{{ Str::limit($ourPart->title_en, 30) }}</td>
                            <td>{{ Str::limit($ourPart->title_ar, 30) }}</td>
                            <td><i class="{{ $ourPart->icon }}"></i> {{ $ourPart->icon }}</td>
                            <td>{{ Str::limit(strip_tags($ourPart->description_en), 30) }}</td>
                            <td>
                                <a href="{{ route('our-parts.edit', $ourPart->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('our-parts.destroy', $ourPart->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No our parts found.</p>
                <a href="{{ route('our-parts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection