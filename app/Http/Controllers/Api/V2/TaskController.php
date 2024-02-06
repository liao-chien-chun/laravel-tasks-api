<?php

namespace App\Http\Controllers\Api\V2;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    // 把授權抽出來
    public function __construct()
    {
        // 此方法會將適當的中間件定義附加到資源控制器方法
        $this->authorizeResource(Task::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 傳回目前登入使用者的所有任務
        return TaskResource::collection(auth()->user()->tasks()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        // create 方法會回傳一個模型實例
        // 然後就能將新建立的任務作為 JSON 回應傳回
        $task = $request->user()->tasks()->create($request->validated());

        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // 第一個參數指定任務策略檢視的方法名稱。
        // 第二個參數模型實例
        // $this->authorize('view', $task);
        return TaskResource::make($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
