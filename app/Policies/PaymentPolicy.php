<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "EDITOR","MEMBER"]);

    }

    /**
     * Puede crear una nueva
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function paymentStore(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "EDITOR", "MEMBER"]);

    }

    /**
     * Puede ver la información
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function paymentShow(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "EDITOR", "MEMBER"]);

    }

    /**
     * Puede borrar
     *
     * @param User $user
     * @return @return \Illuminate\Http\Response
     */
    public function paymentDestroy(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

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
    public function paymentDeleteShow(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "ADMIN"]);

    }

    /**
     * Puede restaurar el resgistro
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function paymentDeleteRestore(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }

    /**
     * Puede borrar el registro del sistema
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function paymentDeleteForce(User $user, Payment $payment) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }
}
