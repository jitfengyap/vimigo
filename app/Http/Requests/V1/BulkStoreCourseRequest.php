<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.studentId'=>['required','integer'],
            '*.name' => ['required'],
            '*.status'=> ['required', Rule::in(['O','C'])],
            '*.startDate'=> ['required','date_format:Y-m-d H:i:s'],
            '*.endDate'=> ['date_format:Y-m-d H:i:s','nullable'],
        ];
    }

    protected function prepareforValidation(){
        $data = [];

        foreach($this->toArray() as $obj){
            $obj['student_id']= $obj['studentId']??null;
            $obj['start_date']= $obj['startDate']??null;
            $obj['end_date']= $obj['endDate']??null;

            $data[]=$obj;
        }
        
        $this->merge($data);
    }
}
