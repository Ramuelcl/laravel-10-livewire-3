<?php

namespace App\Policies;

use App\Models\posts\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
    public function create(User $user)
    {
        // Autorizar la creación de un nuevo post
        return true; // O implementa tu lógica personalizada aquí
    }

    public function update(User $user, Post $post)
    {
        // Autorizar la edición de un post existente
        return $user->id === $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        // Autorizar la eliminación de un post existente
        return $user->id === $post->user_id;
    }
}
