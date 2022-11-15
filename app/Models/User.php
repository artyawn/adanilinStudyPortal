<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['fio', 'birth_date', 'group_id'];

    public function group()
    {

        $this->belongsTo(Group::class, 'group_id', 'id');

    }

    public function subjects()
    {

        $this->belongsToMany(SubjectUser::class, 'subject_user', 'user_id', 'subject_id');

    }

}
