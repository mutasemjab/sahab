@extends('layouts.admin')

@section('title', __('messages.Questions'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ __('messages.Questions') }}</h1>
    <a href="{{ route('questions.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> {{ __('messages.create') }}
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($questions->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('messages.question_en') }}</th>
                            <th>{{ __('messages.question_ar') }}</th>
                            <th>{{ __('messages.answer_en') }}</th>
                            <th>{{ __('messages.answer_ar') }}</th>
                            <th>{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ Str::limit($question->question_en, 30) }}</td>
                            <td>{{ Str::limit($question->question_ar, 30) }}</td>
                            <td>{{ Str::limit(strip_tags($question->answer_en), 30) }}</td>
                            <td>{{ Str::limit(strip_tags($question->answer_ar), 30) }}</td>
                            <td>
                                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline">
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
                <p class="text-muted">No questions found.</p>
                <a href="{{ route('questions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.create') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection