<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Create Post') }}
            </h2>

            <a href="{{ route('posts.index') }}"
                class="inline-flex items-center gap-x-2 rounded-lg border border-gray-200 px-4 py-3 text-sm font-medium text-gray-500 hover:border-blue-600 hover:text-blue-600 focus:border-blue-600 focus:text-blue-600 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:text-neutral-400 dark:hover:border-blue-600 dark:hover:text-blue-500 dark:focus:border-blue-600 dark:focus:text-blue-500">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-6 shadow-sm dark:bg-gray-800 sm:rounded-lg">

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="bg-red-700 px-5 py-5 text-white">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('posts.store') }}" class="w-full space-y-4 sm:w-1/2">
                    @csrf

                    <div class="w-full">
                        <label for=title" class="sr-only">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="Post title"
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        @error('title')
                            <p class="mt-2 text-xs text-red-500 dark:text-neutral-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="content" class="sr-only">Content</label>
                        <textarea id="content" name="content" rows="8" placeholder="Post content..."
                            class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
                        @error('content')
                            <p class="mt-2 text-xs text-red-500 dark:text-neutral-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_published" name="is_published" value="false" 
                            class="before:size-4 relative h-[21px] w-[35px] cursor-pointer rounded-full border-transparent bg-gray-100 text-transparent transition-colors duration-200 ease-in-out before:inline-block before:translate-x-0 before:transform before:rounded-full before:bg-white before:shadow before:ring-0 before:transition before:duration-200 before:ease-in-out checked:border-blue-600 checked:bg-none checked:text-blue-600 checked:before:translate-x-full checked:before:bg-blue-200 focus:ring-blue-600 focus:checked:border-blue-600 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:before:bg-neutral-400 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:checked:before:bg-blue-200 dark:focus:ring-offset-gray-600">
                        <label for="is_published"
                            class="ms-3 text-sm text-gray-500 dark:text-neutral-400">Published</label>
                    </div>

                    <div class="flex gap-x-6">
                        <div class="flex">
                            <input type="radio" name="status" value="draft"
                                class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
                                id="draft" checked="">
                            <label for="draft" class="ms-2 text-sm text-gray-500 dark:text-neutral-400">Draft</label>
                        </div>

                        <div class="flex">
                            <input type="radio" name="status" value="pending"
                                class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
                                id="pending">
                            <label for="pending"
                                class="ms-2 text-sm text-gray-500 dark:text-neutral-400">Pending</label>
                        </div>

                        <div class="flex">
                            <input type="radio" name="status" value="publish"
                                class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
                                id="publish">
                            <label for="publish"
                                class="ms-2 text-sm text-gray-500 dark:text-neutral-400">Publish</label>
                        </div>
                    </div>

                    <div class="flex w-full items-center justify-end gap-2">
                        <a href="{{ route('posts.index') }}"
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
