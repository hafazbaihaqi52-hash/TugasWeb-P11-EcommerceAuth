<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-6">
                        <a href="{{ route('posts.create') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded">
                            + Buat Post
                        </a>
                    </div>

                    @forelse ($posts as $post)
                        <div class="border-b py-4">

                            <h3 class="text-lg font-bold">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-600 mt-2">
                                {{ $post->content }}
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                Dibuat oleh: {{ $post->user->name }}
                            </p>

                            <div class="mt-3 flex gap-2">

                                @if (
                                    auth()->id() === $post->user_id ||
                                    auth()->user()->role === 'editor' ||
                                    auth()->user()->role === 'admin'
                                )
                                    <a href="{{ route('posts.edit', $post) }}"
                                    style="background-color: #2563eb; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>
                                @endif

                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-2 bg-red-600 text-white rounded"
                                                onclick="return confirm('Yakin ingin menghapus post ini?')">
                                            Delete
                                        </button>
                                    </form>
                                @endcan

                            </div>

                        </div>
                    @empty
                        <p>Belum ada post.</p>
                    @endforelse

                </div>
            </div>

        </div>
    </div>
</x-app-layout>