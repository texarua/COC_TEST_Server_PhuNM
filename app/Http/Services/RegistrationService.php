<?php

namespace App\Http\Services;

use App\Http\Helper;
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

    public function registerOrUpdate($data) {

        $file = $data['file'];
        if($file) {
            $file_extension = $file->getClientOriginalExtension();
            $base_name = basename($file, $file_extension);
            $name = time().'-' . $base_name . '.' . $file_extension;
            $data['avatar'] = $name;
        }

        $registration = null;

        if (isset($data['edit'])) {
            $registration = $this->registrationRepository->edit($data);
        } else {
            $registration = $this->registrationRepository->save($data);
        }

        if ($registration) {
            if($data['avatar']) {
                if (!file_exists(public_path('upload/user/avatar/'))) {
                    mkdir(public_path('upload/user/avatar'), 0777, true);
                }
                Image::make($file)->save(public_path('upload/user/avatar/').$data['avatar']);
            }
            
            return response()->json([
                'message' => 'success',
                'registration' => $registration
            ], JsonResponse::HTTP_OK);
        } else {

            return response()->json(['errors' => 'error server'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getRegistrations($data) {
        return $this->registrationRepository->getAll($data);
    }

    public function deleteRegistration($id) {
        if ($this->registrationRepository->delete($id)) {
            return response()->json([
                'message' => 'delete success',
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json(['errors' => 'error server'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        };
    }
}
