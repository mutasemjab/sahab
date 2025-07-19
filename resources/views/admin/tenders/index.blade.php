@extends('layouts.admin')

@section('title', __('messages.Tenders'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Tenders') }}</h1>
    <a href="{{ route('tenders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($tenders->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.number') }}</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.cost') }}</th>
                            <th>{{ __('messages.date_publish') }}</th>
                            <th>{{ __('messages.date_close') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenders as $tender)
                        <tr>
                            <td>{{ $tender->id }}</td>
                            <td>{{ $tender->number }}</td>
                            <td>{{ Str::limit($tender->title_en, 30) }}</td>
                            <td>{{ Str::limit($tender->title_ar, 30) }}</td>
                            <td>{{ $tender->cost }}</td>
                            <td>{{ $tender->date_publish }}</td>
                            <td>{{ $tender->date_close }}</td>
                            <td>
                                <a href="{{ route('tenders.edit', $tender->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('tenders.destroy', $tender->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No tenders found.</p>
                <a href="{{ route('tenders.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection