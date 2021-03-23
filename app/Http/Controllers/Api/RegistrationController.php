<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\api\RegistrationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\RegistrationService;
use App\Events\RegisCourse;


class RegistrationController extends Controller
{
    protected $registrationService;
    
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function register(RegistrationRequest $request) {     
        $data = $request->all();
        $data['file'] = $request->file('avatar');
        $cal_end_time = \Helper::calculateDurationTime($data);
        $data['end_date'] = $cal_end_time['end_date'];
        $data['end_time'] = $cal_end_time['end_time'];
        $data['course_start_time'] = $cal_end_time['start_time'];
        $response = $this->registrationService->registerOrUpdate($data);
        if ($response) {
            //send mail
            unset($data['file']);
            unset($data['avatar']);
            event(new RegisCourse($data));
        }
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
