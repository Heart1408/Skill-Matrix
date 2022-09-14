<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Skill;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'CakePHP'],
            ['name' => 'Javascript'],
            ['name' => 'JQuery'],
            ['name' => 'VueJS'],
            ['name' => 'AngularJS'],
            ['name' => 'ReactJS'],
            ['name' => 'MySQL'],
            ['name' => 'MongoDB'],
            ['name' => 'NodeJS'],
            ['name' => 'Python'],
            ['name' => 'GoLang'],
            ['name' => 'Java'],
            ['name' => 'Ruby'],
            ['name' => 'HTML/CSS'],
            ['name' => 'HTML5'],
            ['name' => 'Firebase'],
            ['name' => 'Git'],
            ['name' => 'Docker'],
            ['name' => 'AWS'],
        ]);
    }
}
