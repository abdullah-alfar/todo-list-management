<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\{
    Request,
    Response,
    JsonResponse
};
use App\Events\TaskCreated;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index():JsonResponse
    {
        $tasks = Cache::remember('tasks.' . auth()->id(), 60, function () {
          return Task::where('user_id', auth()->id())->get();
        });
        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'user_id'     => auth()->id(),
        ]);

        broadcast(new TaskCreated($task))->toOthers();
        return response()->json($task, Response::HTTP_CREATED);
    }

    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }

    public function update(Request $request, Task $task):JsonResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed'   => 'sometimes|boolean',
        ]);

        $task->update($validated);
        Cache::forget('tasks.' . $task->user_id);
        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
