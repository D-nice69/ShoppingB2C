<?php

namespace App\Policies;

use App\Customer;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
    public function print(Customer $customer)
    {
        return $customer->checkPermissionAccess('print_order');

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Order  $order
     * @return mixed
     */
    public function view(Customer $customer)
    {
        return $customer->checkPermissionAccess('show_order');

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
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Order  $order
     * @return mixed
     */
    public function update(Customer $customer)
    {
        return $customer->checkPermissionAccess('update_order');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Order  $order
     * @return mixed
     */
    public function delete(Customer $customer)
    {
        return $customer->checkPermissionAccess('delete_order');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Order  $order
     * @return mixed
     */
    public function restore(Customer $customer, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Customer  $customer
     * @param  \App\Order  $order
     * @return mixed
     */
    public function forceDelete(Customer $customer, Order $order)
    {
        //
    }
}
