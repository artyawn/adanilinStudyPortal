<?php

namespace App\Models;

use App\Scopes\NameScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function scopeFilter($query, $request)
    {
        if($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }
    }
}
