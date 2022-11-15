<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        $this->hasMany(User::class, 'group_id', 'id');
    }
}
