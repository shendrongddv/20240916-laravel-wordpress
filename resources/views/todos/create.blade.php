<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Create Todo') }}
            </h2>

            <a href="{{ route('todos.index') }}"
                class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:border-blue-600 focus:text-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-blue-600 dark:hover:text-blue-500 dark:focus:border-blue-600 dark:focus:text-blue-500">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg">

                <form method="POST" action="{{ route('todos.store') }}" class="w-full space-y-4 sm:w-1/2">
                    @csrf

                    <div class="w-full">
                        <label for=title" class="sr-only">Todo</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="What todo?"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        @error('title')
                            <p class="mt-2 text-xs text-red-500 dark:text-neutral-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="description" class="sr-only">Info</label>
                        <textarea id="description" name="description" rows="8" placeholder="More info..."
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                        @error('description')
                            <p class="mt-2 text-xs text-red-500 dark:text-neutral-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap justify-start gap-6">
                        @foreach ($tags as $tag)
                            <div class="flex gap-2">
                                <input type="checkbox" id="{{ $loop->iteration }}" name="tags[]"
                                    value="{{ $tag->id }}"
                                    class="mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800">
                                <label for="{{ $loop->iteration }}"
                                    class="text-sm text-gray-500 dark:text-neutral-400">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex w-full items-center justify-end gap-2">
                        <a href="{{ route('todos.index') }}"
                            class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:border-blue-600 focus:text-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-blue-600 dark:hover:text-blue-500 dark:focus:border-blue-600 dark:focus:text-blue-500">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
                            Save
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
