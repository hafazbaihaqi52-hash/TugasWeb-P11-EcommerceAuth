<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $post->title }}
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Dibuat oleh: {{ $post->user->name }}
                    </p>

                    <div class="mt-6 text-gray-700">
                        {{ $post->content }}
                    </div>

                    <div class="mt-6">
                        <a
                            href="{{ route('posts.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>