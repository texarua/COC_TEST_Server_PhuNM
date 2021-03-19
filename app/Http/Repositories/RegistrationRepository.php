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
}