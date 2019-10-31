<?php

namespace App\Repositories;

use App\User;

class UserRepository extends User
{
    public function scopeActive($query, $active)
    {
        return $query->where('active', $active);
    }
}
