<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

     /**
     * Puede ver el lista de divisas
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user) {

        // return $user->role == "ADMIN";
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "MEMBER"]);

    }

    /**
     * Puede crear una nueva
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planStore(User $user) {

        // return in_array($user->role, [$user->role == "ADMIN"]);
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN"]);

    }

    /**
     * Puede ver la información
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planShow(User $user, Plan $plan) {

        // return in_array($user->role, [$user->role == "ADMIN"]);
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "MEMBER"]);

    }

    /**
     * Puede borrar
     *
     * @param User $user
     * @return @return \Illuminate\Http\Response
     */
    public function planDestroy(User $user, Plan $plan) {

        // return in_array($user->role, [$user->role == "SUPERADMIN"]);
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN"]);

    }

    /**
     * Puede ver regsistros borrados
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function indexDeletes(User $user) {

        return $user->role == "ADMIN";

    }

    /**
     * Puede ver el registro borrado
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planDeleteShow(User $user, Plan $plan) {

        // return in_array($user->role, [$user->role == "ADMIN"]);
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN"]);

    }

    /**
     * Puede restaurar el resgistro
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planDeleteRestore(User $user, Plan $plan) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }

    /**
     * Puede borrar el registro del sistema
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function planDeleteForce(User $user, Plan $plan) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }
}
