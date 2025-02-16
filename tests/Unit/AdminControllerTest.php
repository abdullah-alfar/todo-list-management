<?php
namespace Tests\Feature;

use App\Events\PrivateNotification;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_users_returns_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson(route('admin.indexUsers'));

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_index_tasks_returns_all_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson(route('admin.indexTasks'));

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_delete_user_removes_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('admin.deleteUser', $user));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_delete_task_removes_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson(route('admin.deleteTask', $task));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_send_notification_broadcasts_event()
    {
        Event::fake();
        $user = User::factory()->create();

        $response = $this->postJson(route('admin.sendNotification', $user), [
            'message' => 'Hello, user!',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Notification sent']);

        Event::assertDispatched(PrivateNotification::class, function ($event) use ($user) {
            return $event->message === 'Hello, user!' && $event->userId === $user->id;
        });
    }
}
