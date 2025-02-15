<?php
namespace App\Http\Controllers;

use App\Models\{
    Task,
    User
};
use Illuminate\Http\{
    Request,
    Response,
    JsonResponse
};
use App\Events\PrivateNotification;

/**
 * Controller for administrative actions such as managing users and tasks.
 */
class AdminController extends Controller
{
    /**
     * Get a list of all users.
     *
     * @return JsonResponse Returns a JSON response containing all users.
     */
    public function indexUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Get a list of all tasks.
     *
     * @return JsonResponse Returns a JSON response containing all tasks.
     */
    public function indexTasks(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    /**
     * Delete a specific user.
     *
     * @param User $user The user to delete.
     * @return JsonResponse Returns an empty JSON response with HTTP status code 204.
     */
    public function deleteUser(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Delete a specific task.
     *
     * @param Task $task The task to delete.
     * @return JsonResponse Returns an empty JSON response with HTTP status code 204.
     */
    public function deleteTask(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Send a private notification to a specific user.
     *
     * @param Request $request The incoming request containing the notification message.
     * @param User $user The user to send the notification to.
     * @return JsonResponse Returns a JSON response confirming the notification was sent.
     */
    public function sendNotification(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        broadcast(new PrivateNotification($request->message, $user->id))->toOthers();

        return response()->json(['message' => 'Notification sent']);
    }
}
