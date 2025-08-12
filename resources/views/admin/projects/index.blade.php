@extends('layouts.admin')
@section('title', __('messages.Projects'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Projects') }}</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($projects->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.photo') }}</th>
                            <th>{{ __('messages.type') }}</th>
                            <th>{{ __('messages.time') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ Str::limit($project->title_en, 30) }}</td>
                            <td>{{ Str::limit($project->title_ar, 30) }}</td>
                            <td>
                                @if($project->photo)
                                    <img src="{{ asset('assets/admin/uploads/' . $project->photo) }}" alt="Project" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                @if($project->type == 1)
                                    <span class="badge bg-success">{{ __('messages.done') }}</span>
                                @elseif($project->type == 2)
                                    <span class="badge bg-warning">{{ __('messages.on_going') }}</span>
                                @else
                                    <span class="badge bg-info">{{ __('messages.planned') }}</span>
                                @endif
                            </td>
                            <td>{{ $project->time ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
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
            
            <!-- Pagination Links -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $projects->firstItem() }} to {{ $projects->lastItem() }} of {{ $projects->total() }} results
                </div>
                <div>
                    {{ $projects->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <p class="text-muted">No projects found.</p>
                <a href="{{ route('projects.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection