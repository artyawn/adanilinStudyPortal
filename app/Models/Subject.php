<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $fillable = ['name'];

    public function users()
    {

        $this->belongsToMany(User::class, 'subject_user', 'subject_id', 'user_id');

    }

}
