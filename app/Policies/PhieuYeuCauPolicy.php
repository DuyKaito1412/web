<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PhieuYeuCau;

class PhieuYeuCauPolicy
{
    public function view(User $user, PhieuYeuCau $phieu)
    {
        return $user->vai_tro !== 'user' || $phieu->user_id === $user->id;
    }

    public function update(User $user, PhieuYeuCau $phieu)
    {
        return $user->vai_tro !== 'user' || $phieu->user_id === $user->id;
    }

    public function delete(User $user, PhieuYeuCau $phieu)
    {
        return $user->vai_tro !== 'user' || $phieu->user_id === $user->id;
    }
}
