@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ $task->title }}</div>
                <div class="card-body">
                    <table class="table mt-1 border-0">
                        <tbody id="tasks_list">
                            @forelse ($task->subTasks as $subtask)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck{{ $subtask->id }}"{{ $subtask->done ? ' checked' : '' }}>
                                        <label class="custom-control-label{{ $subtask->done ? ' text-muted' : ''}}" for="customCheck{{ $subtask->id }}" onclick="change(this)" data-id="{{ $subtask->id }}">{{ $subtask->title }}</label>
                                        <span class="float-right">
                                            <a href="/tasks/{{ $subtask->id }}">{{ __('tasks.view') }}</a>
                                            <a href="#" onclick="destroy(this)" data-url="/tasks/{{ $subtask->id }}" class="text-danger ml-1">{{ __('tasks.delete') }}</a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="1" class="text-center text-muted">{{ __('tasks.notask') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="title" placeholder="{{ __('tasks.addtask') }}" autofocus="autofocus" id="title">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="button" onclick="create()">{{ __('tasks.add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
