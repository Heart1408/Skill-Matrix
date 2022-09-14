<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'skill_id',
        'number',
        'description',
        'color',
    ];

    public static function getUserSkill($user_id, $skill_id)
    {
        return UserSkill::where('user_id', $user_id)->where('skill_id', $skill_id)->first();
    }

    public static function checkUpdateLevel($user_id, $skill_id)
    {
        $check = UserSkill::where('user_id', $user_id)->where('skill_id', $skill_id)->first();
        if (is_null($check)) {
            return false;
        }
        return true;
    }
}
