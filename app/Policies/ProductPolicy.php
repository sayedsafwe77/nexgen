<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param \App\Models\User|null $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.products');
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.products');
    }

    /**
     * Determine whether the user can create products.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.products');
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.products');
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Product $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->isAdmin() || $user->hasPermissionTo('manage.products');
    }

    /**
     * Determine whether the user can view trashed products.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewTrash(User $user)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.products')) && $this->hasSoftDeletes();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\product $Product
     * @return mixed
     */
    public function restore(User $user, product $Product)
    {
        return ($user->isAdmin() || $user->hasPermissionTo('manage.products')) && $this->trashed($Product);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\product $Product
     * @return mixed
     */
    public function forceDelete(User $user, product $Product)
    {
        return ($user->isAdmin()  || $user->hasPermissionTo('manage.products')) && $this->trashed($Product);
    }

    /**
     * Determine wither the given Product is trashed.
     *
     * @param $Product
     * @return bool
     */
    public function trashed($Product)
    {
        return $this->hasSoftDeletes() && method_exists($Product, 'trashed') && $Product->trashed();
    }

    /**
     * Determine wither the model use soft deleting trait.
     *
     * @return bool
     */
    public function hasSoftDeletes()
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass(product::class))->getTraits())
        );
    }
}
