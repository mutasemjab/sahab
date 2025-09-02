@extends('layouts.admin')

@section('title', __('messages.community_initiatives_management'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.community_initiatives_management') }}</h3>
                    <a href="{{ route('community-initiatives.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('messages.add_new_initiative') }}
                    </a>
                </div>


                <div class="card-body">
                    @if($initiatives->count() > 0)
                     

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="initiatives-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('messages.id') }}</th>
                                        <th>{{ __('messages.title_en') }}</th>
                                        <th>{{ __('messages.title_ar') }}</th>
                                        <th>{{ __('messages.status') }}</th>
                                        <th>{{ __('messages.finish_date') }}</th>
                                        <th>{{ __('messages.created_at') }}</th>
                                        <th>{{ __('messages.type') }}</th>
                                        <th>{{ __('messages.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($initiatives as $initiative)
                                        <tr data-status="{{ $initiative->status['key'] }}">
                                            <td>{{ $initiative->id }}</td>
                                            <td>
                                                <strong>{{ Str::limit($initiative->title_en, 30) }}</strong>
                                            </td>
                                            <td>
                                                <strong>{{ Str::limit($initiative->title_ar, 30) }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $initiative->status['class'] }}">
                                                    {{ $initiative->status['label'] }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($initiative->date_finish)
                                                    {{ $initiative->formatted_finish_date }}
                                                @else
                                                    <span class="text-muted">{{ __('messages.no_end_date') }}</span>
                                                @endif
                                            </td>
                                          
                                            <td>{{ $initiative->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $initiative->from_admin_or_user == 1 ? 'Admin' : 'User' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                   
                                                    <a href="{{ route('community-initiatives.edit', $initiative) }}" 
                                                       class="btn btn-sm btn-warning" 
                                                       title="{{ __('messages.edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="{{ __('messages.delete') }}"
                                                            onclick="confirmDelete({{ $initiative->id }}, '{{ addslashes($initiative->title_en) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>

                                                <!-- Hidden delete form -->
                                                <form id="delete-form-{{ $initiative->id }}" 
                                                      action="{{ route('community-initiatives.destroy', $initiative) }}" 
                                                      method="POST" 
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ __('messages.no_initiatives_found') }}</h4>
                            <p class="text-muted">{{ __('messages.create_first_initiative') }}</p>
                            <a href="{{ route('community-initiatives.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('messages.add_new_initiative') }}
                            </a>
                        </div>
                    @endif
                </div>

                @if($initiatives->count() > 0)
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info">
                                    {{ __('messages.showing_entries', [
                                        'start' => 1,
                                        'end' => $initiatives->count(),
                                        'total' => $initiatives->count()
                                    ]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Delete confirmation modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('messages.confirm_deletion') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{ __('messages.are_you_sure_delete_initiative') }}</p>
                <p><strong id="initiative-title"></strong></p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ __('messages.this_action_cannot_be_undone') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('messages.cancel') }}
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteConfirmed()">
                    <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentDeleteId = null;

function confirmDelete(id, title) {
    currentDeleteId = id;
    document.getElementById('initiative-title').textContent = title;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

function deleteConfirmed() {
    if (currentDeleteId) {
        document.getElementById('delete-form-' + currentDeleteId).submit();
    }
}

</script>
@endsection