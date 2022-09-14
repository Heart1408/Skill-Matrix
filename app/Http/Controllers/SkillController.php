<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserSkill;
use App\Services\SkillService;

class SkillController extends Controller
{
    protected $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService; 
    }

    public function index()
    {
        return view('skill');
    }

    public function getdata(Request $request)
    {
        $result = ['status' => 200];
        
        try {
            $result['selectedSkills'] = $this->skillService->getselectedSkills();
            $result['optionSkills'] = $this->skillService->getoptionSkills();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(Request $request){
        $data = $request->only([
            'skillid',
            'position'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->skillService->updateSkill($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function delete($id) 
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->skillService->deleteSkill($id);
        } catch (Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }

    public function store(Request $request) {
        // $data = $request->all();
        // $userid = $data['userid'];
        // $skill = Skill::find($data['skillid']);
        // $skill->users()->attach($userid,  ['number' => $data['number'], 'time' =>$data['time']]);
        // return response()->json();
        $data = $request->only([
            'userid',
            'skillid',
            'number',
            'time',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->skillService->storeSkill($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}
