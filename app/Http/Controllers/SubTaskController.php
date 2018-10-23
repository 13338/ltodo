<?php

namespace App\Http\Controllers;

use App\SubTask;
use App\Http\Requests\SubTaskRequest;
use Illuminate\Http\Request;

class SubTaskController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubTaskRequest $request)
    {
        $this->authorize('create', SubTask::class);
        return SubTask::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubTask  $subTask
     * @return \Illuminate\Http\Response
     */
    public function update(SubTaskRequest $request, SubTask $subTask)
    {
        $this->authorize('update', $subTask);
        if ($request->done) {
            $subTask->update([
                'done' => ($subTask->done == 0) ? 1 : 0,
            ]);
            return $subTask;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubTask  $subTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTask $subTask)
    {
        $this->authorize('forceDelete', $subTask);
        if ($subTask->delete()) {
            return response(['message' => 'deleted'], 200);
        }
        return response(['message' => 'delete error'], 400);
    }
}
