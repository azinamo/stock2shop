<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;


    public function view(User $user)
    {
        return true; //$user->can('view')
    }

    public function create(User $user)
    {
        return true; //$user->can('create')
    }
}
