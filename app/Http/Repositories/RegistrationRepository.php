<?php

namespace App\Http\Repositories;

use App\Models\Registrasion;

class RegistrationRepository
{
    protected $registration;

    public function __construct(Registrasion $registration)
    {
        $this->registration = $registration;
    }

    public function save($data) {
        return $this->registration->create($data);
    }

    public function delete($id) {
        return $this->registration->where('id', $id)->update([
            'enabled' => 0
        ]);
    }

    public function edit($data) {
        unset($data['edit']);
        unset($data['file']);
        unset($data['email']);
        unset($data['course_start_time']);
        if ($this->registration->where('id', $data['id'])->update($data)) {
            return $data;
        };
    }

    public function getAll($data) {
        $registrations = Registrasion::with('start_time', 'course', 'duration', 'learning_hour')
                        ->where('enabled', 1);
        if(isset($data['field']) && isset($data['sort'])) {
            $registrations = $registrations->orderBy($data['field'], $data['sort']);
        }

        $registrations = $registrations->paginate(config('app.paginate'));

        return response()->json([
            'registrations' => $registrations
        ]);
    }
}