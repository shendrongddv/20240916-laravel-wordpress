<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Todo') }}
            </h2>

            <a href="{{ route('todos.create') }}"
                class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="space-y-8 py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg">

                @if (!$todos->isEmpty())

                    {{-- Table --}}
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="inline-block min-w-full p-1.5 align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    No</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Todo</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Details</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    User</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium uppercase text-gray-500 dark:text-neutral-500">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @forelse ($todos as $todo)
                                                <tr
                                                    class="divide-x odd:bg-white even:bg-gray-100 hover:bg-gray-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $todo->title }}</td>
                                                    <td
                                                        class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        {{ $todo->description ? $todo->description : '—' }}</td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                        @foreach ($todo->tags as $tag)
                                                            <a href="{{ route('tags.edit', $tag) }}"
                                                                class="border p-1 text-xs">{{ $tag->name }}</a>
                                                        @endforeach
                                                    <td
                                                        class="space-x-2 whitespace-nowrap px-6 py-4 text-end text-sm font-medium">
                                                        <a href="{{ route('todos.edit', $todo) }}"
                                                            class="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-blue-600 hover:text-blue-800 focus:text-blue-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</a>

                                                        <form method="POST"
                                                            action="{{ route('todos.destroy', $todo) }}"
                                                            class="inline-flex items-center gap-x-2 rounded-lg border border-transparent text-sm font-semibold text-red-600 hover:text-red-800 focus:text-red-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-red-500 dark:hover:text-red-400 dark:focus:text-red-400">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <p>Empty</p>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Table End --}}

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $todos->links() }}
                    </div>
                    {{-- Pagination End --}}
                @else
                    <p>EMPTY</p>
                @endif

            </div>
        </div>
    </div>

</x-app-layout>
