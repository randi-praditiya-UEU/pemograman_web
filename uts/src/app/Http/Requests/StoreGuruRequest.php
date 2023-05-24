<?php

namespace App\Http\Requests;

use App\Models\Guru;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGuruRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('guru_create');
    }

    public function rules()
    {
        return [
            'nip' => [
                'string',
                'required',
            ],
            'nama' => [
                'string',
                'required',
            ],
            'pangkat' => [
                'string',
                'required',
            ],
        ];
    }
}
