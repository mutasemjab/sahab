@extends('layouts.admin')

@section('title', __('messages.ImportantLinks'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.ImportantLinks') }}</h1>
    <a href="{{ route('important-links.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($importantLinks->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.icon') }}</th>
                            <th>{{ __('messages.link') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($importantLinks as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>{{ Str::limit($link->title_en, 30) }}</td>
                            <td>{{ Str::limit($link->title_ar, 30) }}</td>
                            <td><i class="{{ $link->icon }}"></i> {{ $link->icon }}</td>
                            <td>
                                <a href="{{ $link->link }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-external-link-alt"></i> Visit
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('important-links.edit', $link->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('important-links.destroy', $link->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No important links found.</p>
                <a href="{{ route('important-links.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection