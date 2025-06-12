<?php

namespace App\Domain\Entities;

class Task
{
    private ?int $id;
    private string $title;
    private ?string $description;
    private string $status;
    private ?string $dueDate;
    private int $userId;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(
        ?int $id,
        string $title,
        ?string $description,
        string $status,
        ?string $dueDate,
        int $userId,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->dueDate = $dueDate;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDueDate(): ?string
    {
        return $this->dueDate;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function updateTitle(string $title): void
    {
        $this->title = $title;
    }

    public function updateDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function updateStatus(string $status): void
    {
        $this->status = $status;
    }

    public function updateDueDate(?string $dueDate): void
    {
        $this->dueDate = $dueDate;
    }
}
