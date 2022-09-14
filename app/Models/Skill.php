<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills', 'skill_id', 'user_id')->withPivot('number', 'time');
    }

    public function scopeSelectedSkill($query)
    {
        return $query->where('position','<>', 0)->orderBy('position');
    }

    public function scopeOptionSkill($query)
    {
        return $query->where('position', NULL)->orwhere('position', 0);
    }
}
