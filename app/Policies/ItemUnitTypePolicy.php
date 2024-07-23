<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ItemUnitType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemUnitTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_item::unit::type');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('view_item::unit::type');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_item::unit::type');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('update_item::unit::type');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('delete_item::unit::type');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_item::unit::type');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('force_delete_item::unit::type');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_item::unit::type');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('restore_item::unit::type');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_item::unit::type');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ItemUnitType $itemUnitType): bool
    {
        return $user->can('replicate_item::unit::type');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_item::unit::type');
    }
}