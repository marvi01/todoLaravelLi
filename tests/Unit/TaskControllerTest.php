<?php

namespace Tests\Feature;

use App\Models\Models\Tasks;
use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    private function authenticate()
    {
        $user = User::factory()->create();
        return JWTAuth::fromUser($user);
    }

    public function testIndexReturnsAllTasksWithAuthentication()
    {
        Tasks::factory()->count(3)->create();
        $token = $this->authenticate();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/tasks');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'tasks');
    }

    public function testShowReturnsSpecificTaskWithAuthentication()
    {

        $token = $this->authenticate();
        $task = Tasks::factory()->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/tasks/' . $task->id);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $task->id,
            'title' => $task->title,
        ]);
    }

    public function testShowReturnsNotFoundForNonExistingTaskWithAuthentication()
    {
        $token = $this->authenticate();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson('/api/tasks/999');
        $response->assertStatus(200);
        $response->assertJson([
            'msg' => 'Tarefa não encontrada',
            'type' => 'warning',
        ]);
    }


}
