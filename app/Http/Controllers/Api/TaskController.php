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
/**
 * Controller for managing tasks.
 */
class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Get all tasks for the authenticated user.
     *
     * @return JsonResponse Returns a JSON response containing the list of tasks.
     */
    public function index(): JsonResponse
    {
        $tasks = Cache::remember('tasks.' . auth()->id(), 60, function () {
            return Task::where('user_id', auth()->id())->get();
        });
        return response()->json($tasks);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param Request $request The incoming request containing task data.
     * @return JsonResponse Returns a JSON response with the created task and HTTP status code 201.
     */
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

    /**
     * Display the specified task.
     *
     * @param Task $task The task to display.
     * @return JsonResponse Returns a JSON response containing the task.
     */
    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }

    /**
     * Update the specified task in storage.
     *
     * @param Request $request The incoming request containing updated task data.
     * @param Task $task The task to update.
     * @return JsonResponse Returns a JSON response containing the updated task.
     */
    public function update(Request $request, Task $task): JsonResponse
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

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task The task to delete.
     * @return JsonResponse Returns an empty JSON response with HTTP status code 204.
     */
    public function destroy(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
