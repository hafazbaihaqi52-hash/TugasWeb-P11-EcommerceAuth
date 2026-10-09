<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Menentukan apakah user boleh melihat post.
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Menentukan apakah user boleh membuat post.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Menentukan apakah user boleh mengedit post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->role === 'editor'
            || $user->role === 'admin';
    }

    /**
     * Menentukan apakah user boleh menghapus post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || $user->role === 'editor'
            || $user->role === 'admin';
    }
}