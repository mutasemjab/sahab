@extends('layouts.admin')
@section('title', __('messages.Events'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Events') }}</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($events->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.date_of_event') }}</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.link_google_meet') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->date_of_event }}</td>
                            <td>{{ Str::limit($event->title_en, 30) }}</td>
                            <td>{{ Str::limit($event->title_ar, 30) }}</td>
                            <td>
                                <a href="{{ $event->link_google_meet }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-external-link-alt"></i> Meet Link
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No events found.</p>
                <a href="{{ route('events.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection