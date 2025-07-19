@extends('layouts.admin')

@section('title', __('messages.About'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.About') }}</h1>
    <a href="{{ route('abouts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($abouts->count() > 0)
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
                        @foreach($abouts as $about)
                        <tr>
                            <td>{{ $about->id }}</td>
                            <td>{{ Str::limit(strip_tags($about->description_en), 50) }}</td>
                            <td>{{ Str::limit(strip_tags($about->description_ar), 50) }}</td>
                            <td>
                                @if($about->photo)
                                    <img src="{{ asset('assets/admin/uploads/' . $about->photo) }}" alt="About" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $about->created_at }}</td>
                            <td>
                                <a href="{{ route('complete_abouts.index') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-add"></i> {{ __('messages.complete_abouts') }}
                                </a>
                                <a href="{{ route('abouts.edit', $about->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No about records found.</p>
                <a href="{{ route('abouts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection