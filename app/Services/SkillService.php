<?php

namespace App\Services;

use App\Repositories\SkillRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SkillService {
    /**
     * @var skillRepository
     */
    protected $skillRepository;

    /**
     * UserRepository constructor.
     * 
     * @param UserRepository $userRepository
     */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;  
    }

    public function updateSkill($data)
    {
        $validator = Validator::make($data, [
            'skillid' => 'required',
            'position' => 'required',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $skill = $this->skillRepository->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update skill data');
        }

        DB::commit();

        return $skill;
    }

    public function storeSkill($data)
    {
        $validator = Validator::make($data, [
            'number' => 'required',
            'time' => 'required',
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $skill = $this->skillRepository->store($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to store skill data');
        }

        DB::commit();

        return $skill;
    }

    public function deleteSkill($id)
    {
        return $this->skillRepository->delete($id);
    }

    public function getselectedSkills()
    {
        return $this->skillRepository->getselectedSkills();
    }

    public function getoptionSkills()
    {
        return $this->skillRepository->getoptionSkills();
    }
}
