<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\api\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $registrationService;
    
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(RegistrationRequest $request) {    
        return $request->all();   
        $data = $request->all();
        $data['file'] = $request->file('avatar');
        $response = $this->registrationService->registerOrUpdate($data);
        
        return $response;
    }

    public function getRegistrations(Request $request) {
        return $this->registrationService->getRegistrations($request);
    }

    public function update(Request $request, $id) { 
        $data = $request->all();
        $data['id'] = $id;
        $data['file'] = $request->file('avatar');
        $response = $this->registrationService->registerOrUpdate($data);
        
        return $response;
    }

    public function delete($id) { 
        $response = $this->registrationService->deleteRegistration($id);
        
        return $response;
    }
}
