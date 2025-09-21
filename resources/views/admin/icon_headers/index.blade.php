@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.icon_headers') }}</h4>
                    <a href="{{ route('icon_headers.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('messages.create') }}
                    </a>
                </div>
                <div class="card-body">
                 

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.id') }}</th>
                                    <th>{{ __('messages.icon') }}</th>
                                    <th>{{ __('messages.link') }}</th>
                                    <th>{{ __('messages.created_at') }}</th>
                                    <th>{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($iconHeaders as $iconHeader)
                                    <tr>
                                        <td>{{ $iconHeader->id }}</td>
                                        <td>
                                            <i class="{{ $iconHeader->icon }}"></i> 
                                            <span class="ms-2">{{ $iconHeader->icon }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ $iconHeader->link }}" target="_blank" class="text-decoration-none">
                                                {{ Str::limit($iconHeader->link, 50) }}
                                                <i class="fas fa-external-link-alt ms-1"></i>
                                            </a>
                                        </td>
                                        <td>{{ $iconHeader->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                            
                                                <a href="{{ route('icon_headers.edit', $iconHeader) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                                </a>
                                                <form action="{{ route('icon_headers.destroy', $iconHeader) }}" 
                                                      method="POST" style="display: inline-block;"
                                                      onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('messages.no_records') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection