<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'password',
        'email',
        'fio',
        'birth_date',
        'group_id',
        'address',
        'role',
        'avatar',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'address' => 'array',
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('score');
    }

    public function setAddressAttribute($value)
    {
        $value['city'] = mb_convert_case($value['city'], MB_CASE_TITLE, 'UTF-8');
        $value['street'] = mb_convert_case($value['street'], MB_CASE_TITLE, 'UTF-8');
        $this->attributes['address'] = json_encode($value);
    }

    public function setAvatarAttribute($value)
    {
        $this->attributes['avatar'] = $value->getClientOriginalName();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullAddressAttribute()
    {
        if($this->address) {
            return "{$this->address['city']} {$this->address['street']} {$this->address['home']}";
        }

        return null;
    }

    public function scopeFilter($query, $request)
    {
        if ($request->fio) {
            $query->where('fio', 'like', "%{$request->fio}%");
        }

        if ($request->birth_date) {
            $query->where('birth_date', 'like', "%{$request->birth_date}%");
        }
    }

    public function scopeWithTrashedFilter($query)
    {
        if (Auth::user()->role == Role::Admin->name) {
            $query->withTrashed();
        }
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d.m.Y', strtotime($value)),
        );
    }

    protected function color(): Attribute
    {
        return Attribute::make(
            get: function () {
                if($this->subjects->min('pivot.score') == 4){
                    return "table-warning";
                }
                if ($this->subjects->min('pivot.score') == 5){
                    return "table-success";
                }

                return "table-danger";
            }
        );
    }

    protected function role(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Role::tryFrom($value)->name,
        );
    }
}
