<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'fio',
        'birth_date',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('score');
    }
}
