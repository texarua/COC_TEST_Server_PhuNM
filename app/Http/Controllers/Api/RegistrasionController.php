<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\api\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\RegistrationService;

class RegistrasionController extends Controller
{
    protected $registrationService;
    
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(RegistrationRequest $request) {    
        $data = $request->all();
        $data['file'] = $request->file('avatar');
        $response = $this->registrationService->saveRegistrationData($data);
        
        return $response;
    }
}
