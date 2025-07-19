@extends('layouts.admin')

@section('title', __('messages.TopicDiscussions'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.TopicDiscussions') }}</h1>
    <a href="{{ route('topic-discussions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($topicDiscussions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.description_en') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topicDiscussions as $discussion)
                        <tr>
                            <td>{{ $discussion->id }}</td>
                            <td>{{ Str::limit($discussion->title_en, 30) }}</td>
                            <td>{{ Str::limit($discussion->title_ar, 30) }}</td>
                            <td>{{ Str::limit(strip_tags($discussion->description_en), 40) }}</td>
                            <td>{{ $discussion->created_at }}</td>
                            <td>
                                <a href="{{ route('topic-discussions.edit', $discussion->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('topic-discussions.destroy', $discussion->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No topic discussions found.</p>
                <a href="{{ route('topic-discussions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection