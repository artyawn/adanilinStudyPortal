<?php

namespace App\Models;

use App\Scopes\NameScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('score');
    }

    public function scopeFilter($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }
    }
}
