<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:191',
            'dob' => 'required|date_format:Y/m/d',
            'address'=>'required',
            'mobile'=>'required',
            'email' => 'required|email|unique:registrations',
            'start_time' => 'required',
            'learning_hour' => 'required',
            'duration' => 'required',
            'course' => 'required',
            'avatar' => 'required|image|mimes:png,jpg|max:2048',
            'start_date' => 'required|date_format:Y/m/d',
        ];
    }

    public function messages()
    {
        return [
            'date_format' => ':attribute phải đúng định dạng YYYY/MM/DD',
            'required'=>':attribute Không được để trống',
            'max'=>':attribute Không được quá :max ký tự',
            'email.email' => ':attribute sai định dạng',
            'email.unique' => ':attribute da ton tai',
            'image' => ':attribute phai la hình ảnh',
            'mimes' => ':attribute phai dinh dang như sau:png,jpg',
            'avatar.max' => ':attribute Maximum file size to upload :max'
        ];
    }

    public function attributes()
    {
        return [
            'dob' => 'Day of birth',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
