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

class AdminController extends Controller
{
    public function indexUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function indexTasks(): JsonResponse
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function deleteUser(User $user):JsonResponse
    {
        $user->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function deleteTask(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
    public function sendNotification(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        broadcast(new PrivateNotification($request->message, $user->id))->toOthers();

        return response()->json(['message' => 'Notification sent']);
    }
}
