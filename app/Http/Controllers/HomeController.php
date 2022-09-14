<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Models\UserSkill;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::with('skills')->paginate(8);
        $skills = Skill::selectedSkill()->get();
        return view('skillmatrix', compact('users', 'skills'));
    }
}
