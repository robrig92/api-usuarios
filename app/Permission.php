<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_permission', 'permission_id', 'user_id');
    }
}
