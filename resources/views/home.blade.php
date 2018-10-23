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
                <div class="card-header">{{ __('tasks.mytasks') }}</div>
                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <div class="input-group mb-3" id="create">
                            <input type="text" class="form-control" name="title" placeholder="{{ __('tasks.addtask') }}" autofocus="autofocus" id="title" onkeypress="return event.keyCode != 13">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="button" onclick="create()">{{ __('tasks.add') }}</button>
                            </div>
                        </div>
                    </form>
                    <table class="table mt-1 border-0">
                        <tbody id="tasks_list">
                            @forelse ($tasks as $task)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck{{ $task->id }}"{{ $task->done ? ' checked' : '' }}>
                                        <label class="custom-control-label{{ $task->done ? ' text-muted' : ''}}" for="customCheck{{ $task->id }}" onclick="change(this)" data-url="/tasks/{{ $task->id }}">{{ $task->title }}</label>
                                        <span class="float-right">
                                            <a href="/tasks/{{ $task->slug ?: $task->id }}">{{ __('tasks.view') }}</a>
                                            <a href="#" onclick="destroy(this)" data-url="/tasks/{{ $task->id }}" class="text-danger ml-1">{{ __('tasks.delete') }}</a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty">
                                <td colspan="1" class="text-center text-muted">{{ __('tasks.notask') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
