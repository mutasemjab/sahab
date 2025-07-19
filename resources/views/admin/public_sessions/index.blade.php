@extends('layouts.admin')

@section('title', __('messages.PublicSessions'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.PublicSessions') }}</h1>
    <a href="{{ route('public-sessions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($publicSessions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.date_of_event') }}</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.type') }}</th>
                            <th>{{ __('messages.time') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publicSessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->date_of_event }}</td>
                            <td>{{ Str::limit($session->title_en, 30) }}</td>
                            <td>{{ Str::limit($session->title_ar, 30) }}</td>
                            <td>
                                <span class="badge bg-{{ $session->type == 1 ? 'success' : 'warning' }}">
                                    {{ $session->type == 1 ? __('messages.open') : __('messages.soon') }}
                                </span>
                            </td>
                            <td>{{ $session->time ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('public-sessions.edit', $session->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('public-sessions.destroy', $session->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No public sessions found.</p>
                <a href="{{ route('public-sessions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection