<?php

namespace App\Policies;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Trip $trip) {
        return $trip->user_id === $user->id;
    }
}
