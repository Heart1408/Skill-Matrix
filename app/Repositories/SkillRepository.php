<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository {
    /**
     * @var skill
     */
    protected $skill;

    /**
     * SkillRepository constructor.
     * 
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        $this->skill = $skill;   
    }

    public function update($data)
    {
        $skill = $this->skill->find($data['skillid']);
        $skill->position = $data['position'];
        $skill->update();
        return $skill;
    }

    public function store($data)
    {
        // $data = $request->all();
        // $userid = $data['userid'];
        // $skill = Skill::find($data['skillid']);
        // $skill->users()->attach($userid,  ['number' => $data['number'], 'time' =>$data['time']]);
        // return response()->json();
        $skill = $this->skill->find($data['skillid']);
        $skill->users()->attach($data['userid'],  ['number' => $data['number'], 'time' =>$data['time']]);
        return $skill;
    }

    public function delete($id)
    {
        $skill = $this->skill->find($id);
        $skill->position = 0;
        $skill->update();
        return $skill;
    }

    public function getselectedSkills()
    {
        return $this->skill->selectedSkill()->get();
    }

    public function getoptionSkills()
    {
        return $this->skill->optionSkill()->get();
    }
}
