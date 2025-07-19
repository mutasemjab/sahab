@extends('layouts.admin')

@section('title', __('messages.Galleries'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Galleries') }}</h1>
    <a href="{{ route('galleries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($galleries->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.photos') }}</th>
                            <th>{{ __('messages.videos') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>
                                @php $photos = json_decode($gallery->photo, true); @endphp
                                @if($photos && count($photos) > 0)
                                    <span class="badge bg-primary">{{ count($photos) }} Photos</span>
                                    <div class="mt-1">
                                        @foreach(array_slice($photos, 0, 3) as $photo)
                                            <img src="{{ asset($photo) }}" alt="Gallery" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                                        @endforeach
                                        @if(count($photos) > 3)
                                            <span class="text-muted">+{{ count($photos) - 3 }} more</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">No photos</span>
                                @endif
                            </td>
                            <td>
                                @php $videos = json_decode($gallery->video, true); @endphp
                                @if($videos && count($videos) > 0)
                                    <span class="badge bg-success">{{ count($videos) }} Videos</span>
                                @else
                                    <span class="text-muted">No videos</span>
                                @endif
                            </td>
                            <td>{{ $gallery->created_at }}</td>
                            <td>
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No galleries found.</p>
                <a href="{{ route('galleries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection