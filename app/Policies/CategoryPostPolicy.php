<?php

namespace App\Policies;

use App\CategoryPost;
use App\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPostPolicy
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
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\CategoryPost  $categoryPost
     * @return mixed
     */
    public function view(Customer $customer)
    {
        //
        return $customer->checkPermissionAccess('list_categoryPost');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Customer  $customer
     * @return mixed
     */
    public function create(Customer $customer)
    {
        //
        return $customer->checkPermissionAccess('add_categoryPost');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\CategoryPost  $categoryPost
     * @return mixed
     */
    public function update(Customer $customer)
    {
        //
        return $customer->checkPermissionAccess('edit_categoryPost');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\CategoryPost  $categoryPost
     * @return mixed
     */
    public function delete(Customer $customer)
    {
        return $customer->checkPermissionAccess('delete_categoryPost');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\CategoryPost  $categoryPost
     * @return mixed
     */
    public function restore(Customer $customer, CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\CategoryPost  $categoryPost
     * @return mixed
     */
    public function forceDelete(Customer $customer, CategoryPost $categoryPost)
    {
        //
    }
}
