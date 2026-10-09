<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title"
                                   class="block font-medium text-sm text-gray-700">
                                Judul
                            </label>

                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $post->title) }}"
                                class="block mt-1 w-full border-gray-300 rounded-md"
                                required
                            >

                            @error('title')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content"
                                   class="block font-medium text-sm text-gray-700">
                                Isi Post
                            </label>

                            <textarea
                                id="content"
                                name="content"
                                rows="6"
                                class="block mt-1 w-full border-gray-300 rounded-md"
                                required
                            >{{ old('content', $post->content) }}</textarea>

                            @error('content')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex gap-2">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                                Simpan Perubahan
                            </button>

                            <a
                                href="{{ route('posts.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded">
                                Kembali
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>