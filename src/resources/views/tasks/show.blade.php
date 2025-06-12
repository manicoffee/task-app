<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">タイトル</h3>
                        <p>{{ $task->getTitle() }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">説明</h3>
                        <p>{{ $task->getDescription() ?? '（なし）' }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">ステータス</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->getStatus() === 'complete' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $task->getStatus() === 'complete' ? '完了' : '未完了' }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">期限</h3>
                        <p>{{ $task->getDueDate() ? \Carbon\Carbon::parse($task->getDueDate())->format('Y/m/d') : '未設定' }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">作成日</h3>
                        <p>{{ \Carbon\Carbon::parse($task->getCreatedAt())->format('Y/m/d H:i') }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2">更新日</h3>
                        <p>{{ \Carbon\Carbon::parse($task->getUpdatedAt())->format('Y/m/d H:i') }}</p>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('tasks.edit', $task->getId()) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2">編集</a>
                        <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">一覧へ戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
