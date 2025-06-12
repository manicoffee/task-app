<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Task;
use App\Domain\Services\TaskRepositoryInterface;
use App\Domain\ValueObjects\TaskStatus;

class CreateTaskUseCase
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(array $data): Task
    {
        $task = new Task(
            null,
            $data['title'],
            $data['description'] ?? null,
            $data['status'] ?? TaskStatus::INCOMPLETE,
            $data['due_date'] ?? null,
            $data['user_id'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s')
        );
        return $this->taskRepository->save($task);
    }
}
