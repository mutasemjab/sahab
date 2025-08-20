@extends('layouts.admin')

@section('title', __('messages.listen_sessions'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.listen_sessions') }}</h4>
                    <a href="{{ route('new-listen-sessions.create') }}" class="btn btn-primary">
                        {{ __('messages.add_new_session') }}
                    </a>
                </div>
                
                <div class="card-body">

                    @if($sessions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.photo') }}</th>
                                        <th>{{ __('messages.title') }}</th>
                                        <th>{{ __('messages.description') }}</th>
                                        <th>{{ __('messages.created_at') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sessions as $session)
                                        <tr>
                                            <td>
                                                @if($session->photo_url)
                                                    <img src="{{ $session->photo_url }}" alt="{{ $session->title }}" 
                                                         class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">{{ __('messages.no_image') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($session->title, 30) }}</td>
                                            <td>{{ Str::limit($session->description, 50) }}</td>
                                            <td>{{ $session->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('new-listen-sessions.show', $session) }}" 
                                                       class="btn btn-info btn-sm">
                                                        {{ __('messages.view') }}
                                                    </a>
                                                    <a href="{{ route('new-listen-sessions.edit', $session) }}" 
                                                       class="btn btn-warning btn-sm">
                                                        {{ __('messages.edit') }}
                                                    </a>
                                                    <form action="{{ route('new-listen-sessions.destroy', $session) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                                            {{ __('messages.delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $sessions->links() }}
                    @else
                        <div class="text-center">
                            <p class="text-muted">{{ __('messages.no_sessions_found') }}</p>
                            <a href="{{ route('new-listen-sessions.create') }}" class="btn btn-primary">
                                {{ __('messages.add_first_session') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection