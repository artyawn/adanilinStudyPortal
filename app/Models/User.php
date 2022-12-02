<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'fio',
        'birth_date',
        'group_id',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'address' => 'array'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)->withPivot('score');
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("d.m.Y", strtotime($value)),
        );
    }

    protected function color(): Attribute
    {
        return Attribute::make(
            get: function (){
            if($this->subjects->min('pivot.score') == 4){
                return "table-warning";
            }
            elseif ($this->subjects->min('pivot.score') == 5){
                return "table-success";
            }
            else {
                return "table-danger";
            }
           }
        );
    }

    public function setAddressAttribute($value)
    {
        $value['city'] = mb_convert_case($value['city'], MB_CASE_TITLE, "UTF-8");
        $value['street'] = mb_convert_case($value['street'], MB_CASE_TITLE, "UTF-8");
        $this->attributes['address'] = json_encode($value);
    }

    public function getFullAddressAttribute()
    {
        if($this->address) {
            return "{$this->address['city']} {$this->address['street']} {$this->address['home']}";
        }
        else {
            return null;
        }
    }
}
