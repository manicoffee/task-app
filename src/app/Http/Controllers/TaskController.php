<?php

namespace App\Http\Controllers;

use App\Application\UseCases\CreateTaskUseCase;
use App\Domain\Services\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepository;
    private CreateTaskUseCase $createTaskUseCase;

    public function __construct(
        TaskRepositoryInterface $taskRepository,
        CreateTaskUseCase $createTaskUseCase
    ) {
        $this->taskRepository = $taskRepository;
        $this->createTaskUseCase = $createTaskUseCase;
    }

    public function index()
    {
        $tasks = $this->taskRepository->findByUserId(Auth::id());
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task = $this->createTaskUseCase->execute([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクが作成されました。');
    }

    public function show($id)
    {
        $task = $this->taskRepository->findById($id);

        if (!$task || $task->getUserId() !== Auth::id()) {
            abort(404);
        }

        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = $this->taskRepository->findById($id);

        if (!$task || $task->getUserId() !== Auth::id()) {
            abort(404);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = $this->taskRepository->findById($id);

        if (!$task || $task->getUserId() !== Auth::id()) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:incomplete,complete',
            'due_date' => 'nullable|date',
        ]);

        $task->updateTitle($validated['title']);
        $task->updateDescription($validated['description'] ?? null);
        $task->updateStatus($validated['status']);
        $task->updateDueDate($validated['due_date'] ?? null);

        $this->taskRepository->save($task);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクが更新されました。');
    }

    public function destroy($id)
    {
        $task = $this->taskRepository->findById($id);

        if (!$task || $task->getUserId() !== Auth::id()) {
            abort(404);
        }

        $this->taskRepository->delete($id);

        return redirect()->route('tasks.index')
            ->with('success', 'タスクが削除されました。');
    }
}
