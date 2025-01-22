<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    public function test_user_can_create_a_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $status = Status::factory()->create(); // Buat status untuk validasi

        $response = $this->post(route('task.store'), [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'status_id' => $status->id,
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'user_id' => $user->id,
            'status_id' => $status->id,
        ]);
    }

    public function test_user_can_see_their_own_tasks()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Task::factory()->create(['user_id' => $user->id, 'title' => 'User Task']);
        Task::factory()->create(['user_id' => User::factory()->create()->id, 'title' => 'Other Task']); // Tugas pengguna lain

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('User Task');
        $response->assertDontSee('Other Task');
    }

    public function test_user_can_update_their_own_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id, 'title' => 'Old Title']);
        $status = Status::factory()->create();

        $response = $this->put(route('task.update', $task), [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status_id' => $status->id,
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status_id' => $status->id,
        ]);
    }


    public function test_user_can_delete_their_own_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('task.destroy', $task));

        $response->assertRedirect(route('home'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
