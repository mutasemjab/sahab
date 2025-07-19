@extends('layouts.admin')

@section('title', __('messages.Advs'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Advs') }}</h1>
    <a href="{{ route('advs.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($advs->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.date_of_adv') }}</th>
                            <th>{{ __('messages.title_en') }}</th>
                            <th>{{ __('messages.title_ar') }}</th>
                            <th>{{ __('messages.photo') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advs as $adv)
                        <tr>
                            <td>{{ $adv->id }}</td>
                            <td>{{ $adv->date_of_adv }}</td>
                            <td>{{ Str::limit($adv->title_en, 30) }}</td>
                            <td>{{ Str::limit($adv->title_ar, 30) }}</td>
                            <td>
                                @if($adv->photo)
                                    <img src="{{ asset('assets/admin/uploads/'.$adv->photo) }}" alt="Adv" style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('advs.edit', $adv->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('advs.destroy', $adv->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No advertisements found.</p>
                <a href="{{ route('advs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection