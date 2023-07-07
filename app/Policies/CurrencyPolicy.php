<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
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
        // return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "EDITOR", "MEMBER"]);

    }

    /**
     * Puede crear una nueva
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function currencyStore(User $user, Currency $currency) {

        return in_array($user->role, [$user->role == "ADMIN"]);

    }

    /**
     * Puede ver la información
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function currencyShow(User $user, Currency $currency) {

        // return in_array($user->role, [$user->role == "ADMIN"]);
        return in_array($user->role, [$user->role == "SUPERADMIN", "ADMIN", "GUEST", "EDITOR", "MEMBER"]);

    }

    /**
     * Puede borrar
     *
     * @param User $user
     * @return @return \Illuminate\Http\Response
     */
    public function currencyDestroy(User $user, Currency $currency) {

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
    public function currencyDeleteShow(User $user, Currency $currency) {

        return in_array($user->role, [$user->role == "ADMIN"]);

    }

    /**
     * Puede restaurar el resgistro
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function currencyDeleteRestore(User $user, Currency $currency) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }

    /**
     * Puede borrar el registro del sistema
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function currencyDeleteForce(User $user, Currency $currency) {

        return in_array($user->role, [$user->role == "SUPERADMIN"]);

    }

}
