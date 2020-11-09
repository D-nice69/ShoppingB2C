<?php

namespace App\Policies;

use App\Customer;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function viewAny(Customer $customer)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(Customer $customer)
    {
        return $customer->checkPermissionAccess('list_product');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function create(Customer $customer)
    {
        return $customer->checkPermissionAccess('add_product');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(Customer $customer)
    {
        return $customer->checkPermissionAccess('edit_product');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(Customer $customer)
    {
        return $customer->checkPermissionAccess('delete_product');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Product  $product
     * @return mixed
     */
    public function restore(Customer $customer, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Product  $product
     * @return mixed
     */
    public function forceDelete(Customer $customer, Product $product)
    {
        //
    }
}
