<?php

namespace App\Http\Services;

use App\Http\Repositories\RegistrationRepository;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Http\JsonResponse;

class RegistrationService
{
    protected $registrationRepository;

    public function __construct(RegistrationRepository $registrationRepository)
    {
        $this->registrationRepository = $registrationRepository;
    }

    public function saveRegistrationData($data) {
        $cal_end_time = \Helper::calculateDurationTime($data);
        $data['end_date'] = $cal_end_time['end_date'];
        $data['end_time'] = $cal_end_time['end_time'];

        $file = $data['file'];
        if($file) {
            $file_extension = $file->getClientOriginalExtension();
            $base_name = basename($file, $file_extension);
            $name = time().'-' . $base_name . '.' . $file_extension;
            $data['avatar'] = $name;
        }

        if ($registrasion = $this->registrationRepository->save($data)) {
            if($data['avatar']) {
                if (!file_exists(public_path('upload/user/avatar/'))) {
                    mkdir(public_path('upload/user/avatar'), 0777, true);
                }
                Image::make($file)->save(public_path('upload/user/avatar/').$data['avatar']);
            }

            return response()->json([
                'message' => 'success',
                'registration' => $registrasion
            ], JsonResponse::HTTP_OK);
        } else {

            return response()->json(['errors' => 'error server'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}