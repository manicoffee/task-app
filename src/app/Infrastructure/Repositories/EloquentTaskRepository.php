<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Task;
use App\Domain\Services\TaskRepositoryInterface;
use App\Domain\ValueObjects\TaskStatus;
use App\Models\Task as EloquentTask;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function findById(int $id): ?Task
    {
        $eloquentTask = EloquentTask::find($id);
        return $eloquentTask ? $this->toDomain($eloquentTask) : null;
    }

    public function findByUserId(int $userId): array
    {
        $eloquentTasks = EloquentTask::where('user_id', $userId)->get();
        return $eloquentTasks->map(fn($task) => $this->toDomain($task))->all();
    }

    public function save(Task $task): Task
    {
        $eloquentTask = new EloquentTask();
        $eloquentTask->title = $task->getTitle();
        $eloquentTask->description = $task->getDescription();
        $eloquentTask->status = $task->getStatus();
        $eloquentTask->due_date = $task->getDueDate();
        $eloquentTask->user_id = $task->getUserId();
        $eloquentTask->save();
        return $this->toDomain($eloquentTask);
    }

    public function delete(int $id): void
    {
        EloquentTask::destroy($id);
    }

    private function toDomain(EloquentTask $eloquentTask): Task
    {
        return new Task(
            $eloquentTask->id,
            $eloquentTask->title,
            $eloquentTask->description,
            $eloquentTask->status,
            $eloquentTask->due_date,
            $eloquentTask->user_id,
            $eloquentTask->created_at,
            $eloquentTask->updated_at
        );
    }
}
